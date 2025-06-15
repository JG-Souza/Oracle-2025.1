<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class LoginController
{
    public function exibirLogin(){
        
        return view('site/login');
    }

    public function exibirDashboard()
    {
        return view('admin/dashboard');
    }

    public function efetuaLogin(){
        session_start();

        $email = $_POST['email'];
        $senha = $_POST['senha'];
        
        $user = App::get('database')->verificaLogin($email, $senha);

        if($user != false){
            $_SESSION['id'] = $user->user_id;
            $_SESSION['role'] = $user->role;
            header('Location: /dashboard');
            exit;
        }
        else{
            $_SESSION['mensagem-erro'] = "Usuário e/ou senha incorretos";
            header('Location: /login');
            exit;
        }
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /login');
    }
}