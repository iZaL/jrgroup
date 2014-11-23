<?php

use Acme\CertificateStatuses\Pending;

class AdminCertificateRequestsController extends AdminBaseController {

    /**
     * @var CertificateType
     */
    private $type;
    /**
     * @var CertificateMeta
     */
    private $meta;
    /**
     * @var CertificateOption
     */
    private $requestOption;

    protected $model;
    /**
     * @var CertificateOption
     */
    private $option;
    /**
     * @var AdminCertificateStatusesController
     */
    private $statusCtrl;
    /**
     * @var CertificateStatus
     */
    private $status;
    /**
     * @var CertificateOptionType
     */
    private $optionType;

    public function __construct(CertificateType $type, CertificateMeta $meta, CertificateRequestOption $requestOption, CertificateRequest $model, CertificateOption $option, AdminCertificateStatusesController $statusCtrl, CertificateStatus $status, CertificateOptionType $optionType)
    {
        $this->type          = $type;
        $this->meta          = $meta;
        $this->requestOption = $requestOption;
        $this->model         = $model;
        $this->option        = $option;
        $this->statusCtrl    = $statusCtrl;
        $this->status        = $status;
        $this->optionType    = $optionType;
        parent::__construct();
    }

    public function index()
    {
        $types = ['' => 'Select Certificate type'] + $this->type->all()->lists('name', 'id');
        $metas = $this->meta->all();

        return View::make('admin.certificates.requests.create', compact('types', 'metas'));
    }


    public function show($id)
    {
        $request = $this->model->with(array('user', 'type', 'status'))->find($id);

        return View::make('admin.certificates.view', compact('request'));
    }


