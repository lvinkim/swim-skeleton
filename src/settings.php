<?php
/**
 * Created by PhpStorm.
 * User: lvinkim
 * Date: 2018/8/23
 * Time: 9:36 PM
 */


return (function () {

    date_default_timezone_set('Asia/Shanghai');

    (new Dotenv\Dotenv(dirname(__DIR__) . '/'))->load();

    "prod" === getenv("ENV") ? error_reporting(0) : null;

    return [
        "app" => "swim-skeleton",
        "env" => getenv("ENV"),
        "debug" => getenv("DEBUG"),
        "displayErrorDetails" => "dev" === getenv("ENV") ? true : false, // set to false in production
        "addContentLengthHeader" => false, // Allow the web server to send the content-length header
        "projectDir" => dirname(__DIR__),
        'logger' => [
            'directory' => dirname(__DIR__) . '/var/logs',
        ],
        "bundles" => __DIR__ . "/bundles.php",
        "dependencies" => __DIR__ . "/dependencies.php",
        "middleware" => __DIR__ . "/middleware.php",
        "routes" => __DIR__ . "/routes.php",
    ];

})();
