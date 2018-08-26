<?php

use Lvinkim\Swim\Console\Application;
use Lvinkim\Swim\Kernel;

require dirname(__DIR__) . '/vendor/autoload.php';

$debug = true;  // 正式运行时，设置为 false
$logDir = __DIR__ . '/../var';
$date = date('Y-m-d');

try {

    $settings = require dirname(__DIR__) . '/src/settings.php';
    $kernel = new Kernel($settings);

    $repeatJobber = new Lvinkim\SwimConsole\RepeatJobber($debug);
    $repeatJobber->setDebugLogFile($logDir . "/repeat-job-debug.log." . $date);

    $repeatJobber->add('cmd-iam-alive', [
        "console" => Application::class,
        "consoleParam" => [$kernel],
        "commandName" => "zone:app:alive",
        "autoBuildCommand" => false,
        'interval' => 2000, // ms
        'enabled' => true,
        "output" => $logDir . "/repeat-cmd-iam-alive.log." . $date,
    ]);

    $repeatJobber->run();

} catch (\Error $e) {
    null;
} catch (Exception $e) {
    null;
} finally {
    null;
}