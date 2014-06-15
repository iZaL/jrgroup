<?php

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
    private $request_option;

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

    public function __construct(CertificateType $type, CertificateMeta $meta, CertificateRequestOption $request_option, CertificateRequest $model, CertificateOption $option, AdminCertificateStatusesController $statusCtrl, CertificateStatus $status, CertificateOptionType $optionType)
    {
        $this->type = $type;
        $this->meta = $meta;
        $this->request_option = $request_option;
        $this->model = $model;
        $this->option = $option;
        parent::__construct();
        $this->statusCtrl = $statusCtrl;
        $this->status = $status;
        $this->optionType = $optionType;
    }

    public function index()
    {
        $types = ['' => 'Select Certificate type'] + $this->type->all()->lists('name', 'id');
        $metas = $this->meta->all();
        return View::make('admin.certificates.requests.create', compact('types', 'metas'));
    }


    public function show($id) {
        $request = $this->model->with(array('user','type','status'))->find($id);
        return View::make('admin.certificates.view',compact('request'));
    }


    public function create()
    {
        $types = ['' => 'Select Certificate type'] + $this->type->all()->lists('name', 'id');
        $metas = $this->meta->all();

        return View::make('admin.certificates.requests.create', compact('types', 'metas'));
    }

    public function store()
    {
        $typePrice = $this->type->findOrFail(Input::get('type_id'));
        $options = array();
        foreach (Input::all() as $key => $value) {
            if (substr($key, 0, 9) == "option_id") {
                $options[$key] = $value;
                $optionPrice = $this->optionType->whereTypeId(Input::get('type_id'))->whereOptionId($value)->first();
                if($optionPrice) {
                    if($optionPrice->price > 0) {
                        $db_price[] = $value; // arrays to send for SUM ( addition on options tables )
                    }
                }
            }
        }
        $total = $this->calculateTotal($db_price, $typePrice->price);
        $validation = new $this->model(array_merge(array('user_id' => $this->getUserId(), 'amount' => $total), Input::except(array_keys($options))));
        if (! $validation->save()) {
            return Redirect::back()->withInput()->withErrors($validation->getErrors());
        }
        //delete old results
        DB::table('certificate_request_options')->whereRequestId($validation->id)->delete();
        foreach ($options as $option_id) {
            if (! empty($option_id)) {
                $query = $this->request_option->whereRequestId($validation->id)->whereOptionId($option_id)->first();
                if ($query) {
                    $option = $this->request_option->find($query->id);
                } else {
                    $option = new $this->request_option;
                }
                $option->request_id = $validation->id;
                $option->option_id = $option_id;
                if (! $option->save()) {
                    return Redirect::action('AdminCertificateRequestsController@edit', $validation->id)->withInput()->withErrors($option->getErrors())->with(array('error' => 'please edit the options'));
                }
            }
        }

        //create pending status
        $request = $this->model->find($validation->id);
        $status = new $this->status;
        $status->request_id = $validation->id;
        $status->user_id = $this->getUserId();
        $this->statusCtrl->create(new \Acme\Repo\CertificateStatuses\Pending())->setStatus($request, Auth::user(), $status, '');

        return Redirect::action('AdminCertificateDashboardController@index')->with('success', 'Certificate Requested');
    }


    public function edit($id)
    {
        $request = $this->model->findOrFail($id);
        $types = ['' => 'Select Certificate type'] + $this->type->all()->lists('name', 'id');
        $metas = $this->meta->all();

        return View::make('admin.certificates.requests.edit', compact('types', 'metas', 'request'));
    }

    public function update($id)
    {
        $typePrice = $this->type->findOrFail(Input::get('type_id'));
        $options = array();
        foreach (Input::all() as $key => $value) {
            if (substr($key, 0, 9) == "option_id") {
                $options[$key] = $value;
                $optionPrice = $this->optionType->whereTypeId(Input::get('type_id'))->whereOptionId($value)->first();
                if($optionPrice) {
                    if($optionPrice->price > 0) {
                        $db_price[] = $value; // arrays to send for SUM ( addition on options tables )
                    }
                }
            }
        }
        $total = $this->calculateTotal($db_price, $typePrice->price);
        $validation = $this->model->find($id);
        $validation->fill(array_merge(array('amount' => $total), Input::except(array_keys($options))));
        if (! $validation->save()) {
            return Redirect::back()->withInput()->withErrors($validation->getErrors());
        }
        DB::table('certificate_request_options')->whereRequestId($validation->id)->delete();
        foreach ($options as $option_id) {
            if (! empty($option_id)) {
                $query = $this->request_option->whereRequestId($validation->id)->whereOptionId($option_id)->first();
                if ($query) {
                    $option = $this->request_option->find($query->id);
                } else {
                    $option = new $this->request_option;
                }
                $option->request_id = $validation->id;
                $option->option_id = $option_id;
                if (! $option->save()) {
                    return Redirect::action('AdminCertificateRequestsController@edit', $validation->id)->withInput()->withErrors($option->getErrors())->with(array('error' => 'please edit the options'));
                }
            }
        }

        return Redirect::action('AdminCertificateDashboardController@index')->with('success', 'Certificate Request Updated');

    }



    /**
     * @param $db_price
     * @param $typePrice
     * @return mixed
     */
    public function calculateTotal($db_price, $typePrice)
    {
        $optionPrice = $this->optionType->getPrice($db_price);
        $optionPrice = (float) round($optionPrice->total);
        $quantity = Input::get('quantity');

        $total = ($typePrice + $optionPrice) * $quantity;

        return $total;
    }

    public function printDetail($id) {
        $request = $this->model->with(array('user','type','status'))->find($id);
//        $pdf = PDF::loadView('admin.certificates.requests.detail',compact('request'));
//        return $pdf->download(str_random(10).'.pdf');
        return View::make('admin.certificates.requests.detail',compact('request'));

    }
}
