<?php
/**
 * Created by PhpStorm.
 * User: lvinkim
 * Date: 2018/8/26
 * Time: 11:46 AM
 */

use Lvinkim\Swim\Console\Application;
use Lvinkim\Swim\Kernel;

require dirname(__DIR__) . '/vendor/autoload.php';

$debug = true;  // 正式运行时，设置为 false
$period = 60 * 1000;    // 每隔 60*1000ms (1分钟) 触发一次
$mission = function ($timerId) use ($debug) {

    $settings = require dirname(__DIR__) . '/src/settings.php';
    $kernel = new Kernel($settings);

    $logDir = __DIR__ . '/../var';
    $date = date('Y-m-d');

    try {

        $crontabJobber = new \Lvinkim\SwimConsole\CrontabJobber($debug);
        $crontabJobber->setDebugLogFile($logDir . "/crontab-job-debug.log." . $date);

        $crontabJobber->add("cmd-iam-alive", [
            "console" => Application::class,
            "consoleParam" => [$kernel],
            "commandName" => "zone:app:alive",
            "autoBuildCommand" => false,
            "schedule" => "* * * * *",
            "enabled" => true,
            "output" => $logDir . "/crontab-cmd-iam-alive.log." . $date,
        ]);

        $crontabJobber->run();

    } catch (\Throwable $e) {
        null;
    }
};

if ($debug) {
    $mission(uniqid());
} else {
    $timer = swoole_timer_tick($period, $mission);
}