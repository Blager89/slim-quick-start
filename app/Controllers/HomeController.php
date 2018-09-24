<?php

namespace App\Controllers;

use App\Models\User;


class HomeController extends Controller
{

    public function index($request, $response)
    {
        $user = User::all();
        return $response->withJson($user,200);
//        return $this->view->render($response, 'home.twig');

    }
}