<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class Controller
{
    public function exibirDashboard()
    {
        return view(name: 'admin/dashboard');
    }
}