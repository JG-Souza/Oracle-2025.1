<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class Controller
{
    public function exibirLogin(){
        
        return view('site/login');
    }

    public function exibirDashboard()
    {
        return view('admin/dashboard');
    }

    public function efetuaLogin(){

        $email = $_POST['email'];

        $senha = $_POST['senha'];
        
        $user = App::get('database')->verificaLogin($email, $senha);

        if($user != false){
            session_start();
            $_SESSION['id'] = $user->user_id;
            
            header('Location: /dashboard');
            
        }
        else{
            session_start();
            $_SESSION['mensagem-erro'] = "Usuário e/ou senha incorretos";
            header('Location: /login');
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