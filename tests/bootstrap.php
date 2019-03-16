<?php

if (!ini_get('date.timezone')) {
    date_default_timezone_set('UTC');
}

require __DIR__.'/../vendor/autoload.php';

/** @var \Illuminate\Database\Capsule\Manager $capsule */
$capsule = new Illuminate\Database\Capsule\Manager();
$capsule->addConnection(require(__DIR__ . '/bootstrap/config/database.php'));
$capsule->bootEloquent();
$capsule->setAsGlobal();

$__autoload_paths = array('/bootstrap/models', '/bootstrap/migrators', '/bootstrap/seeders');
foreach ($__autoload_paths as $path) {
    foreach (glob(__DIR__."/$path/*.php") as $dep) {
        require_once $dep;
    }
}
