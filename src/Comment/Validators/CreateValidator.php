<?php namespace Acme\Comment\Validators;

use Acme\Core\Validators\AbstractValidator;

class CreateValidator extends AbstractValidator {

    /**
     * Validation rules
     *
     * @var array
     */
    protected $rules = array(
        'content' => 'required'
    );

    public function getInputData()
    {
        return array_only($this->inputData, [
            'content','user_id'
        ]);
    }
}
