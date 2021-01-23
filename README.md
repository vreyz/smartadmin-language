Laravel with SmartAdmin fontend
=======

## Must Install Ecore Laravel Admin:

First, install laravel, and make sure that the database connection settings are correct.

```
composer require encore/laravel-admin:1.*
```

### Then run these commands to publish assets and config：

```
php artisan vendor:publish --provider="Encore\Admin\AdminServiceProvider"
```

After run command you can find config file in config/admin.php, in this file you can change the install directory,db connection or table names.

#### At last run following command to finish install.

```
php artisan admin:install
```

Open http://localhost/admin/ in browser,use username admin and password admin to login.



## Then Install SmartAdmin forntend

```
composer require vreyz/smartadmin-laravel
```

## Config


First, add extension config

In `config/admin.php`

```
    'extensions' => [
        'smartadmin-laravel' => [
            'enable' => true,
            // the key should be same as var locale in config/app.php
            // the value is used to show
            'languages' => [
                'en' => 'English',
                'zh-CN' => '简体中文',
            ],
            // default locale
            'default' => 'zh-CN',
            // if or not show multi-language login page, optional, default is true
            'show-login-page' => true,
            // if or not show multi-language navbar, optional, default is true
            'show-navbar' => true,
            // the cookie name for the multi-language var, optional, default is 'locale'
            'cookie-name' => 'locale'
        ],
    ],
```

Then, add except route to auth

In `config/admin.php`, add `locale` to `auth.excepts`

```
    'auth' => [
        ...
        // The URIs that should be excluded from authorization.
        'excepts' => [
            'auth/login',
            'auth/logout',
            // add this line !
            'locale',
        ],
    ],

```
