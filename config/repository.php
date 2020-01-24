<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Model namespace
    |--------------------------------------------------------------------------
    |
    | This option controls the default namespace from models
    | if your models are located inside another namespace like for example
    | App\\Models you should change this value to match your environment
    |
    | Important do not forget the trailing backslash !!!
    |
    */

    'model_namespace' => env('REPOSITORY_MODEL_NAMESPACE', 'App\\'),

    /*
    |--------------------------------------------------------------------------
    | Repository namespace
    |--------------------------------------------------------------------------
    |
    | This option controls the default namespace of your repositories
    | this is probably good for most users so do not change unless necessary
    |
    | Important do not forget the trailing backslash !!!
    |
    */

    'repository_namespace' => env('REPOSITORY_NAMESPACE', 'App\\Repositories\\'),

    /*
    |--------------------------------------------------------------------------
    | Repository path
    |--------------------------------------------------------------------------
    |
    | This option controls the default repository path where your repositories
    | are located
    |
    */

    'repository_path' => env('REPOSITORY_PATH', app_path('Repositories'))
];
