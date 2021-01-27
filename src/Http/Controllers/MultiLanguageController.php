<?php

namespace Vreyz\MultiLanguage\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Request;
use Vreyz\Admin\Controllers\AuthController;
use Vreyz\MultiLanguage\MultiLanguage;

class MultiLanguageController extends AuthController
{

    public function locale() {
        $locale = Request::input('locale');
        $languages = MultiLanguage::config('languages');

        $cookie_name = MultiLanguage::config('cookie-name', 'locale');
        if(array_key_exists($locale, $languages)) {

            return response('ok')->cookie($cookie_name, $locale);
        }
    }

    public function getLogin() {

        if ($this->guard()->check()) {
            return redirect($this->redirectPath());
        }

        $login_page = config('admin.themes.login-page');
        $languages = MultiLanguage::config("languages");
        $cookie_name = MultiLanguage::config('cookie-name', 'locale');

        $current = MultiLanguage::config('default');
        if(Cookie::has($cookie_name)) {
            $current = Cookie::get($cookie_name);
        }
        return view("admin::login-".$login_page, compact('languages', 'current'));
    }
}
