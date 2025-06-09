<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class LandingPageController
{
    public function exibirLandingPage()
    {
        $db = App::get('database');

        $destaques   = $db->getDestaques();
        $ultimos     = $db->getUltimosPosts(); 

        return view('site/landing-page', [
            'destaques' => $destaques,
            'ultimos'   => $ultimos
        ]);
    }
}