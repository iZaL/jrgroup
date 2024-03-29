<?php namespace Acme\Contact\Validators;

use Acme\Core\Validators\AbstractValidator;

class UpdateValidator extends AbstractValidator {

    /**
     * Validation rules
     *
     * @var array
     */
    protected $rules = array(
        'name_ar' => 'required',
        'address_ar' => 'required',
        'email' => 'required',
        'mobile' => 'required',
        'phone' => 'required'
    );

    public function getInputData()
    {
        return array_only($this->inputData, [
            'name_ar','name_en','address_ar','address_en','email','phone','mobile'
        ]);
    }
}
