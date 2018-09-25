<?php
use Respect\Validation\Validator as validatate;
session_start();
require __DIR__ . '/../vendor/autoload.php';


$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
        'db' => [
            'driver' => 'mysql',
            'host' => 'slim.mysql',
            'port' => 3306,
            'database' => 'slim',
            'username' => 'slimUser',
            'password' => 1,
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]
    ]
]);

$container = $app->getContainer();

//database
// Service factory for the ORM.
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();
$container['db'] = function ($container) use ($capsule) {
    return $capsule;
};


//Validator
$container['validator'] = function ($container) {
    return new App\Validation\Validator;
};

//views template
$container['view'] = function ($container) {
    $view = new Slim\Views\Twig(__DIR__ . '/../resources/views', [
        'cache' => false,
    ]);
    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()

    ));
    return $view;
};

//controllers
//home controller
$container['HomeController'] = function ($container) {
    return new \App\Controllers\HomeController($container);
};
//auth controller
$container['AuthController'] = function ($container) {
    return new \App\Controllers\Auth\AuthController($container);
};


//midleware
$app->add(new \App\Middleware\ValidationErrorsMiddleware($container));
$app->add(new \App\Middleware\OldInputMiddleware($container));

//custom validate
validatate::with('App\\Validation\\Rules\\');






require __DIR__ . '/../app/routes.php';




