<?php
error_reporting(-1);
ini_set('display_errors', 1);

define('APP_PATH', dirname(__DIR__));

require APP_PATH . '/src/bootstrap.php';
$twigView = New \Slim\Views\Twig();

// Configure Twig
$twigView->parserOptions =
[
    'autoescape'        => true,
    'auto_reload'       => true,
    'cache'             => realpath(APP_PATH . '/src/tmp'),
    'charset'           => 'utf-8',
    'optimizations'     => -1,
    'strict_variables'  => false,
];

// Configure Slim
$app = New \Slim\Slim(
[
    'debug'             => true,
    'log.enabled'       => true,
    'log.level'         => \Slim\Log::WARN,
    'templates.path'    => APP_PATH . '/src/view',
]);


/**
 * Index (GET)
 */
$app->get('/', function () USE ($app)
{
    $payload = New \Database\QueryMapper();

    $app->render('/base/index.php', [
        'route'     => $app->config('templates.path') . '/base',
        'payload'   => $payload->getLimit(10, true),
        'title'     => 'Amazon Q and A',
    ]);
});


/**
 * Index (POST)
 */
$app->post('/handler',function() USE ($app) {

     $request = $app->request();
     $body = $request->getBody();

    print_r($body);
});

// Run it
$app->run();