<?php
/**
 * Created by PhpStorm.
 * User: lvinkim
 * Date: 2018/8/19
 * Time: 8:06 PM
 */

use Lvinkim\Swim\Console\Console;
use Lvinkim\Swim\Kernel;

require dirname(__DIR__) . '/vendor/autoload.php';

$settings = require dirname(__DIR__) . '/src/settings.php';
$kernel = new Kernel($settings);

$console = new Console($kernel);

$console->run();