    public function create()
    {
        $types = ['' => 'Select Certificate type'] + $this->type->all()->lists('name', 'id');
        $metas = $this->meta->all();

        return View::make('admin.certificates.requests.create', compact('types', 'metas'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     * Create a certificate Request
     */
    public function store()
    {
        // get the type id
        $type = $this->type->findOrFail(Input::get('type_id'));

        // selected options in the form
        $selectedOptions = [];

        // valid option ids .. i.e which has price
        $validOptions = [];

        // get selected options
        foreach ( Input::all() as $key => $value ) {

            //store the selected certificate options into an array

            // if the input is option
            if ( $this->parseOptionId($key) ) {

                //remove empty option ids
                if ( ! empty($value) ) {
                    $selectedOptions[$key] = $value;

                    // get the price for the option
                    $optionType = $this->optionType->whereTypeId(Input::get('type_id'))->whereOptionId($value)->first();

                    if ( $optionType ) {
                        if ( $optionType->price > 0 ) {
                            $validOptions[] = $value; // arrays to send for SUM ( addition on options tables )
                        }
                    }
                }
            }
        }

        // if no valid chosen wrong value
        if ( empty($validOptions) ) {
            return Redirect::back()->withInput()->withErrors('Sorry, The Certificate Option You Requested is Invalid. Contact Admin Please');
        }

        // get the total price for selected option ids
        $total = $this->calculateTotal($validOptions, $type->price);

        DB::beginTransaction();

        try {

            // create a certificate request
            $validation = new $this->model(array_merge(array('user_id' => $this->getUserId(), 'amount' => $total, 'type_id' => Input::get('type_id'), 'quantity' => Input::get('quantity'))));

            if ( ! $validation->save() ) {
                return Redirect::back()->withInput()->withErrors($validation->getErrors());
            }

            // delete old request options
            DB::table('certificate_request_options')->whereRequestId($validation->id)->delete();

            // foreach valid selected options create the entry in request option table
            foreach ( $validOptions as $option_id ) {

                $requestOption             = new $this->requestOption;
                $requestOption->request_id = $validation->id;
                $requestOption->option_id  = $option_id;

                if ( ! $requestOption->save() ) {
                    return Redirect::action('AdminCertificateRequestsController@edit', $validation->id)->withInput()->withErrors($requestOption->getErrors())->with(array('error' => 'please edit the options'));
                }

            }

            //create pending status
            $request            = $this->model->find($validation->id);
            $status             = new $this->status;
            $status->request_id = $validation->id;
            $status->user_id    = $this->getUserId();
            $this->statusCtrl->create(new Pending())->setStatus($request, Auth::user(), $status, '');

            DB::commit();

            return Redirect::action('AdminCertificateDashboardController@index')->with('success', 'Certificate Requested');

        }

        catch ( \Exception $e ) {
            DB::rollBack();

            return Redirect::back('AdminCertificateDashboardController@index')->with('error', 'Sorry, some error cord and Could not request your certificate. please contact admin ');

        }

    }

    public function edit($id)
    {

        // not allowed
        return Redirect::action('AdminCertificateDashboardController@index')->with('info', 'Sorry, Updating is not allowed');

        $request = $this->model->findOrFail($id);
        $types   = ['' => 'Select Certificate type'] + $this->type->all()->lists('name', 'id');
        $metas   = $this->meta->all();

        return View::make('admin.certificates.requests.edit', compact('types', 'metas', 'request'));
    }

    public function update($id)
    {
        $typePrice = $this->type->findOrFail(Input::get('type_id'));
        $options   = array();
        foreach ( Input::all() as $key => $value ) {
            if ( substr($key, 0, 9) == "option_id" ) {
                $options[$key] = $value;
                $optionPrice   = $this->optionType->whereTypeId(Input::get('type_id'))->whereOptionId($value)->first();
                if ( $optionPrice ) {
                    if ( $optionPrice->price > 0 ) {
                        $db_price[] = $value; // arrays to send for SUM ( addition on options tables )
                    }
                }
            }
        }

        $total      = $this->calculateTotal($db_price, $typePrice->price);
        $validation = $this->model->find($id);
        $validation->fill(array_merge(array('amount' => $total), Input::except(array_keys($options))));
        if ( ! $validation->save() ) {
            return Redirect::back()->withInput()->withErrors($validation->getErrors());
        }
        DB::table('certificate_request_options')->whereRequestId($validation->id)->delete();
        foreach ( $options as $option_id ) {
            if ( ! empty($option_id) ) {
                $query = $this->requestOption->whereRequestId($validation->id)->whereOptionId($option_id)->first();
                if ( $query ) {
                    $option = $this->requestOption->find($query->id);
                } else {
                    $option = new $this->requestOption;
                }
                $option->request_id = $validation->id;
                $option->option_id  = $option_id;
                if ( ! $option->save() ) {
                    return Redirect::action('AdminCertificateRequestsController@edit', $validation->id)->withInput()->withErrors($option->getErrors())->with(array('error' => 'please edit the options'));
                }
            }
        }

        return Redirect::action('AdminCertificateDashboardController@index')->with('success', 'Certificate Request Updated');

    }


    /**
     * @param $option_ids
     * @param $type_id
     * @return mixed
     */
    public function calculateTotal(array $option_ids, $type_id)
    {
        //get the sum (total amount) of the option ids
        $optionPrice = $this->optionType->getPrice($option_ids);

        // round up the value
        $optionPrice = (float) round($optionPrice->total);

        $quantity    = Input::get('quantity');

        // calculate total
        $total = ($type_id + $optionPrice) * $quantity;

        return $total;
    }

    public function printDetail($id)
    {
        $request = $this->model->with(array('user', 'type', 'status'))->find($id);
        $pdf = PDF::loadView('admin.certificates.requests.detail',compact('request'));

        return $pdf->setPaper('a4')->setOrientation('landscape')->setWarnings(false)->stream(str_random(10).'.pdf');

//        return View::make('admin.certificates.requests.detail', compact('request'));

    }

    private function parseOptionId($key)
    {
        if ( substr($key, 0, 9) == "option_id" ) return true;

        return false;
    }
}
