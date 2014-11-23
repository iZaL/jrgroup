<?php

class CertificateMeta extends BaseModel {

    use \Acme\Core\LocaleTrait;

    protected $localeStrings= ['name'];

    protected $guarded = array();
    protected $table = "certificate_metas";

    public static $rules = array(
        'name' => 'required'
    );

    public function options() {
        return $this->hasMany('CertificateOption','meta_id');
    }
}

