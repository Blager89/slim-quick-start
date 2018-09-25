<?php

//home
$app->get('/', 'HomeController:index')->setName('home');


//Auth
$app->get('/auth/signup', 'AuthController:getSignUp')->setName('auth.signup');
$app->post('/auth/signup', 'AuthController:postSignUp');


