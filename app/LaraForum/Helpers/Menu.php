<?php

namespace App\LaraForum\Helpers;

use Request;

class Menu
{

    public static function activeAdminMenu($uri = '')
    {
        $active = '';

        if (Request::is(Request::segment(1) . '/' . $uri . '/*') || Request::is(Request::segment(1) . '/' . $uri) || Request::is($uri)) {
            $active = 'active';
        }

        return $active;
    }

    public static function activeForumMenu($uri = '')
    {
        $active = '';

        if (Request::is(Request::segment(1) . '/' . $uri . '/*') || Request::is(Request::segment(1) . '/' . $uri) || Request::is($uri)) {
            $active = 'is-active';
        }

        return $active;
    }
}