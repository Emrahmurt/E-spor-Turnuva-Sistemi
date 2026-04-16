<?php

namespace App\Models\Repositories;

use App\Models\Entities\OyunEntity;
use CodeIgniter\Model;

class OyunRepository extends Model
{
    protected $table         = 'oyunlar';
    protected $primaryKey    = 'id';
    protected $useAutoIncrement = true;
    protected $returnType    = OyunEntity::class;
    protected $useSoftDeletes = false;
    protected $allowedFields = ['ad', 'logo', 'max_oyuncu'];
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
}