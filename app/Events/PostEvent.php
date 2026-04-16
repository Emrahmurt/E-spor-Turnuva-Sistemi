<?php

namespace App\Events;

use App\Models\Entities\PostEntity;
use CodeIgniter\Events\Events;

Events::on('postCreated', static function (PostEntity $post) {
    // Slack/Discord bildirimi gönderme veya loglama
    log_message('info', 'Yeni yazı oluşturuldu: {title}', ['title' => $post->title]);
    
    // Cache temizleme zaten Service içinde yapılıyor
});

Events::on('postUpdated', static function (PostEntity $post) {
    log_message('info', 'Yazı güncellendi: ID {id}', ['id' => $post->id]);
});