<?php
error_reporting(-1);
ini_set('display_errors', 1);

require '../src/bootstrap.php';
$twigView = New \Slim\Views\Twig();

// Configure Twig
$twigView->parserOptions =
[
    'autoescape'        => 1,
    'auto_reload'       => 1,
    'cache'             => realpath('../src/tmp'),
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
    'templates.path'    => '../src/views',
    'view'              => $twigView
]);


/**
 * Index (GET)
 */
$app->get('/', function () USE ($app)
{
    $app->render('index.html', ['data' => 'testing']);
});


// Run it
$app->run();