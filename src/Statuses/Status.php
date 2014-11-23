<?php namespace Acme\Statuses;

use Acme\Mail\SubscriptionMailer;
use AdminBaseController;

abstract class Status {
    protected $mailer;

    public function __construct() {
        $this->mailer = new SubscriptionMailer();
    }

}