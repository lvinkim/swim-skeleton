<?php
/**
 * Created by PhpStorm.
 * User: lvinkim
 * Date: 2018/8/19
 * Time: 11:43 AM
 */

require dirname(__DIR__) . '/vendor/autoload.php';

$debug = true;  // 正式运行时，设置为 false
$period = 60 * 1000;    // 每隔 60*1000ms (1分钟) 触发一次
$mission = function ($timerId) use ($debug) {

    $console = __DIR__ . '/console.php';
    $logDir = dirname(__DIR__) . '/var/logs/crontab';
    $date = date('Y-m-d');

    try {

        $shellJobber = new \Lvinkim\SwimConsole\ShellJobber($debug);
        $shellJobber->setDebugLogFile($logDir . "/shell-crontab-job-debug.log." . $date);

        $shellJobber->add("cmd-iam-alive", [
            "command" => "/usr/bin/env php {$console} zone:app:alive",
            "schedule" => "* * * * *",
            "enabled" => true,
            "output" => $logDir . "/shell-crontab-iam-alive.log." . $date,
        ]);

        $shellJobber->run();

    } catch (\Throwable $e) {
        null;
    }
};

if ($debug) {
    $mission(uniqid());
} else {
    $timer = swoole_timer_tick($period, $mission);
}
