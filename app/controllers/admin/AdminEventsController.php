<?php

use Acme\Mail\EventsMailer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AdminEventsController extends AdminBaseController
{

    protected $model;
    protected $user;
    protected $mailer;
    protected $category;
    protected $photo;


    function __construct(EventModel $model, User $user, EventsMailer $mailer, Category $category, Photo $photo)
    {
        $this->model = $model;
        $this->user = $user;
        $this->mailer = $mailer;
        $this->category = $category;
        $this->photo = $photo;
        parent::__construct();
        $this->beforeFilter('Admin', array('except' => array('index','settings','getFollowers','getFavorites','getSubscriptions')));
//      $this->beforeFilter('Admin', array('on' => array('store','update','destroy','mailFollowers', 'mailFavorites','mailSubscribers')
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    // master layout

    public function index()
    {
        $events = parent::all();
        $statuses = Status::all();
        return View::make('admin.events.index', compact('events'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $category = $this->category->getEventCategories()->lists('name', 'id');
        $author = $this->user->getRoleByName('author')->lists('username', 'id');
        $location = Location::all()->lists('name', 'id');
        $country = Country::all()->lists('name', 'id');
        return View::make('admin.events.create', compact('category', 'author', 'location','country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //validate and save
        $validation = new $this->model(Input::except(array('thumbnail','addresspicker_map','type','approval_type')));
        if (!$validation->save()) {
            return Redirect::back()->withInput()->withErrors($validation->getErrors());
        }
        // if file is uploaded, try to attach it and save it the db
        if(Input::hasFile('thumbnail')) {
            // call the attach image function from Photo class
            if(!$this->photo->attachImage($validation->id,Input::file('thumbnail'),'EventModel','1')) {
                return Redirect::to('admin/event/' . $validation->id . '/edit')->withErrors($this->photo->getErrors());
            }
        }

        $type = new Type();
        $type->event_id= $validation->id;
        $type->type = Input::get('type');
        $type->approval_type = Input::get('approval_type');

        if (!$type->save()) {
            return Redirect::to('admin/event/' . $validation->id . '/edit')->withErrors($type->getErrors());
        }

        //update available seats
        $event = $this->model->find($validation->id);
        if(!empty($event->total_seats))
            $event->available_seats = $event->total_seats;
            $event->save();
        return parent::redirectToAdmin()->with('success','Added Event to the Database');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        {
            $event = $this->model->with('photos','type')->find($id);
            $category = $this->category->getEventCategories()->lists('name', 'id');
            $author = $this->user->getRoleByName('author')->lists('username', 'id');
            $location = Location::all()->lists('name', 'id');
            $country = Country::all()->lists('name', 'id');
            return View::make('admin.events.edit', compact('event', 'category', 'author', 'location','country'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $validation = $this->model->find($id);
        $validation->fill(Input::except(array('thumbnail','addresspicker_map','type','approval_type')));
        if (!$validation->save()) {
            return Redirect::back()->withInput()->withErrors($validation->getErrors());
        }
        if (Input::hasFile('thumbnail')) {
            if(!$this->photo->attachImage($validation->id,Input::file('thumbnail'),'EventModel','1')) {
                return Redirect::back()->withErrors($this->photo->getErrors());
            }
        }

        //update type
        $type = Type::where('event_id',$id)->first();
        if(!$type) {
            $type = new Type();
            $type->event_id = $id;
        }
        $type->type = Input::get('type');
        $type->approval_type = Input::get('approval_type');
        if (!$type->save()) {
            return Redirect::to('admin/event/' . $validation->id . '/edit')->withErrors($type->getErrors());
        }

        //update available seats
        $event = $this->model->find($validation->id);
        $total_seats = $event->total_seats;
        $total_seats_taken = Subscription::findEventCount($event->id);
        $available_seats = $total_seats - $total_seats_taken;
        $event->available_seats = $available_seats;
        $event->save();
        return parent::redirectToAdmin()->with('success','Updated Event '. $validation->title);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        if ($this->model->findOrFail($id)->delete()) {
            //  return Redirect::home();
            return parent::redirectToAdmin()->with('success','Event Deleted');
        }
        return parent::redirectToAdmin()->with('error','Error: Event Not Found');
    }


    /**
     * @param $id
     * @return statement
     * Send Notification Email for the Event Followers
     */

    public function mailFollowers($id)
    {
        $event = $this->model->find($id)->followers;
        try {
            $this->mailer->sendMail($event,Input::all());
        } catch(\Exception $e) {
            return Redirect::back()->with('error','Email Could not send');
        }
        return Redirect::back()->with('success','Email Sent');
    }

    public function mailFavorites($id)
    {
        $event = $this->model->find($id)->favorites;
        try {
           $this->mailer->sendMail($event,Input::all());
        } catch(\Exception $e) {
            return Redirect::back()->with('error','Email Could not send');
        }
        return Redirect::back()->with('success','Email Sent');
    }
    public function mailSubscribers($id)
    {
        $event = $this->model->find($id)->subscribers;
        try {
            $this->mailer->sendMail($event,Input::all());
        } catch(\Exception $e) {
            return Redirect::back()->with('error','Email Could not send');
        }
        return Redirect::back()->with('success','Email Sent');
    }

    public function settings($id)
    {
        $event = $this->model->find($id);
        $subscriptions_count =$event->subscriptions()->count();
        $favorites_count =$event->favorites()->count();
        $followers_count =$event->followers()->count();
        $requests_count = $event->statuses()->count();
        return View::make('admin.events.settings',compact('event','subscriptions_count','favorites_count','followers_count','requests_count'));
    }
    /**
     * @param $id
     * @return mixed
     * Returns the Followers For the Post, Event
     */
    public function getFollowers($id)
    {
        $users = $this->model->find($id)->followers;
        $event = $this->model->find($id);
        return View::make('admin.events.followers',compact('users','event'));
    }

    /**
     * @param $id
     * @return mixed
     * Returns the Favorites For the Post, Event
     */
    public function getFavorites($id)
    {
        $users = $this->model->find($id)->favorites;
        $event = $this->model->find($id);
        return View::make('admin.events.favorites',compact('users','event'));
    }

    /**
     * @param $id
     * @return mixed
     * Returns the Subscriptions For the Post, Event
     */
    public function getSubscriptions($id)
    {
        $users = $this->model->find($id)->subscriptions;
        $event = $this->model->find($id);
        return View::make('admin.events.subscriptions',compact('users','event'));
    }

    public function getRequests($id)
    {
        $event = $this->model->with('statuses')->find($id);
        return View::make('admin.events.requests',compact('event'));
    }



}
