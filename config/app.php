<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [

    'media_disc' => env('MEDIA_DISK', 'public'),

    'upgrade_mode' => env('UPGRADE_MODE'),

    'providers' => ServiceProvider::defaultProviders()->merge([
        /*
         * Package Service Providers...
         */
        Yajra\DataTables\DataTablesServiceProvider::class,
        Barryvdh\Debugbar\ServiceProvider::class,
        Berkayk\OneSignal\OneSignalServiceProvider::class,
        Laracasts\Flash\FlashServiceProvider::class,
        Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class,
        Mckenziearts\Notify\LaravelNotifyServiceProvider::class,
        Mariuzzo\LaravelJsLocalization\LaravelJsLocalizationServiceProvider::class,
        Rap2hpoutre\LaravelLogViewer\LaravelLogViewerServiceProvider::class,
        Mews\Purifier\PurifierServiceProvider::class,
        Laravel\Socialite\SocialiteServiceProvider::class,

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
    ])->toArray(),

    'aliases' => Facade::defaultAliases()->merge([
        'DataTables' => Yajra\DataTables\Facades\DataTables::class,
        'Debugbar' => Barryvdh\Debugbar\Facade::class,
        'Flash' => Laracasts\Flash\Flash::class,
        'Image' => Intervention\Image\Facades\Image::class,
        'OneSignal' => Berkayk\OneSignal\OneSignalFacade::class,
        'Purifier' => Mews\Purifier\Facades\Purifier::class,
        'Redis' => Illuminate\Support\Facades\Redis::class,
        'Socialite' => Laravel\Socialite\Facades\Socialite::class,
    ])->toArray(),

];
