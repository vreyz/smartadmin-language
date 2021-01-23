<?php

use Vreyz\MultiLanguage\Http\Controllers\MultiLanguageController;
use Vreyz\MultiLanguage\MultiLanguage;

Route::post('/locale', MultiLanguageController::class.'@locale');
if(MultiLanguage::config("show-login-page", true)) {
    Route::get('auth/login', MultiLanguageController::class.'@getLogin');
}