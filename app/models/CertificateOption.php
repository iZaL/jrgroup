<?php

class CertificateOption extends BaseModel {
    protected $guarded = array();
    protected $table = "certificate_options";

    public static $rules = array(
        'meta_id' => 'required | integer',
        'name' => 'required'
    );

    public function type() {
        return $this->belongsToMany('CertificateType', 'certificate_option_type', 'option_id', 'type_id');
    }

    public function requests(){
        return $this->belongsToMany('CertificateRequest','certificate_request_options','option_id','request_id');
    }

    public function meta() {
        return $this->belongsTo('CertificateMeta','meta_id');
    }

}

