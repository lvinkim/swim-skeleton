<?php
/**
 * Created by PhpStorm.
 * User: lvinkim
 * Date: 2018/8/19
 * Time: 11:07 PM
 */

use Lvinkim\Swim\Console\Application;
use Lvinkim\Swim\Kernel;

require dirname(__DIR__) . '/vendor/autoload.php';

$settings = require dirname(__DIR__) . '/src/settings.php';

$kernel = new Kernel($settings);

$app = new Application($kernel);

$app->run();