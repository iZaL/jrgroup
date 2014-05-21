<?php

class AdminCertificateDashboardController extends AdminBaseController {

    protected $model;
    /**
     * @var CertificateOption
     */
    private $option;
    /**
     * @var CertificateRequest
     */
    private $request;
    /**
     * @var CertificateStatus
     */
    private $status;

    public function __construct(CertificateMeta $model,CertificateRequest $request,CertificateStatus $status)
    {
        $this->model = $model;
        parent::__construct();
        $this->request = $request;
        $this->status = $status;
    }

    public function index() {
        $requests = $this->request->with(array('user','type','status'))->latest()->get();
        return View::make('admin.certificates.index',compact('requests'));
    }


    public function create() {

    }
    public function store() {
        $validation = new $this->model(Input::all());
        if (!$validation->save())
        {
            return Redirect::back()->withInput()->withErrors($validation->getErrors());
        }
        return Redirect::action('AdminCertificateMetasController@index')->with(array('success'=>'Certificate Type Added'));
    }

    public function edit($id) {
        $record = $this->model->findOrFail($id);
        return View::make('admin.certificates.metas.edit',compact('record'));
    }

    public function update($id){
        $validation = $this->model->find($id);
        $validation->fill(Input::all());
        if(!$validation->save()) {
            return Redirect::back()->withInput()->withErrors($validation->getErrors());
        }
        return Redirect::action('AdminCertificateMetasController@index');
    }
}
