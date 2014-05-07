<?php

class CertificateRequest extends BaseModel {
    protected $guarded = array();
    protected $table = "certificate_requests";

    public static $rules = array(
        'type_id' => 'required | integer',
        'user_id' => 'required | integer',
        'quantity' => 'required | integer',
    );

    public function user() {
        return $this->belongsTo('User');
    }

    public function type() {
        return $this->belongsTo('CertificateType','type_id');
    }

    public function option() {
        return $this->belongsTo('CertificateOption','option_id');
    }

    public function statuses() {
        return $this->hasMany('CertificateStatus','certificate_id');
    }
}

