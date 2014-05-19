<?php

class CertificateStatus extends BaseModel {
    protected $guarded = array();

    protected $table = "certificate_statuses";

    public static $rules = array(
        'request_id' => 'required | integer'
    );

    public function user() {
        return $this->belongsTo('User');
    }

//    public function certificate() {
//        return $this->belongsTo('CertificateRequest');
//    }

    public function request() {
        return $this->belongsTo('CertificateRequest');
    }

}

