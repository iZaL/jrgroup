<?php
/**
 * Created by PhpStorm.
 * User: ZaL
 * Date: 5/2/14
 * Time: 3:28 AM
 */

namespace Acme\Repo\CertificateStatuses;


use Acme\Repo\Statuses\Status;
use Acme\Repo\Statuses\StatusInterface;
use Redirect;

class Rejected extends Status implements StatusInterface {
    public function __construct() {
        parent::__construct();
    }
    public function setAction($request, $user, $status,$reason)
    {
        $status->status = 'REJECTED';
        if( $status->save()) {
            $args['subject'] = 'JRGroup Certificate Submission';

            if(!empty($reason)) {
                $args['body'] = $reason;
            } else {
                $args['body'] = 'Your Request for '.$request->type->name.' Certificate has been rejected ';
            }
            if($this->mailer->sendMail($user, $args)) {
                return Redirect::action('AdminCertificateDashboardController@index')->with(array('success'=>'Success'));
            } else {
                return Redirect::action('AdminCertificateDashboardController@index')->with(array('error'=>'Error please try again'));
            }
        }
    }

}