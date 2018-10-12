<?php
/**
 * Created by PhpStorm.
 * User: lvinkim
 * Date: 2018/9/25
 * Time: 8:29 PM
 */

return (function () {

    date_default_timezone_set('Asia/Shanghai');

    (new Dotenv\Dotenv(dirname(__DIR__) . '/'))->load();

    "prod" === getenv("ENV") ? error_reporting(0) : null;

    return [
        "app" => "swim-skeleton",
        "workerId" => "", // 由 worker 进程设置
        "env" => getenv("ENV"),
        "displayErrorDetails" => "dev" === getenv("ENV") ? true : false, // set to false in production
        "addContentLengthHeader" => false, // Allow the web server to send the content-length header
        "projectDir" => dirname(__DIR__),
        "serviceDir" => dirname(__DIR__) . "/src/Service",
        "middlewareDir" => dirname(__DIR__) . "/src/Middleware",
        "commandDir" => dirname(__DIR__) . "/src/Command",
        "namespace" => "App",
        "routes" => __DIR__ . "/routes.config.php",
        'logger' => [
            'directory' => dirname(__DIR__) . '/var/logs',
        ],
        "plates" => [
            "templatePath" => dirname(__DIR__) . "/templates",
            "fileExtension" => "phtml",
        ],
    ];

})();
