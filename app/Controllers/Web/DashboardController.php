<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        $user = auth()->user();
        
        if (!$user) {
            return redirect()->to('login')->with('error', 'Lütfen önce giriş yapın.');
        }

        // Admin ise admin paneline, değilse profil sayfasına yönlendir
        if ($user->inGroup('admin')) {
            return redirect()->to('admin');
        } else {
            return redirect()->to('profil');
        }
    }
}