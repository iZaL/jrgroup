<?php

class AdminCertificateDashboardController extends AdminBaseController {

    protected $layout = 'site.layouts.home';

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
        return View::make('admin.certificates.index');
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
