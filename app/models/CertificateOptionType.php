<?php

class CertificateOptionType extends BaseModel {

    use \Acme\Core\LocaleTrait;

    protected $localeStrings= ['name'];

    protected $guarded = array();
    protected $table = "certificate_option_type";

    public static $rules = array(
        'option_id' => 'required | integer',
        'type_id' => 'required | integer',
        'price' => array('required', 'regex:/^\d*(\.\d{2})?$/')
    );

    public function type() {
        return $this->belongsTo('CertificateType');
    }
    public function option() {
        return $this->belongsTo('CertificateOption');
    }

    public function getPrice($ids = array()) {
        $price = DB::table('certificate_option_type')
                    ->select(DB::raw('SUM(price) as total'))
//                    ->whereIn('option_id',$ids)
                    ->whereIn('option_id',$ids)
                    ->first()
                    ;
        return $price;
    }



}

