<?php

class CertificateMeta extends BaseModel {
    protected $guarded = array();
    protected $table = "certificate_metas";

    public static $rules = array(
        'name' => 'required'
    );

    public function options() {
        return $this->hasMany('CertificateOption','meta_id');
    }
}

