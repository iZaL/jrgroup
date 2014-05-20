<?php

class Gallery extends BaseModel {
	protected $guarded = array();
    protected  $table = "galleries";

    public static $rules = array(
        'event_id' => 'integer',
        'category_id' => 'integer | required'
    );

//    public function type() {
//        return $this->type();
//    }

    public function category() {
        return $this->belongsTo('Category','category_id');
    }

    public function getDates()
    {
        return array_merge(array(static::CREATED_AT, static::UPDATED_AT, static::DELETED_AT), array('date_start'));
    }

    public function setDateStartAttribute($value)
    {
        $this->attributes['date_start'] = $this->dateStringToCarbon($value);
    }
    public function photos() {
        return $this->morphMany('Photo','imageable');
    }
    public function videos() {
        return $this->morphMany('Video','videoable');
    }

}
