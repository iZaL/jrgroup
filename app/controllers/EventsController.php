<?php

use Acme\Mail\EventsMailer;
use Illuminate\Support\Facades\Auth;

class EventsController extends BaseController {

    protected $model;
    protected $user;
    protected $mailer;
    protected $category;
    protected $photo;
    protected $currentTime;

    function __construct(EventModel $model, User $user, EventsMailer $mailer, Category $category, Photo $photo)
    {
        $this->model = $model;
        $this->user = $user;
        $this->mailer = $mailer;
        $this->category = $category;
        $this->photo = $photo;
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */


    public function index()
    {
        $events = $this->model->with('photos')
            ->where('date_start', '>', \Carbon\Carbon::now()->toDateTimeString())
            ->orderBy('date_start', 'ASC')
            ->orderBy('created_at', 'DESC')
            ->paginate(9);

        return $this->view('site.events.index', compact('events'));
    }

    /**
     * Display the event by Id and the regardig comments.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $event = $this->model->with('comments', 'author', 'photos', 'subscribers', 'followers', 'favorites')->findOrFail($id);
        $this->view('site.events.view', compact('event'));

        if (Auth::check()) {
            $user = Auth::user();
            View::composer('site.events.view', function ($view) use ($id, $user) {
                $subscribed = Subscription::isSubscribed($id, $user->id);
                $view->with(['subscribed' => $subscribed]);

            });
        } else {
            View::composer('site.events.view', function ($view) {
                $view->with(['subscribed' => false]);
            });
        }
    }

    /**
     * @param object $event
     * @return integer
     */
    protected function availableSeats($event)
    {
        //        $total_seats = $event->total_seats;
        ////        dd($total_seats);
        //        $seats_taken = $event->subscriptions->count();
        //        dd($seats_taken);
        //
        //        $available_seats = $total_seats - $seats_taken;
        //        // $available_seats = $seats_taken;
        //        // dd($available_seats);
        //        return $available_seats->getAvailableSeats();
        return $event->available_seats;
    }

    public function getSliderEvents()
    {
        // fetch 3 latest post
        // fetches 2 featured post
        // order by event date, date created, featured
        // combines them into one query to return for slider

        $latestEvents = $this->model->latestEvents();
        $featuredEvents = $this->model->feautredEvents();
        $events = array_merge((array) $latestEvents, (array) $featuredEvents);
        if ($events) {
            foreach ($events as $event) {
                $array[] = $event->id;
            }
            $events_unique = array_unique($array);
            $sliderEvents = $this->model->getSliderEvents(6, $events_unique);

            return $sliderEvents;
        } else {
            return null;
        }

    }

    public function isTheAuthor($user)
    {
        return $this->author_id === $user->id ? true : false;
    }

    public function getAuthor($id)
    {
        $event = $this->model->find($id);
        $author = $event->author;

        return $author;
    }

    /**
     * Return Events For Event Index Page
     * @param $perPage
     * @return mixed
     *
     */
    public function getEvents($perPage)
    {
        return $this->model
            ->with(array('category', 'location.country', 'photos', 'author'))
            ->where('date_start', '>', $this->currentTime)->orderBy('date_start', 'DESC')
            ->paginate($perPage);
    }

}
