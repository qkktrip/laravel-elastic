<?php


namespace Qkktrip\LaravelElastic\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Elastic
 *
 * @method static \Qkktrip\LaravelElastic\Elastic search($body)
 * @method static \Qkktrip\LaravelElastic\Elastic bulk($params)
 * @method static \Qkktrip\LaravelElastic\Elastic update($id, $body)
 * @method static \Qkktrip\LaravelElastic\Elastic index($id, $body)
 * @method static \Qkktrip\LaravelElastic\Elastic getMapping($type)
 * @method static \Qkktrip\LaravelElastic\Elastic putMapping($body)
 * @method static \Qkktrip\LaravelElastic\Elastic putSettings($body)
 * @method static \Qkktrip\LaravelElastic\Elastic close()
 * @method static \Qkktrip\LaravelElastic\Elastic open()
 * @method static \Qkktrip\LaravelElastic\Elastic createIndex(array $body = [])
 * @method static \Qkktrip\LaravelElastic\Elastic deleteIndex()
 * @method static \Qkktrip\LaravelElastic\Elastic indices(string $index = '')
 *
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