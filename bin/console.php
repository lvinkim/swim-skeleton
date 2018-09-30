<?php
/**
 * Created by PhpStorm.
 * User: lvinkim
 * Date: 2018/8/19
 * Time: 11:07 PM
 */

require dirname(__DIR__) . "/vendor/autoload.php";

$settings = require dirname(__DIR__) . "/config/settings.config.php";

$kernel = new \Lvinkim\SwimKernel\Kernel($settings);

$console = new \Lvinkim\SwimKernel\Console($kernel);

$console->run();
