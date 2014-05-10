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
    /**
     * @var CertificateType
     */
    private $type;
    /**
     * @var CertificateOptionType
     */
    private $optionType;

    public function __construct(CertificateOption $model,CertificateMeta $meta,CertificateType $type, CertificateOptionType $optionType )
    {
        $this->model = $model;
        $this->meta = $meta;
        parent::__construct();
        $this->type = $type;
        $this->optionType = $optionType;
    }

    public function index() {
        $records = $this->model->with(array('meta'))->get();
//        $records = $this->model->with(array('meta','type'))->get();
        return View::make('admin.certificates.options.index',compact('records'));
    }


    public function create() {
        $types = ['' => 'Select Certificate type'] +  $this->type->all()->lists('name','id');
        $metas = ['' => 'Select Option Category'] + $this->meta->all()->lists('name','id');
        return View::make('admin.certificates.options.create',compact('metas','types'));
    }
    public function store() {
        $validation = new $this->model(Input::except(array('type_id','price')));
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
        return Redirect::action('AdminCertificateOptionsController@index')->with(array('success'=>'Certificate Option Added'));
    }

    public function destroy($id)
    {
        $this->model->find($id)->delete();

        return Redirect::action('AdminCertificateOptionsController@index');
    }
}
