<?php
/**
 * Created by PhpStorm.
 * User: lvinkim
 * Date: 2018/8/23
 * Time: 10:22 PM
 */

namespace App\Service;


use Lvinkim\SwimKernel\Component\ServiceInterface;
use Psr\Container\ContainerInterface;

class ExampleService implements ServiceInterface
{
    private $app;

    public function __construct(ContainerInterface $container)
    {
        $settings = $container["settings"];
        $this->app = $settings["app"];
    }

    public function getAppName()
    {
        return $this->app;
    }

}