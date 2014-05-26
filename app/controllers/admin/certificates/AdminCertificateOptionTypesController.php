<?php

class AdminCertificateOptionTypesController extends AdminBaseController {

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

    public function __construct(CertificateOptionType $model,CertificateMeta $meta,CertificateType $type, CertificateOption $option )
    {
        $this->model = $model;
        $this->meta = $meta;
        $this->type = $type;
        $this->option = $option;

        parent::__construct();
    }

    public function index() {
        $records = $this->model->with(array('type','option'))->get();
//        foreach ($records as $record) {
//            dd($record->options->meta->toArray());
//        }

//        $records = $this->model->with(array('meta','type'))->get();
        return View::make('admin.certificates.option-types.index',compact('records'));
    }


    public function create() {
        $types = ['' => 'Select Certificate type'] +  $this->type->all()->lists('name','id');
        $options = ['' => 'Select Certificate option'] +  $this->option->all()->lists('name','id');
//        $metas = ['' => 'Select Option Category'] + $this->meta->all()->lists('name','id');
        return View::make('admin.certificates.option-types.create',compact('options','types'));
    }
    public function store() {
        $validation = new $this->model(Input::all());
        $query = $this->model->whereTypeId(Input::get('type_id'))->whereOptionId(Input::get('option_id'))->first();
        if($query) {
            return $this->update($query->id)->with(Input::all());
        }
        if (!$validation->save())
        {
            return Redirect::back()->withInput()->withErrors($validation->getErrors());
        }
        return Redirect::action('AdminCertificateOptionTypesController@index')->with(array('success'=>'Certificate Option Price Added'));
    }

//    public function edit($id) {
//        $record = $this->model->findOrFail($id);
//        if(count($record->type)) {
//            $type  = $record->type[0]->id;
//            $price = $record->type[0]->price;
//        } else {
//            $type  = NULL;
//            $price = NULL;
//        }
//        $types = ['' => 'Select Certificate type'] + $this->type->all()->lists('name','id');
//        $metas = ['' => 'Select Option Category'] + $this->meta->all()->lists('name','id');
//        return View::make('admin.certificates.options.edit',compact('record','metas','types','type','price'));
//    }

    public function edit($id) {
        $record = $this->model->with(array('type','option'))->findOrFail($id);
        return View::make('admin.certificates.option-types.edit',compact('record'));
    }

    public function update($id){
        $validation = $this->model->find($id);
        $validation->fill(Input::except(array('type_id','option_id')));
        if(!$validation->save()) {
            return Redirect::back()->withInput()->withErrors($validation->getErrors());
        }
        return Redirect::action('AdminCertificateOptionTypesController@index')->with(array('success'=>'Certificate Price Updated'));
    }
//    public function update($id){
//        $validation = $this->model->find($id);
//        $validation->fill(Input::except(array('type_id','price')));
//        if(!$validation->save()) {
//            return Redirect::back()->withInput()->withErrors($validation->getErrors());
//        }
//        $type_id = Input::get('type_id');
//        if(empty($type_id)) {
//            return Redirect::action('AdminCertificateOptionsController@edit',$validation->id)->withInput()->withErrors('Please select Option Type');
//        }
//        $query = $this->optionType->whereTypeId(Input::get('type_id'))->whereOptionId(Input::get('option_id'))->first();
//        if($query) {
//            $option_type = $this->optionType->find($query->id);
//            $option_type->option_id =$query->id;
//        } else {
//            $option_type = new $this->optionType;
//            $option_type->option_id =  $validation->id;
//        }
//        $option_type->type_id = Input::get('type_id');;
//        $option_type->price = Input::get('price');
//        if(!$option_type->save()) {
//            return Redirect::action('AdminCertificateOptionsController@edit',$id)->withErrors($option_type->getErrors())->withInput();
//        }
//        return Redirect::action('AdminCertificateOptionsController@index')->with(array('success'=>'Certificate Price Updated'));
//    }

    public function destroy($id)
    {
        $this->model->find($id)->delete();

        return Redirect::action('AdminCertificateOptionTypesController@index');
    }

    public function getPrice($typeId,$optionId){
        $optionType = $this->model->where('type_id',$typeId)->where('option_id',$optionId)->first();
        if($optionType)
            return (float)round($optionType->price);
        return 0;
    }
}
