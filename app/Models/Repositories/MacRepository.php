<?php

namespace App\Models\Repositories;

use App\Models\Entities\MacEntity;
use CodeIgniter\Model;

class MacRepository extends Model
{
    protected $table         = 'maclar';
    protected $primaryKey    = 'id';
    protected $returnType    = MacEntity::class;
    protected $allowedFields = [
        'turnuva_id', 'takim1_id', 'takim2_id', 'skor1', 'skor2', 'tarih', 'tur', 'durum'
    ];
    protected $useTimestamps = true;
    protected $useAutoIncrement = true;

    /**
     * Turnuvaya ait maçları gruplandırarak getir (ör: Grup A, Çeyrek Final)
     */
    public function getByTurnuvaGrouped(int $turnuvaId): array
    {
        $maclar = $this->where('turnuva_id', $turnuvaId)
                       ->orderBy('tur', 'ASC')
                       ->orderBy('tarih', 'ASC')
                       ->findAll();

        $grouped = [];
        foreach ($maclar as $mac) {
            $tur = $mac->tur ?: 'Diğer';
            if (!isset($grouped[$tur])) {
                $grouped[$tur] = [];
            }
            $grouped[$tur][] = $mac;
        }
        return $grouped;
    }
}