<?php

class AdminCertificateTypesController extends AdminBaseController {
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

    public function __construct(CertificateType $type,CertificateMeta $meta, CertificateRequestOption $request_option, CertificateRequest $model, CertificateOption $option)
    {
        $this->type = $type;
        $this->meta = $meta;
        $this->request_option = $request_option;
        $this->model = $model;
        $this->option = $option;
        parent::__construct();
    }

    public function index() {
        $records = $this->type->all();
        return View::make('admin.certificates.types.index',compact('records'));
    }



    public function create() {
        return View::make('admin.certificates.types.create');
    }
    public function store() {
        $validation = new $this->type(Input::all());
        if (!$validation->save())
        {
            return Redirect::back()->withInput()->withErrors($validation->getErrors());
        }
        return Redirect::action('AdminCertificateTypesController@index')->with(array('success'=>'Certificate Type Added'));
    }

    public function edit($id) {
        $type = $this->type->findOrFail($id);
        return View::make('admin.certificates.types.edit',compact('type'));
    }

    public function update($id){
        $validation = $this->type->find($id);
        $validation->fill(Input::all());
        if(!$validation->save()) {
            return Redirect::back()->withInput()->withErrors($validation->getErrors());
        }
        return Redirect::action('AdminCertificateTypesController@index');
    }
}
