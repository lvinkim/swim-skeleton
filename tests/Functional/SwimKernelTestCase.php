<?php
/**
 * Created by PhpStorm.
 * User: lvinkim
 * Date: 2018/9/2
 * Time: 6:07 PM
 */

namespace Tests\Functional;

use Lvinkim\Swim\Kernel;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

class SwimKernelTestCase extends TestCase
{
    /** @var Kernel */
    protected static $kernel;

    /** @var ContainerInterface */
    protected static $container;

    /**
     * @return Kernel
     */
    protected function bootKernel()
    {
        if (!(self::$kernel instanceof Kernel)) {
            $settings = require dirname(__DIR__) . '/../src/settings.php';
            self::$kernel = new Kernel($settings);
            self::$kernel->boot();
        }

        return self::$kernel;
    }

    /**
     * @return ContainerInterface
     */
    protected function getContainer()
    {
        if (!(self::$container instanceof ContainerInterface)) {
            self::$container = self::bootKernel()->getContainer();
        }

        return self::$container;
    }
}