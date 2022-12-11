<?php

namespace App;

class Router
{
    private static $list = [];

    public static function page($uri, $page_name)
    {
        self::$list[] = [
            "uri" => $uri,
            "page" => $page_name
        ];
    }

    public static function enable()
    {
        $query = $_GET['q'] ?? '';

        foreach (self::$list as $route) {
            if ($route["uri"] === '/' . $query) {
                require_once("views/" . $route['page'] . ".php");
                die();
            }
        }

        self::not_found_page();
    }

    private static function not_found_page(){
        require_once("views/errors/404.php");
    }
}