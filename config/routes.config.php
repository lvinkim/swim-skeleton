<?php
/**
 * Created by PhpStorm.
 * User: lvinkim
 * Date: 24/09/2018
 * Time: 10:41 PM
 */

use App\Action\IndexAction;
use App\Action\PlatesAction;
use App\Action\SlimAction;
use App\Action\UpdateAction;
use Slim\App;


/** @var \Slim\Container $container */

/**
 * @param \Slim\Container $container
 */
(function (\Slim\Container $container) {

    /** @var App $app */
    $app = $container->raw(App::class);

    $app->any("/", IndexAction::class)->setName("index");
    $app->any("/update", UpdateAction::class);
    $app->any("/slim", SlimAction::class);
    $app->any("/plates", PlatesAction::class);

})($container);
