<?php namespace Acme\EventModel\Validators;

use Acme\Core\Validators\AbstractValidator;

class CreateValidator extends AbstractValidator {

    /**
     * Validation rules
     *
     * @var array
     */
    protected $rules = [
        'title_ar'       => 'required',
        'description_ar' => 'required',
        'user_id'        => 'required',
        'category_id'    => 'required',
        'location_id'    => 'required',
        'free'           => 'required_if:price,0',
        'price'          => 'numeric',
        'package_id'     => 'numeric|between:1,1000',
        'date_start'     => 'date|required',
        'date_end'       => 'date|required',
        'total_seats'    => 'numeric'
    ];

    /**
     * Get the prepared input data.
     *
     * @return array
     */
    public function getInputData()
    {
        return array_only($this->inputData, [
            'user_id', 'category_id', 'location_id', 'title_ar', 'title_en', 'description_ar', 'description_en', 'total_seats', 'free', 'price', 'date_start', 'date_end', 'address_ar', 'street_ar', 'address_en', 'street_en', 'phone', 'email', 'latitude', 'longitude', 'button_ar', 'button_en', 'package_id','featured'
        ]);
    }

}
