<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use CodeIgniter\Shield\Models\UserModel;

class SimpleRegister extends BaseController
{
    public function index()
    {
        if (auth()->loggedIn()) {
            return redirect()->to('/');
        }
        return view('Shield/register_simple');
    }

    public function store()
    {
        $users = new UserModel();
        $user = new \CodeIgniter\Shield\Entities\User([
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
        ]);
        $users->save($user);

        return redirect()->to('/login')->with('message', 'Kayıt başarılı, giriş yapabilirsiniz.');
    }
}