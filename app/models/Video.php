<?php
use Intervention\Image\Facades\Image;

class Video extends BaseModel {

    protected $image_path;

    protected $guarded = array('id');
    public static $rules = array(
        'name' => 'required'
    );
    protected static function boot()
    {
        static::saved(function($model)
        {
//            if($model->videoable_type=='Video') {
//                Cache::forget('cache.ad1');
//                Cache::forget('cache.ad2');
//            }
        });
        parent::boot();
    }


    public function videoable()
    {
        return $this->morphTo();
    }

    public  function attachVideo($id,$name, $type, $featured='0',$site) {
        $data = Video::where('videoable_id',$id)->where('videoable_type',$type)->where('name', $name)->first();
        if(!$data) {
            $data = new Video();
        }
        try {
            $data->name = $name;
            $data->videoable_id = $id;
            $data->videoable_type = $type;
            $data->featured = $featured;
            $data->site = $site;
            $data->save();
            return true;
        } catch (\Exception $e) {
            // invalid iamges
            $this->errors = $e->getMessage();
            return false;
        }
    }

}
