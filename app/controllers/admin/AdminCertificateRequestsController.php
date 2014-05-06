<?php

class AdminCertificateRequestsController extends AdminBaseController {

    protected $layout = 'site.layouts.home';
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

    public function __construct(CertificateType $type,CertificateMeta $meta, CertificateRequestOption $request_option, CertificateRequest $model)
    {
        $this->type = $type;
        $this->meta = $meta;
        $this->request_option = $request_option;
        $this->model = $model;

        parent::__construct();
    }

    public function index() {
        $types = [0 => 'Select Certificate type'] + $this->type->all()->lists('name','id');
        $metas = $this->meta->all();

        return View::make('admin.certificates.requests.create',compact('types','metas'));
    }

    public function create() {


    }
    public function store() {
        $options = array();
        foreach(Input::all() as $key=>$value) {
            if(substr($key,0,9) == "option_id") {
                $options[$key] = $value ;
            }
        }
        $validation = new $this->model(Input::except(array_keys($options)));
        if (!$validation->save())
        {
            return Redirect::back()->withInput()->withErrors($validation->getErrors());
        }
        foreach($options as  $option_id) {
            $query = $this->request_option->whereRequestId($validation->id)->whereOptionId($option_id)->first();
            if($query) {
                $option = $this->request_option->find($query->id);
            } else {
                $option = new $this->request_option;
            }
            $option->request_id = $validation->id;
            $option->option_id = $option_id;
            if(!$option->save()) {
                return Redirect::back()->withInput()->withErrors($validation->getErrors());
            }
        }
        return parent::redirectToAdmin();
    }
}
