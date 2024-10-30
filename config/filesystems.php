<?php

return [

    'disks' => [
        'local' => [
            'driver' => 'local',
            'root' => public_path('uploads'),
            'url' => env('APP_URL').'/uploads',
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => public_path('uploads'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'visibility' => 'public',
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],

        'ftp' => [
            'driver' => 'ftp',
            'host' => getenv('FTP_HOST'),
            'username' => getenv('FTP_USERNAME'),
            'password' => getenv('FTP_PASSWORD'),
            'port' => getenv('FTP_PORT'),
            'root' => getenv('FTP_ROOT'),
            'image_domain' => getenv('FTP_IMAGE_DOMAIN'),
            'ssl' => getenv('FTP_SSL'),
            'passive' => getenv('FTP_PASSIVE'),
            'timeout' => getenv('FTP_TIMEOUT'),
            'url' => env('FTP_IMAGE_DOMAIN').'/uploads',
        ],
    ],

];
