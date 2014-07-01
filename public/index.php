<?php
error_reporting(-1);
ini_set('display_errors', 1);

define('APP_PATH', dirname(__DIR__));

require APP_PATH . '/src/bootstrap.php';
$twigView = New \Slim\Views\Twig();

// Configure Twig
$twigView->parserOptions =
[
    'autoescape'        => 1,
    'auto_reload'       => 1,
    'cache'             => realpath(APP_PATH . '/src/tmp'),
    'charset'           => 'utf-8',
    'optimizations'     => -1,
    'strict_variables'  => 0,
];

// Configure Slim
$app = New \Slim\Slim(
[
    'debug'             => 1,
    'log.enabled'       => 1,
    'log.level'         => \Slim\Log::WARN,
    'templates.path'    => APP_PATH . '/src/view',
    'view'              => $twigView,
]);


/**
 * Index (GET)
 */
$app->get('/', function () USE ($app)
{
    $app->render('/base/index.phtml', [
        'title' => 'Amazon Q and A',
        'data'  => 'testing',
    ]);
});


// Run it
$app->run();