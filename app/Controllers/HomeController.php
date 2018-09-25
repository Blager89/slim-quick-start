<?php

namespace App\Controllers;

use App\Models\User;


class HomeController extends Controller
{

    public function index($request, $response)
    {
        return $this->view->render($response, 'home.twig');
    }

    public function notFound($request, $response)
    {

        return $this->view->render($response, '404.twig');
    }


}