<?php
/**
 * Created by PhpStorm.
 * User: ZaL
 * Date: 5/21/14
 * Time: 7:08 PM
 */

namespace Acme\Services;

use Illuminate\Support\Facades\App;
use Symfony\Component\Security\Core\Exception\InvalidArgumentException;

class LangHelper {
    protected $localed;

    /**
     * @param $arabicString
     * @param $englishString
     * @return localedVersion
     * If Locale is English and English Content is Set, Returns English, else Returns Arabic
     */
    public function getLocaled($arabicString,$englishString) {
        if(App::getLocale() == 'en') {
            if($englishString) {
                $this->localed= $englishString;
            } else {
                $this->localed= $arabicString;
            }
        } else {
            $this->localed= $arabicString;
        }

        return $this->localed;
    }

    /**
     * css stylesheet for pulling left pulling right for locale
     */
    public function pullLeftRight() {
        if(App::getLocale() == 'en') {
            return 'pull-left';
        } else {
            return 'pull-right';
        }
    }

} 