<?php
/**
 * Created by PhpStorm.
 * User: ZaL
 * Date: 5/21/14
 * Time: 7:08 PM
 */

namespace Acme\Services;


use Illuminate\Support\Facades\App;

class LangHelper {
    protected $localed;
    private $locale;

    public function __construct() {
        $this->locale = App::getLocale();
    }

    /**
     * @param $arabicString
     * @param $englishString
     * @return localedVersion
     * If Locale is English and English Content is Set, Returns English, else Returns Arabic
     */
    public function getLocaled($arabicString,$englishString) {
        if($this->locale == 'en') {
            if($englishString) {
                $this->localed= $englishString;
            }
            $this->localed= $arabicString;
        } else {
            $this->localed= $arabicString;
        }
        return $this->localed;
    }

} 