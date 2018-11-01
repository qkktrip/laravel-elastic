<?php


namespace Qkktrip\LaravelElastic\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Elastic
 * @method static \Qkktrip\LaravelElastic\Elastic indices(string $index)
 * @package Qkktrip\LaravelElastic\Facades
 * @author Kvens
 */
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