<?php

namespace App\Validation;

use CodeIgniter\Validation\ValidationInterface;
use Config\Services;

class PostRequest
{
    protected ValidationInterface $validation;
    protected array $rules = [
        'title' => 'required|min_length[3]|max_length[255]',
        'excerpt' => 'permit_empty|max_length[500]',
        'content' => 'required|min_length[10]',
        'status' => 'in_list[draft,published,archived]',
        'featured_image' => 'permit_empty|valid_url_strict',
        'published_at' => 'permit_empty|valid_date[Y-m-d H:i:s]',
    ];

    protected array $messages = [
        'title' => [
            'required' => 'Başlık alanı zorunludur.',
            'min_length' => 'Başlık en az 3 karakter olmalıdır.',
        ],
        'content' => [
            'required' => 'İçerik alanı boş bırakılamaz.',
            'min_length' => 'İçerik en az 10 karakter olmalıdır.',
        ],
    ];

    public function __construct()
    {
        $this->validation = Services::validation();
        $this->validation->setRules($this->rules, $this->messages);
    }

    public function validate(array $data): bool
    {
        return $this->validation->run($data);
    }

    public function getErrors(): array
    {
        return $this->validation->getErrors();
    }

    public function getValidated(): array
    {
        $data = [];
        foreach (array_keys($this->rules) as $field) {
            $data[$field] = $this->validation->getValidated()[$field] ?? null;
        }
        return $data;
    }
}