<?php
/**
 * Created by PhpStorm.
 * User: lvinkim
 * Date: 2018/8/19
 * Time: 2:52 PM
 */

use Lvinkim\Swim\Console\Application;
use Lvinkim\Swim\Kernel;
use Symfony\Component\Console\Input\ArrayInput;

require dirname(__DIR__) . '/vendor/autoload.php';

$settings = require dirname(__DIR__) . '/src/settings.php';

$kernel = new Kernel($settings);

$app = new Application($kernel);

$commandInput = new ArrayInput(['command' => "slim:run"]);

$app->run($commandInput);

