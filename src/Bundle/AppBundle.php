<?php
/**
 * Created by PhpStorm.
 * User: lvinkim
 * Date: 2018/8/24
 * Time: 12:44 AM
 */

namespace App\Bundle;


use App\Utility\DirectoryScanner;
use HaydenPierce\ClassFinder\ClassFinder;
use Lvinkim\Swim\Bundle\Bundle;
use Lvinkim\Swim\Middleware\AccessCostMiddleware;
use Lvinkim\Swim\Service\AutoRegister;
use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Container;
use Symfony\Component\Console\Application;

class AppBundle extends Bundle
{
    /** @var ContainerInterface */
    private $container;

    public function boot()
    {
        /** @var Container $container */
        $container = $this->container;

        $autoRegister = new AutoRegister($container);

        $serviceClasses = $this->getAllServiceClasses();

        $autoRegister->register($serviceClasses);

        /** @var App $app */
        $app = $container->raw(App::class);
        $app->add(new AccessCostMiddleware($container));
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function getName()
    {
        return self::class;
    }

    public function registerCommands(Application $application)
    {
        $commandClasses = $this->getALlCommandClasses();

        $commandObjects = [];
        foreach ($commandClasses as $commandClass) {
            $commandObjects[] = new $commandClass($this->container);
        }

        $application->addCommands($commandObjects);
    }

    /**
     * @return array
     */
    private function getALlCommandClasses()
    {
        $projectDir = $this->container->get("settings")["projectDir"];
        $serviceDir = $projectDir . "/src/Command";
        $namespace = "App\Command";
        $classes = $this->getClassesRecursion($serviceDir, $namespace);

        return $classes;
    }

    /**
     * @return array
     */
    private function getAllServiceClasses()
    {
        $projectDir = $this->container->get("settings")["projectDir"];
        $serviceDir = $projectDir . "/src/Service";
        $namespace = "App\Service";
        $classes = $this->getClassesRecursion($serviceDir, $namespace);

        return $classes;
    }

    /**
     * @param $directory
     * @param $namespace
     * @return array
     */
    private function getClassesRecursion($directory, $namespace)
    {

        try {
            $classes = ClassFinder::getClassesInNamespace($namespace);

            $subDirectories = DirectoryScanner::scanChildNamespaces($directory);
            foreach ($subDirectories as $subDirectory) {
                $subClasses = ClassFinder::getClassesInNamespace($namespace . $subDirectory);
                $classes = array_merge($classes, $subClasses);
            }
        } catch (\Exception $exception) {
            $classes = [];
        }

        return $classes;
    }


}