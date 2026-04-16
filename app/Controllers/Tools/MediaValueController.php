<?php

namespace App\Controllers\Tools;

use App\Controllers\BaseController;

class MediaValueController extends BaseController
{
    public function index()
    {
        return $this->render('tools/media_value', [
            'title' => 'Medya Değeri Hesaplayıcı',
            'meta_description' => 'Turnuva veya yayınınızın potansiyel reklam değerini anında hesaplayın.',
        ]);
    }
}