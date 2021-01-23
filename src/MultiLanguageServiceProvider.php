<?php

namespace Vreyz\MultiLanguage;

use Encore\Admin\Facades\Admin;
use Illuminate\Support\ServiceProvider;
use Vreyz\MultiLanguage\Widgets\MultiLanguageMenu;

class MultiLanguageServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(MultiLanguage $extension)
    {
        if (! MultiLanguage::boot()) {
            return ;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'smart-admin');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/smart-admin-laravel')],
                'smart-admin'
            );
        }

        $this->app->booted(function () {
            MultiLanguage::routes(__DIR__.'/../routes/web.php');
        });

        # $this->app->make('Illuminate\Contracts\Http\Kernel')->prependMiddleware(Middlewares\MultiLanguageMiddleware::class);
        $this->app['router']->pushMiddlewareToGroup('web', Middlewares\MultiLanguageMiddleware::class);
        if(MultiLanguage::config("show-navbar", true)) {
            Admin::navbar()->add(new MultiLanguageMenu());
        }
    }
}
