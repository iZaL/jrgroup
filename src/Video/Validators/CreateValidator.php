<?php namespace Acme\Video\Validators;

use Acme\Core\Validators\AbstractValidator;

class CreateValidator extends AbstractValidator {

    /**
     * Validation rules
     *
     * @var array
     */
    protected $rules = array(
        'url' => 'required|url',
    );

    public function getInputData()
    {
        return array_only($this->inputData, [
            'title_ar','title_en','url','videoable_id','videoable_type','featured'
        ]);
    }


}
