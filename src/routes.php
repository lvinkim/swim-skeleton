<?php
/**
 * Created by PhpStorm.
 * User: lvinkim
 * Date: 2018/8/23
 * Time: 9:37 PM
 */


use App\Action\IndexAction;

/** @var \Slim\App $app */

$app->get('/', IndexAction::class);

