<?php
/**
 * Created by PhpStorm.
 * User: lvinkim
 * Date: 2018/8/19
 * Time: 8:06 PM
 */


use App\SwooleServer\SwooleCommand;

require dirname(__DIR__) . "/swoole-server/required.php";

$settings = require dirname(__DIR__) . "/config/kernel.config.php";

(new SwooleCommand($settings))->run();
