<?php namespace Acme\Video\Validators;

use Acme\Core\Validators\AbstractValidator;

class UpdateValidator extends AbstractValidator {

    /**
     * Validation rules
     *
     * @var array
     */
    protected $rules = array(
        'url' => 'url | required'
    );

    public function getInputData()
    {
        return array_only($this->inputData, [
            'title_ar','title_en','url','videoable_id','videoable_type','featured'
        ]);
    }

}

