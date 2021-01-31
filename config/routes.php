<?php

// Define app routes

use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use Tuupola\Middleware\HttpBasicAuthentication;

return function (App $app) {
    $app->get('/', \App\Action\Home\HomeAction::class)->setName('home');
    $app->get('/{slug}', \App\Action\Redirect\RedirectAction::class)->setName('redirect');
    $app->post('/longer-link', \App\Action\Link\LinkAction::class)->setName('link');
};
