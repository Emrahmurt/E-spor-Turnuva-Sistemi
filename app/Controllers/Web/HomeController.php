<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;

class HomeController extends BaseController
{
    public function index()
    {
        return $this->render('home/index', [
            'title' => 'TurnuvaMerkezi - E-Spor Turnuvaları',
            'meta_description' => 'Takımını kur, turnuvalara katıl, şampiyon ol!',
        ]);
    }
}