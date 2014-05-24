<?php namespace Acme\Facades;

use Illuminate\Support\Facades\Facade;

class LocaleHelper extends Facade {

    /**
     * Name of binding in IoC container is...
     *
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'locale-helper';
    }

}
