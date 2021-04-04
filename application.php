<?php
require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new \GreenCheap\Test\SendSmsConsole());
$application->add(new \GreenCheap\Test\GetCreditConsole());
$application->add(new \GreenCheap\Test\GetPackageConsole());

try {
    $application->run();
} catch (Exception $e) {
    echo $e->getMessage();
}