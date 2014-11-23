<?php

class CertificateRequestOption extends BaseModel {
    use \Acme\Core\LocaleTrait;

    protected $localeStrings= ['name'];
    protected $guarded = array();
    protected $table = "certificate_request_options";

    public static $rules = array(
        'option_id' => 'required  | integer'
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

    public function optionType() {
        return $this->belongsTo('CertificateOptionType','option_id','option_id');
    }

    public function statuses() {
        return $this->hasMany('CertificateStatus','certificate_id');
    }

    public function getPriceSingle($type_id,$option_id) {
        $price = DB::table('certificate_option_type')
            ->select('price')
            ->where('option_id',$option_id)
            ->where('type_id', $type_id)
            ->first()
        ;
        return $price;
    }

}

