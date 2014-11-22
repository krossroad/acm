<?php

namespace Apputilities\Acm\Facades\Native;

use Apputilities\Acm\AcmSentry;

/**
 * @author Rikesh <rikesh.shrestha.npl@gmail.com>
 **/
class Acm
{
    protected static $acmSentry;

    public static function __callStatic($name, $args)
    {
        self::boot();

        if (method_exists(self::$acmSentry, $name)) {
            return call_user_func_array(
                [
                    self::$acmSentry,
                    $name
                ],
                $args
            );

        } else {
            throw new \Exception('Method you are looking for doesn\'t exists.');
        }

    }

    public static function boot()
    {
        if (is_null(self::$acmSentry)) {
            self::$acmSentry = new AcmSentry();
        }
    }
}
// END class Acm
