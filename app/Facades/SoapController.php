<?php

namespace App\Facades;
use Illuminate\Support\Facades\Facade;

class SoapController extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'recargas';
    }
}