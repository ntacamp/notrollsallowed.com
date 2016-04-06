<?php

// web/index.php
require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'locale_fallbacks' => array('en'),
));


$app->get('/', function() use ($app) {
    return $app->redirect("/{$app['locale']}/");
});

$app->get('/{_locale}/', function() use ($app) {
    return "Woot, das ist {$app['locale']}!";
});

$app->run();
