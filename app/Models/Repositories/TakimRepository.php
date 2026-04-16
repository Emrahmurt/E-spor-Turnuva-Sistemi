<?php

namespace App\Models\Repositories;

use App\Models\Entities\TakimEntity;
use CodeIgniter\Model;

class TakimRepository extends Model
{
    protected $table         = 'takimlar';
    protected $primaryKey    = 'id';
    protected $returnType    = TakimEntity::class;
    protected $allowedFields = ['turnuva_id', 'kaptan_id', 'ad', 'kisa_ad', 'logo'];
    protected $useTimestamps = true;
    protected $useAutoIncrement = true;

    public function getByTurnuva(int $turnuvaId): array
    {
        return $this->where('turnuva_id', $turnuvaId)->findAll();
    }
}