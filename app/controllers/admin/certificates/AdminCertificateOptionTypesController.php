<?php

class AdminCertificateOptionTypesController extends AdminBaseController {

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
        $records = $this->type->with(array('options.meta'))->get();
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
        $type_id = Input::get('type_id');
        if(empty($type_id)) {
            return Redirect::action('AdminCertificateOptionsController@edit',$validation->id)->withInput()->withErrors('Please fix errors');
        }
        $option_type = new $this->optionType;
        $option_type->option_id = $validation->id;
        $option_type->type_id = Input::get('type_id');
        $option_type->price = Input::get('price');
        if(!$option_type->save()) {
            return Redirect::action('AdminCertificateOptionsController@edit',$validation->id)->withInput()->withErrors($option_type->getErrors());

        }
        return Redirect::action('AdminCertificateOptionsController@index')->with(array('success'=>'Certificate Option Added'));
    }

    public function edit($id) {
        $record = $this->model->findOrFail($id);
        if(count($record->type)) {
            $type  = $record->type[0]->id;
            $price = $record->type[0]->price;
        } else {
            $type  = NULL;
            $price = NULL;
        }
        $types = ['' => 'Select Certificate type'] + $this->type->all()->lists('name','id');
        $metas = ['' => 'Select Option Category'] + $this->meta->all()->lists('name','id');
        return View::make('admin.certificates.options.edit',compact('record','metas','types','type','price'));
    }

    public function update($id){
        $validation = $this->model->find($id);
        $validation->fill(Input::except(array('type_id','price')));
        if(!$validation->save()) {
            return Redirect::back()->withInput()->withErrors($validation->getErrors());
        }
        $type_id = Input::get('type_id');
        if(empty($type_id)) {
            return Redirect::action('AdminCertificateOptionsController@edit',$validation->id)->withInput()->withErrors('Please select Option Type');
        }
        $query = $this->optionType->whereTypeId(Input::get('type_id'))->whereOptionId(Input::get('option_id'))->first();
        if($query) {
            $option_type = $this->optionType->find($query->id);
            $option_type->option_id =$query->id;
        } else {
            $option_type = new $this->optionType;
            $option_type->option_id =  $validation->id;
        }
        $option_type->type_id = Input::get('type_id');;
        $option_type->price = Input::get('price');
        if(!$option_type->save()) {
            return Redirect::action('AdminCertificateOptionsController@edit',$id)->withErrors($option_type->getErrors())->withInput();
        }
        return Redirect::action('AdminCertificateOptionsController@index')->with(array('success'=>'Certificate Option Added'));
    }
}
