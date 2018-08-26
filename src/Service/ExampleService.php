<?php
/**
 * Created by PhpStorm.
 * User: lvinkim
 * Date: 2018/8/23
 * Time: 10:22 PM
 */

namespace App\Service;


use Lvinkim\Swim\Service\Component\ShareableService;
use Psr\Container\ContainerInterface;

class ExampleService extends ShareableService
{
    private $app;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);

        $settings = $container->get("settings");
        $this->app = $settings["app"];
    }

    public function getAppName()
    {
        return $this->app;
    }

}