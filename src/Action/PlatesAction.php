<?php
/**
 * Created by PhpStorm.
 * User: lvinkim
 * Date: 23/09/2018
 * Time: 1:26 AM
 */

namespace App\Action;


use App\Service\Plates\PlatesEngine;
use Lvinkim\Swim\Action\Component\ActionInterface;
use Lvinkim\Swim\Kernel;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class PlatesAction implements ActionInterface
{

    private $app;
    /** @var PlatesEngine */
    private $platesEngine;

    /**
     * ActionInterface constructor.
     *
     * @param \Psr\Container\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->app = $container->get("settings")["app"];
        $this->platesEngine = $container->get(PlatesEngine::class);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return mixed
     */
    public function __invoke(Request $request, Response $response, array $args)
    {
        return $this->platesEngine->render('plates', [
            "app" => $this->app,
            "version" => Kernel::VERSION,
        ]);
    }
}