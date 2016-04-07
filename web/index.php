<?php

// web/index.php
require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'locale_fallbacks' => array('en'),
));
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));


$app->get('/', function() use ($app) {
    return $app->redirect("/{$app['locale']}/");
});

$app->get('/{_locale}/', function() use ($app) {
    return $app['twig']->render('index.html.twig');
});

$app->run();
