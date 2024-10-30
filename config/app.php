<?php

use Illuminate\Support\Facades\Facade;

return [

    'media_disc' => env('MEDIA_DISK', 'public'),

    'upgrade_mode' => env('UPGRADE_MODE'),

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
