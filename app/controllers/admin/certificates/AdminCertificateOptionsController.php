<?php

class AdminCertificateOptionsController extends AdminBaseController {

    protected $layout = 'site.layouts.home';

    protected $model;
    /**
     * @var CertificateOption
     */
    private $option;
    /**
     * @var CertificateMeta
     */
    private $meta;

    public function __construct(CertificateOption $model,CertificateMeta $meta )
    {
        $this->model = $model;
        $this->meta = $meta;
        parent::__construct();
    }

    public function index() {
        $metas = ['' => 'Select Option Category'] + $this->meta->all()->lists('name','id');
        return View::make('admin.certificates.options.create',compact('metas'));
    }


    public function create() {

    }
    public function store() {
        $validation = new $this->model(Input::all());
        if (!$validation->save())
        {
            return Redirect::back()->withInput()->withErrors($validation->getErrors());
        }
        return Redirect::action('AdminCertificateOptionsController@index')->with(array('success'=>'Certificate Option Added'));
    }

    public function edit($id) {
        $record = $this->model->findOrFail($id);
        $metas = ['' => 'Select Option Category'] + $this->meta->all()->lists('name','id');
        return View::make('admin.certificates.options.edit',compact('record','metas'));
    }

    public function update($id){
        $validation = $this->model->find($id);
        $validation->fill(Input::all());
        if(!$validation->save()) {
            return Redirect::back()->withInput()->withErrors($validation->getErrors());
        }
        return Redirect::action('AdminCertificateOptionsController@index');
    }
}
