<?php

namespace App\Models\Entities;

use CodeIgniter\Entity\Entity;

class TurnuvaEntity extends Entity
{
    protected $dates = ['baslangic_tarihi', 'kayit_bitis', 'created_at', 'updated_at'];
    protected $casts = [
        'id'      => 'integer',
        'oyun_id' => 'integer',
    ];

    /**
     * Turnuva adını güvenle döndür
     */
    public function getAd(): string
    {
        $value = $this->attributes['ad'] ?? '';
        return $this->forceString($value);
    }

    /**
     * Açıklamayı string yap
     */
    public function getAciklama(): string
    {
        $value = $this->attributes['aciklama'] ?? '';
        return $this->forceString($value);
    }

    /**
     * Ödülü string yap
     */
    public function getOdul(): string
    {
        $value = $this->attributes['odul'] ?? '';
        return $this->forceString($value);
    }

    /**
     * Kuralları string yap
     */
    public function getKurallar(): string
    {
        $value = $this->attributes['kurallar'] ?? '';
        return $this->forceString($value, "\n");
    }

    /**
     * Oyun adını güvenle döndür
     */
    public function getOyunAdi(): string
    {
        // Önce dinamik olarak atanmış oyun nesnesine bak
        $oyun = $this->oyun ?? $this->attributes['oyun'] ?? null;
        if (is_object($oyun) && isset($oyun->ad)) {
            return $this->forceString($oyun->ad);
        }
        if (is_array($oyun) && isset($oyun['ad'])) {
            return $this->forceString($oyun['ad']);
        }
        return 'Bilinmeyen Oyun';
    }

    /**
     * Durum rozeti (HTML)
     */
    public function getDurumBadge(): string
    {
        $durum = $this->attributes['durum'] ?? 'yakinda';
        $map = [
            'yakinda'      => '<span class="badge bg-secondary">Yakında</span>',
            'kayit_acik'   => '<span class="badge bg-success">Kayıt Açık</span>',
            'devam_ediyor' => '<span class="badge bg-warning text-dark">Devam Ediyor</span>',
            'tamamlandi'   => '<span class="badge bg-info">Tamamlandı</span>',
        ];
        return $map[$durum] ?? $map['yakinda'];
    }

    /**
     * Turnuva detay linki
     */
    public function getLink(): string
    {
        $slug = $this->attributes['slug'] ?? '';
        return site_url('turnuvalar/' . $slug);
    }

    /**
     * Kayıtlar açık mı?
     */
    public function isKayitAcik(): bool
    {
        $simdi = date('Y-m-d H:i:s');
        return ($this->attributes['durum'] ?? '') === 'kayit_acik' 
            && ($this->attributes['kayit_bitis'] ?? '') >= $simdi;
    }

    /**
     * Herhangi bir değeri güvenle string yap (dizi ise birleştir)
     */
    private function forceString($value, string $glue = ' '): string
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
            return implode($glue, $flat);
        }
        if (is_object($value) && method_exists($value, '__toString')) {
            return (string) $value;
        }
        return '';
    }
}