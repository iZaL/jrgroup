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

    /* @param eventId $id
     * @return boolean
     * Subscribe an User to the Event
     */
    public function subscribe($id)
    {
        //check whether user logged in
        $user = Auth::user();
        if (! empty($user->id)) {
            $event = $this->model->findOrFail($id);

            if (Subscription::isSubscribed($id, $user->id)) {
                // return you are already subscribed to this event
                return Response::json(array(
                    'success' => false,
                    'message' => Lang::get('site.subscription.already_subscribed', array('attribute' => 'subscribed'))
                ), 400);
            }
            //get available seats
            $available_seats = $this->availableSeats($event);
            // $available_seats = $event->available_seats;
            //check whether seats are empty
            if ($available_seats >= 1) {
                // subscribe this user
                $event->subscriptions()->attach($user);
                //update the event seats_taken colum
                $event->available_seats = $available_seats - 1;
                $event->save();

                return Response::json(array(
                    'success' => true,
                    'message' => Lang::get('site.subscription.subscribed', array('attribute' => 'subscribed'))
                ), 200);
            }

            // notify no seats available
            return Response::json(array(
                'success' => false,
                'message' => Lang::get('site.subscription.no_seats_available')
            ), 400);

        }

        // notify user not authenticated
        return Response::json(array(
            'success' => false,
            'message' => Lang::get('site.subscription.not_authenticated')
        ), 401);

    }


    /**
     * @param $id eventId
     * @return boolean true false
     * Unsubscribe a User from an event
     */
    public function unsubscribe($id)
    {
        // check whether user authenticated
        $event = $this->model->findOrFail($id);
        $user = Auth::user();
        if (! empty($user->id)) {
            if (Subscription::isSubscribed($event->id, $user->id)) {
                // check whether user already subscribed
                if (Subscription::unsubscribe($event->id, $user->id)) {

                    // reset available seats
                    $event->available_seats = $event->available_seats + 1;
                    $event->save();

                    return Response::json(array(
                        'success' => true,
                        'message' => Lang::get('site.subscription.unsubscribed', array('attribute' => 'unsubscribed'))
                    ), 200);

                } else {
                    return Response::json(array(
                        'success' => false,
                        // could not unsubscribe
                        'message' => Lang::get('site.subscription.error', array('attribute' => 'unsubscribe'))
                    ), 500);
                }
            } else {
                // wrong access
                return Response::json(array(
                    'success' => false,
                    'message' => Lang::get('site.subscription.not_subscribed', array('attribute' => 'subscribed'))
                ), 400);
            }
        } else {
            return Response::json(array(
                'success' => false,
                'message' => Lang::get('site.subscription.not_authenticated')
            ), 403);
        }

    }

    /**
     * @param $id eventId
     * @return boolean
     * User to Follow an Event
     */
    public function follow($id)
    {
        //check whether user logged in
        $user = Auth::user();
        if (! empty($user->id)) {
            //check whether seats are empty
            $event = $this->model->findOrFail($id);

            if (Follower::isFollowing($id, $user->id)) {
                // return you are already subscribed to this event
                return Response::json(array(
                    'success' => false,
                    'message' => Lang::get('site.subscription.already_subscribed', array('attribute' => 'following'))
                ), 400);
            }
            $event->followers()->attach($user);

            return Response::json(array(
                'success' => true,
                'message' => Lang::get('site.subscription.subscribed', array('attribute' => 'following'))
            ), 200);

        }

        // notify user not authenticated
        return Response::json(array(
            'success' => false,
            'message' => Lang::get('site.subscription.not_authenticated')
        ), 403);

    }

    public function unfollow($id)
    {
        //check whether user logged in
        $user = Auth::user();
        if (! empty($user->id)) {
            //check whether seats are empty
            $event = $this->model->findOrFail($id);

            if (Follower::isFollowing($id, $user->id)) {
                // return you are already subscribed to this event

                if (Follower::unfollow($id, $user->id)) {
                    return Response::json(array(
                        'success' => true,
                        'message' => Lang::get('site.subscription.unsubscribed', array('attribute' => 'unfollowed'))
                    ), 200);
                } else {
                    return Response::json(array(
                        'success' => false,
                        'message' => Lang::get('site.subscription.error', array('attribute' => 'unfollowing'))
                    ), 500);
                }
            }

            return Response::json(array(
                'success' => false,
                'message' => Lang::get('site.subscription.not_subscribed', array('attribute' => 'following'))
            ), 400);

        }

        // notify user not authenticated
        return Response::json(array(
            'success' => false,
            'message' => Lang::get('site.subscription.not_authenticated')
        ), 403);

    }

    /**
     * @param $id eventId
     * @return boolean
     * User to Follow an Event
     */
    public function favorite($id)
    {
        //check whether user logged in
        $user = Auth::user();
        if (! empty($user->id)) {
            //check whether seats are empty
            $event = $this->model->findOrFail($id);

            if (Favorite::hasFavorited($id, $user->id)) {
                // return you are already subscribed to this event
                return Response::json(array(
                    'success' => false,
                    'message' => Lang::get('site.subscription.already_subscribed', array('attribute' => 'favorited'))
                ), 400);
            }

            $event->favorites()->attach($user);

            return Response::json(array(
                'success' => true,
                'message' => Lang::get('site.subscription.subscribed', array('attribute' => 'favorited'))
            ), 200);

        }

        // notify user not authenticated
        return Response::json(array(
            'success' => false,
            'message' => Lang::get('site.subscription.not_authenticated')
        ), 403);

    }

    public function unfavorite($id)
    {
        //check whether user logged in
        $user = Auth::user();
        if (! empty($user->id)) {
            //check whether seats are empty
            $event = $this->model->findOrFail($id);

            if (Favorite::hasFavorited($id, $user->id)) {
                // return you are already subscribed to this event

                if (Favorite::unfavorite($id, $user->id)) {
                    return Response::json(array(
                        'success' => true,
                        'message' => Lang::get('site.subscription.unsubscribed', array('attribute' => 'unfavorited'))
                    ), 200);
                } else {
                    return Response::json(array(
                        'success' => false,
                        'message' => Lang::get('site.subscription.error', array('attribute' => 'unfavorite'))
                    ), 500);
                }
            }

            return Response::json(array(
                'success' => false,
                'message' => Lang::get('site.subscription.not_subscribed', array('attribute' => 'favorited'))
            ), 400);
        }

        return Response::json(array(
            'success' => false,
            'message' => Lang::get('site.subscription.not_authenticated')
        ), 403);

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
