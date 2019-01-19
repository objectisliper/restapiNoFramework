<?php
/**
 * Created by PhpStorm.
 * User: object
 * Date: 12.01.19
 * Time: 20:29
 */

namespace App\Controllers;

use App\Models\User;

class Auth extends BaseController
{
    public function loginPage(){
        $this->renderTemplate('Login');
    }

    public function login(){
        $data = $this->request->getBodyParameters();
        $user = new User;
        if ($user->validateUser($data['username'], $data['password'])){
            $_SESSION['username'] = $data['username'];
            $_SESSION['auth'] = True;
            $this->redirect('/');
        }
        else{
            $error = "Wrong password or username!";
            $this->renderTemplate('Login', ['error' => $error]);
        }
    }

    public function logout(){
        $_SESSION['auth'] = null;
        $_SESSION['username'] = "";
        $this->redirect('/');
    }
}