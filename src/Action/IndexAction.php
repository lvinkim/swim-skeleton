<?php
/**
 * Created by PhpStorm.
 * User: lvinkim
 * Date: 2018/8/19
 * Time: 11:15 PM
 */

namespace App\Action;


use App\Service\ExampleService;
use Lvinkim\Swim\Action\Component\ActionInterface;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class IndexAction implements ActionInterface
{

    /** @var ExampleService */
    private $exampleService;

    /**
     * ActionInterface constructor.
     *
     * @param \Psr\Container\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->exampleService = $container->get(ExampleService::class);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return mixed
     */
    public function __invoke(Request $request, Response $response, array $args)
    {
        return $response->withJson([
            "success" => true,
            "message" => "finished",
            "data" => [
                "app" => $this->exampleService->getAppName(),
            ]
        ]);
    }
}