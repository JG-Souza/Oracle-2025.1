<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class LandingPageController
{
    public function exibirLandingPage()
    {
        return view('site/landing-page');
    }
}