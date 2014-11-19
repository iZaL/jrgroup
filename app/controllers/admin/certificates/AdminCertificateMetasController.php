<?php

class AdminCertificateMetasController extends AdminBaseController {

    protected $model;
    /**
     * @var CertificateOption
     */
    private $option;

    public function __construct(CertificateMeta $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function index() {
        $records = $this->model->all();
        return View::make('admin.certificates.metas.index',compact('records'));
    }


    public function create() {
        $records = ['' => 'Select Certificate Meta'] + $this->model->all()->lists('name','id');
        return View::make('admin.certificates.metas.create',compact('records'));
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
