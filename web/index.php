<?php

use Symfony\Component\Translation\Loader\YamlFileLoader;

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
$app['translator'] = $app->share($app->extend('translator',
    function($translator, $app) {
    $translator->addLoader('yaml', new YamlFileLoader());
    foreach ($locale as $app['locales']) {
      $translator->addResource(
        'yaml', __DIR__.'/locales/'.$locale.'.yml', $locale);
    }

    return $translator;
}));
 

// Paths
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
