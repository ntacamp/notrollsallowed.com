<?php

// web/index.php
require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = defined('DEBUG') ? true : false;
$app['locales'] = ['lt', 'en'];
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
    if (!in_array(strtolower($app['locale']), $app['locales'])) {
        $app->abort(404, "¯\_(ツ)_/¯ wthudoinman?!");
    }
    return $app['twig']->render('index.html.twig');
});

$app->run();
