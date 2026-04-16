<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use CodeIgniter\Shield\Models\UserModel;
use CodeIgniter\Shield\Entities\User;

class RegisterController extends BaseController
{
    public function registerView()
    {
        // Zaten giriş yapmışsa ana sayfaya yönlendir
        if (auth()->loggedIn()) {
            return redirect()->to('/');
        }

        // Kayıt formunu göster
        return view('auth/register');
    }

    public function registerAction()
    {
        // Form validasyon kuralları
        $rules = [
            'username' => 'required|min_length[3]|is_unique[users.username]',
            'email'    => 'required|valid_email|is_unique[auth_identities.secret]',
            'password' => 'required|min_length[6]',
            'password_confirm' => 'matches[password]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        try {
            $users = model(UserModel::class);
            $user = new User([
                'username' => $this->request->getPost('username'),
                'email'    => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
            ]);
            $users->save($user);

            // Varsayılan gruba ekle (opsiyonel)
            if ($user->id) {
                $user->addGroup('user');
            }

            return redirect()->to('/login')
                ->with('message', 'Kayıt başarılı! Giriş yapabilirsiniz.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Kayıt sırasında bir hata oluştu: ' . $e->getMessage());
        }
    }
}