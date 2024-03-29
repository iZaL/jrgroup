<?php

class CertificateType extends BaseModel {
    use \Acme\Core\LocaleTrait;

    protected $localeStrings= ['name'];
    protected $guarded = array();

    protected $table = "certificate_types";

    public static $rules = array(
        'name' => 'required',
        'price' => 'required | integer'
    );

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * Find all the options by Id
     */
    public function options() {
        return $this->belongsToMany('CertificateOption', 'certificate_option_type', 'type_id', 'option_id')->withPivot(array('option_id','type_id','price'));
    }


}

