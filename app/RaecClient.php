<?php


namespace App;

use GuzzleHttp\Client as GuzzleClient;

class RaecClient extends GuzzleClient
{
    private static $instance;

    private function __construct(array $config = [])
    {
        $config['base_uri'] = 'http://catalog.raec.su/api/';
        $config['headers']['API-KEY'] = 'ae1c3f7268761a94717ff29f30017c00';
        $config['headers']['format'] = 'json';
        parent::__construct($config);

    }

    public static function getInstance()
    {
        if (!self::$instance instanceof RaecClient) {
            self::$instance = new RaecClient();
        }

        return self::$instance;
    }

    private function __clone()
    {
    }

    private function __sleep()
    {
    }

    private function __wakeup()
    {
    }

}