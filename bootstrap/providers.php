<?php

use App\Providers\AppServiceProvider;

return [
    AppServiceProvider::class,
    MongoDB\Laravel\MongoDBServiceProvider::class,
    Intervention\Image\ImageServiceProvider::class,
    SimpleSoftwareIO\QrCode\QrCodeServiceProvider::class,
    UniSharp\LaravelFilemanager\LaravelFilemanagerServiceProvider::class,
];
