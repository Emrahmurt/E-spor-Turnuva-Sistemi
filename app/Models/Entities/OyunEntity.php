<?php

namespace App\Models\Entities;

use CodeIgniter\Entity\Entity;

class OyunEntity extends Entity
{
    protected $dates = ['created_at', 'updated_at'];
    protected $casts = [
        'id'          => 'integer',
        'max_oyuncu'  => 'integer',
    ];

    /**
     * 'ad' alanına erişildiğinde otomatik string'e çevir
     */
    public function __get(string $key)
    {
        if ($key === 'ad') {
            return $this->getAd();
        }
        return parent::__get($key);
    }

    /**
     * 'ad' alanını güvenle string olarak döndür
     */
    public function getAd(): string
    {
        $value = $this->attributes['ad'] ?? '';
        return $this->forceString($value);
    }

    /**
     * Değeri ne olursa olsun string yap
     */
    private function forceString($value): string
    {
        if (is_string($value) || is_numeric($value)) {
            return (string) $value;
        }
        if (is_array($value)) {
            $flat = [];
            array_walk_recursive($value, function ($item) use (&$flat) {
                if (is_scalar($item)) {
                    $flat[] = (string) $item;
                }
            });
            return implode(' ', $flat);
        }
        if (is_object($value) && method_exists($value, '__toString')) {
            return (string) $value;
        }
        return '';
    }
}