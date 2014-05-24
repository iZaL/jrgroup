<?php

class Category extends BaseModel {
	protected $guarded = array();
    protected  $table = "categories";

    public static $rules = array(
        'name' => 'required',
        'type' => 'required'
    );

    public static function getEventCategories() {
        //get_all categories for events
//        return $this->morphedByMany('EventModel','Post');
//        return $this->morphedByMany('EventModel','categorizable','categories','id');
        return DB::table('categories')->where('type','=', 'EventModel');
    }
    public static function getPostCategories() {
        return DB::table('categories')->where('type','=', 'Post');
    }

    public  function getGalleryCategories() {
//        return DB::table('categories')->where('type','=', 'Gallery');
        return $this->where('type','=','Gallery');
    }

//    public  function galleries(){
//        return $this->hasMany('Gallery');
//    }
    public function galleryPosts(){
        return $this->hasMany('Gallery');
    }

    public function galleries(){
        return $this->hasMany('Gallery')->with('photos')->latest()->whereHas('photos',function ($q) {
            $q->where('id','>','0')->latest()->take(1)
            ;
        });
    }

    public function type() {
        return $this->type;
    }

}
