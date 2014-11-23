<?php namespace Acme\CertificateStatuses;

use Acme\Statuses\Status;
use Redirect;

class Confirmed extends Status {

    public function __construct() {
        parent::__construct();
    }
    public function setAction($request, $user, $status,$reason)
    {
        $status->status = 'CONFIRMED';
        if ($status->save()) {
            $args['subject'] = 'JRGroup Certificate Submission';
            if(!empty($reason)) {
                $args['body'] = $reason;
            } else {
                $args['body'] = 'Your Certificate Request of '.$request->type->name.' has been confirmed. total amount is '. (float)round($request->amount).' KD ';
            }
            if($this->mailer->sendMail($user, $args)) {
                return Redirect::action('AdminCertificateDashboardController@index')->with(array('success'=>'Success'));
            } else {
                return Redirect::action('AdminCertificateDashboardController@index')->with(array('error'=>'Error please try again'));
            }
        } else {
            return Redirect::action('AdminCertificateDashboardController@index')->with(array('error'=>'Error please try again'));
        }

    }
}