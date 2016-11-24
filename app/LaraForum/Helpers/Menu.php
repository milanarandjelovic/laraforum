<?php

namespace App\LaraForum\Helpers;

use Request;

class Menu
{

    public static function activeMenu($uri = '')
    {
        $active = '';

        if (Request::is(Request::segment(1) . '/' . $uri . '/*') || Request::is(Request::segment(1) . '/' . $uri) || Request::is($uri)) {
            $active = 'active';
        }

        return $active;
    }
}