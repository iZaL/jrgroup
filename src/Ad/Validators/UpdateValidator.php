<?php namespace Acme\Ad\Validators;

use Acme\Core\Validators\AbstractValidator;

class UpdateValidator extends AbstractValidator {

    protected $rules = array(
        'title_ar'       => 'required',
        'url'    => 'required|url'
    );

    public function getInputData()
    {
        return array_only($this->inputData, [
            'title_ar','title_en','url'
        ]);
    }
}

