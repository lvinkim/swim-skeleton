<?php
/**
 * Created by PhpStorm.
 * User: lvinkim
 * Date: 2018/8/23
 * Time: 10:22 PM
 */

namespace App\Service\Plates;


use League\Plates\Engine;
use Lvinkim\SwimKernel\Component\ServiceInterface;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class PlatesEngine implements ServiceInterface
{
    private $container;
    private $templatePath;
    private $fileExtension;

    /** @var array 注册到模板的数组 */
    protected $renderData = [];

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $settings = $container->get("settings");
        $this->templatePath = $settings["plates"]["templatePath"];
        $this->fileExtension = $settings["plates"]["fileExtension"];

    }

    public function assignRenderData($key, $val)
    {
        $this->renderData[$key] = $val;
    }

    public function render(Request $request, Response $response, $name, array $data = [])
    {
        $router = $this->container->get('router');

        $this->assignRenderData('baseUrl', '/');
        $this->assignRenderData('router', $router);
        $this->assignRenderData('request', $request);

        foreach ($data as $key => $value) {
            $this->assignRenderData($key, $value);
        }

        $engine = new Engine($this->templatePath, $this->fileExtension);
        $html = $engine->render($name, $this->renderData);

        return $response->withAddedHeader("Content-Type", "text/html;charset=utf-8")
            ->write($html);
    }

}