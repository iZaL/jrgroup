<?php

class CertificateRequestOption extends BaseModel {
    protected $guarded = array();
    protected $table = "certificate_request_options";

    public static $rules = array(
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

