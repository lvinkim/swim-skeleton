<?php
/**
 * Created by PhpStorm.
 * User: lvinkim
 * Date: 23/09/2018
 * Time: 2:25 AM
 */

namespace App\Tests\Functional\Service\ExampleService;


use App\Service\ExampleService;
use App\Tests\Functional\SwimKernelTestCase;

class ExampleServiceTest extends SwimKernelTestCase
{
    /** @var ExampleService */
    private $exampleService;

    public function setUp()
    {
        $this->exampleService = self::getContainer()->get(ExampleService::class);
    }

    public function testGetAppName()
    {
        $appName = $this->exampleService->getAppName();

        $this->assertTrue(is_string($appName));
    }

}