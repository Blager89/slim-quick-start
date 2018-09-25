<?php
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;

//home
$app->get('/', 'HomeController:index')->setName('home');


//Auth | registration
$app->get('/auth/signup', 'AuthController:getSignUp')->setName('auth.signup');
$app->post('/auth/signup', 'AuthController:postSignUp');
//Auth | login
$app->get('/auth/signin', 'AuthController:getSignIn')->setName('auth.signin');
$app->post('/auth/signin', 'AuthController:postSignIn');
//logout
$app->get('/auth/signout', 'AuthController:signOut')->setName('auth.signout');
//redirect at 404
$app->get('/404', 'HomeController:notFound')->setName('404');


//auth controller | chech auth user
$app->group('', function () use($app){

//redirect to ...

})->add(new AuthMiddleware($container));

//guest middleware | if user not signed, redirect him ....
$app->group('', function () use($app){

//redirect in ...

})->add(new GuestMiddleware($container));
