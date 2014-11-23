<?php namespace Acme\Statuses;

interface StatusInterface {
    public function setAction($event,$user,$status,$reason);
}