<?php

namespace Uasoft\Badaso\Module\Content\Helpers;

class Route
{
    public static function getController($key)
    {
        // get config 'controllers' from config/badaso-content.php
        $controllers = config('badaso-content.controllers');

        // if the key is not found, return $key
        if (! isset($controllers[$key])) {
            return 'Uasoft\\Badaso\\Module\\Content\\Controllers\\'.$key;
        }

        // return the value of the key
        return $controllers[$key];
    }
}
