<?php

return [
    'username' => [
        'required' => 'Kullanıcı adı gereklidir.',
        'is_unique' => 'Bu kullanıcı adı zaten alınmış.',
    ],
    'email' => [
        'required' => 'E-posta adresi gereklidir.',
        'valid_email' => 'Geçerli bir e-posta adresi girin.',
        'is_unique' => 'Bu e-posta adresi zaten kayıtlı.',
    ],
    'password' => [
        'required' => 'Şifre gereklidir.',
        'min_length' => 'Şifre en az {param} karakter olmalıdır.',
    ],
];