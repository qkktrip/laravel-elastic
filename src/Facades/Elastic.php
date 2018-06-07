<?php


namespace Qkktrip\LaravelElastic\Facades;

use Illuminate\Support\Facades\Facade;

class Elastic extends Facade
{

    public static function getFacadeAccessor()
    {
        return 'elastic';
    }

    public static function __callStatic($name, $args)
    {
        $app = static::getFacadeRoot();

        if (method_exists($app, $name)) {
            return call_user_func_array([$app, $name], $args);
        }

        return $app->$name;
    }

}