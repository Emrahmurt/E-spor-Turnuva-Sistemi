<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;

class ProfilController extends BaseController
{
    public function index()
    {
        $user = auth()->user();
        
        if (!$user) {
            return redirect()->to('login')->with('error', 'Lütfen önce giriş yapın.');
        }

        // Kullanıcının rollerini güvenle al
        $groups = $user->getGroups(); // Shield User Entity'de tanımlıdır
        $roller = array_column($groups, 'name'); // veya 'group'

        return $this->render('profil/index', [
            'title'  => 'Profilim',
            'user'   => $user,
            'roller' => $roller,
        ]);
    }
}