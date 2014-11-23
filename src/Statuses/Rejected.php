<?php namespace Acme\Statuses;

use Redirect;

class Rejected extends Status {
    public function __construct() {
        parent::__construct();
    }
    public function setAction($event, $user, $status,$reason)
    {
        $status->status = 'REJECTED';
        if( $status->save()) {
            $event->subscriptions()->detach($user);
            $event->updateSeats();
            $args['subject'] = 'Kaizen Event Subscription';

            if(!empty($reason)) {
                $args['body'] = $reason;
            } else {
                $args['body'] = 'Your Request have been rejected for the event ' . $event->title;
            }
            if($this->mailer->sendMail($user, $args)) {
                return Redirect::action('AdminStatusesController@index')->with(array('success'=>'Success'));
            } else {
                return Redirect::action('AdminStatusesController@index')->with(array('error'=>'Error please try again'));
            }
        }
    }
}