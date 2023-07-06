<?php

namespace App\Config;

class Config
{
    // Database settings
    public static function db()
    {
        return [
            'driver' => 'mysql',
            'host' => '127.0.0.1',
            'database' => 'ilume',
            'username' => 'root',
            'password' => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ];
    }
    // Slim settings
    public static function slim()
    {
        return [
            'settings' => [
                'determineRouteBeforeAppMiddleware' => false,
                'displayErrorDetails' => true,
                'db' => self::db()
            ],
        ];
    }
}
