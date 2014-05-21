<?php

class HomeController extends BaseController {


    /**
     * @var EventModel
     */
    private $event;

    public function __construct(EventModel $event){

        $this->event = $event;
        parent::__construct();

    }
	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

    public function index()
    {
        $event = $this->event->with('photos')->whereHas('photos',function($q) {
                $q->where('photos.id','>','1');
            })
            ->where('events.date_start','<', Carbon::now()->toDateTimeString())
            ->orderBy('events.date_start','DESC')
            ->limit(1)
            ->get(array('events.id','events.title'))
            ->first()
        ;
//        dd($event->toArray());
        return $this->view('site.home',compact('event'));
    }
}