<?php
/**
 * Created by PhpStorm.
 * User: lvinkim
 * Date: 23/09/2018
 * Time: 1:26 AM
 */

namespace App\Action;


use App\Service\Plates\PlatesEngine;

use Lvinkim\SwimKernel\Component\ActionInterface;
use Lvinkim\SwimKernel\Kernel;
use Slim\Container;
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
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->app = $container["settings"]["app"];
        $this->platesEngine = $container[PlatesEngine::class];
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return mixed
     */
    public function __invoke(Request $request, Response $response, array $args)
    {
        return $this->platesEngine->render($request, $response, 'plates', [
            "app" => $this->app,
            "version" => Kernel::VERSION,
        ]);
    }
}