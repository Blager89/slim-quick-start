<?php

namespace App\Controllers\Auth;

use App\Models\User;
use App\Controllers\Controller;
use Respect\Validation\Validator as validatate;

class AuthController extends Controller
{


    public function getSignIn($request, $response)
    {
        return $this->view->render($response, 'auth/signin.twig');

    }

    public function postSignIn($request, $response)
    {

        $validation = $this->validator->validate($request, [
            'email' => validatate::noWhitespace()->notEmpty()->email(),
            'password' => validatate::noWhitespace()->notEmpty(),

        ]);

        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor('auth.signin'));
        }

        $auth = $this->auth->attempt(
            $request->getParam('email'),
            $request->getParam('password')
        );

        if (!$auth) {

            $this->flash->addMessage('error', 'something wrong');

            return $response->withRedirect($this->router->pathfor('auth.signin'));
        }

        return $response->withRedirect($this->router->pathfor('home'));
    }

    public function getSignUp($request, $response)
    {
        return $this->view->render($response, 'auth/signup.twig');
    }

    public function postSignUp($request, $response)
    {
        $validation = $this->validator->validate($request, [
            'email' => validatate::noWhitespace()->notEmpty()->email()->emailAvailable(),
            'name' => validatate::notEmpty()->alpha(),
            'password' => validatate::noWhitespace()->notEmpty(),

        ]);


        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor('auth.signup'));
        }

        $user = User::create([
            'email' => $request->getParam('email'),
            'name' => $request->getParam('name'),
            'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
        ]);

        $this->auth->attempt($user->email, $request->getParam('password'));

        return $response->withRedirect($this->router->pathfor('home'));
    }


    public function signOut($request, $response)
    {
//        $this->auth->logout();


        unset($_SESSION['user']);
        return $response->withRedirect($this->router->pathfor('home'));
    }
}