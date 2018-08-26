<?php

use Lvinkim\Swim\Console\Application;
use Lvinkim\Swim\Kernel;

require_once dirname(__DIR__) . "/vendor/autoload.php";

$debug = true;  // 正式运行时，设置为 false
$logDir = __DIR__ . "/../var";
$date = date("Y-m-d");

try {

    $settings = require dirname(__DIR__) . '/src/settings.php';
    $kernel = new Kernel($settings);

    $daemonJobber = new \Lvinkim\SwimConsole\DaemonJobber($debug);
    $daemonJobber->setDebugLogFile($logDir . "/daemon-job-debug.log." . $date);

    $daemonJobber->add("cmd-iam-alive", [
        "console" => Application::class,
        "consoleParam" => [$kernel],
        "commandName" => "zone:app:alive",
        "autoBuildCommand" => false,
        "sleep" => 2,   // s
        "enabled" => true,
        "output" => $logDir . "/daemon-cmd-iam-alive.log." . $date,
    ]);

    $daemonJobber->run();

} catch (\Throwable $e) {
    null;
}