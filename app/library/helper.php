<?php
/**
 * Created by PhpStorm.
 * User: ZaL
 * Date: 2/12/14
 * Time: 11:40 AM
 */

/**
 * Class Helper
 * All Helper functions
 */
class Helper {
    public static  function isMod() {
        if (!(Entrust::hasRole('admin') || (Entrust::hasRole('moderator')))) // Checks the current user
        {
            return false;
        }
        return true;
    }

    public static  function isAdmin() {
        if (!(Entrust::hasRole('admin'))) // Checks the current user
        {
            return false;
        }
        return true;
    }

    public static  function isOwner($userId) {
        if (Auth::user()) {
            if (Auth::user()->getAuthIdentifier() === $userId) {
                return true;
            }
            return false;
        }
        return false;
    }

    public static function localed_en($col_en,$col_ar) {
       if(App::getLocale() == 'en') {
          if($col_en) {
              $title= $col_en;
          }
          $title= $col_ar;
       } else {
           $title = $col_ar;
       }
       return $title;

//        @if ( LaravelLocalization::getCurrentLocaleName() == 'English')
//            @if(!$event->description_en)
//        {{ Str::limit($event->description_en, 150) }}
//                @else
//                    {{ $event->description }}
//                @endif
//                @else
//                {{ Str::limit($event->description, 150) }}
//            @endif
    }
}
