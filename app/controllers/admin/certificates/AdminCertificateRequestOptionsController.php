<?php

class AdminCertificateRequestOptionsController extends AdminBaseController {

    protected $layout = 'site.layouts.home';

    protected $model;

    public function __construct(CertificateRequestOption $model)
    {

        parent::__construct();
        $this->model = $model;
    }

    public function destroy($id){
        
    }
}
