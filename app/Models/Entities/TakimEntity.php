<?php

namespace App\Models\Entities;

use CodeIgniter\Entity\Entity;

class TakimEntity extends Entity
{
    protected $dates = ['created_at', 'updated_at'];
    protected $casts = [
        'id'          => 'integer',
        'turnuva_id'  => 'integer',
        'kaptan_id'   => 'integer',
    ];

    /**
     * Takım adını her zaman string olarak döndür
     */
    public function getAd(): string
    {
        $value = $this->attributes['ad'] ?? '';
        return $this->forceString($value);
    }
    /**
 * Logo URL'sini her zaman string olarak döndür
 */
public function getLogo(): string
{
    $value = $this->attributes['logo'] ?? '';
    return $this->forceString($value);
}

/**
 * Yardımcı string çevirici (zaten forceString varsa onu kullanın)
 */

    /**
     * Kısa adı güvenle döndür
     */
    public function getKisaAd(): string
    {
        $value = $this->attributes['kisa_ad'] ?? '';
        return $this->forceString($value);
    }

    /**
     * Yardımcı: Değeri string yap
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
        return '';
    }
}