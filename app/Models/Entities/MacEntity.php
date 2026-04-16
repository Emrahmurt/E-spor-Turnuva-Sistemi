<?php

namespace App\Models\Entities;

use CodeIgniter\Entity\Entity;

class MacEntity extends Entity
{
    protected $dates = ['tarih', 'created_at', 'updated_at'];
    protected $casts = [
        'id'          => 'integer',
        'turnuva_id'  => 'integer',
        'takim1_id'   => 'integer',
        'takim2_id'   => 'integer',
        'skor1'       => '?integer',
        'skor2'       => '?integer',
    ];

    public function getSkorGoster(): string
    {
        if ($this->attributes['skor1'] === null || $this->attributes['skor2'] === null) {
            return '- : -';
        }
        return $this->attributes['skor1'] . ' - ' . $this->attributes['skor2'];
    }
public function getDurum(): string
{
    $value = $this->attributes['durum'] ?? 'planlandi';
    if (is_array($value)) {
        $flat = [];
        array_walk_recursive($value, function ($item) use (&$flat) {
            if (is_scalar($item)) {
                $flat[] = (string) $item;
            }
        });
        return implode(' ', $flat);
    }
    return (string) $value;
}
    public function isOynandi(): bool
    {
        return $this->attributes['durum'] === 'tamamlandi';
    }
}