<?php

class CertificateOptionType extends BaseModel {
    protected $guarded = array();
    protected $table = "certificate_option_type";

    public static $rules = array(
        'option_id' => 'required | integer',
        'type_id' => 'required | integer',
        'price' => 'required | integer'
    );

    public function type() {
        return $this->belongsTo('CertificateType');
    }
    public function option() {
        return $this->belongsTo('CertificateOption');
    }
}

