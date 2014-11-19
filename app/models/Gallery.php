<?php

class Gallery extends BaseModel {
	protected $guarded = [];
    protected  $table = "galleries";

    public function category() {
        return $this->belongsTo('Category','category_id')->where('type','=','Gallery');
    }

    public function photos() {
        return $this->morphMany('Photo','imageable');
    }
    public function videos() {
        return $this->morphMany('Video','videoable');
    }


}
