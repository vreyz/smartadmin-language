<?php


namespace Vreyz\MultiLanguage\Widgets;


use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Cookie;
use Vreyz\MultiLanguage\MultiLanguage;

class MultiLanguageMenu implements Renderable
{

    /**
     * Get the evaluated contents of the object.
     *
     * @return string
     */
    public function render()
    {
        $current = MultiLanguage::config('default');
        $cookie_name = MultiLanguage::config('cookie-name', 'locale');
        if(Cookie::has($cookie_name)) {
            $current = Cookie::get($cookie_name);
        }
        $languages = MultiLanguage::config("languages");
        return view("smart-admin::smart-admin-menu", compact('languages', 'current'))->render();
    }
}
