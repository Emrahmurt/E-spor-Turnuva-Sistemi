<?php

namespace CodeIgniter\Shield\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Shield\Models\UserModel;
use CodeIgniter\Shield\Entities\User;

class RegisterController extends BaseController
{
    public function registerView()
    {
        if (auth()->loggedIn()) {
            return redirect()->to('/');
        }
        return view('auth/register');
    }

    public function registerAction()
    {
        $rules = [
            'username' => 'required|min_length[3]|is_unique[users.username]',
            'email'    => 'required|valid_email|is_unique[auth_identities.secret]',
            'password' => 'required|min_length[6]',
            'password_confirm' => 'matches[password]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        try {
            $users = model(UserModel::class);
            $user = new User([
                'username' => $this->request->getPost('username'),
                'email'    => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
            ]);
            $users->save($user);
            $user->addGroup('user');

            return redirect()->to('/login')->with('message', 'Kayıt başarılı!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Hata: ' . $e->getMessage());
        }
    }
}