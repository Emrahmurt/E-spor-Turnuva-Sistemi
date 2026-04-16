<?php

namespace App\Services;

use App\Models\Repositories\TurnuvaRepository;
use App\Models\Repositories\TakimRepository;
use App\Models\Repositories\MacRepository;
use App\Models\Repositories\OyunRepository;
use App\Models\Entities\TurnuvaEntity;

class TurnuvaService
{
    protected TurnuvaRepository $turnuvaRepo;
    protected TakimRepository $takimRepo;
    protected MacRepository $macRepo;
    protected OyunRepository $oyunRepo;

    public function __construct()
    {
        $this->turnuvaRepo = new TurnuvaRepository();
        $this->takimRepo   = new TakimRepository();
        $this->macRepo     = new MacRepository();
        $this->oyunRepo    = new OyunRepository();
    }

    public function getTurnuvaRepo(): TurnuvaRepository
    {
        return $this->turnuvaRepo;
    }

    public function getActiveTurnuvalar(int $perPage = 12, int $page = 1): array
    {
        $turnuvalar = $this->turnuvaRepo->paginateActive($perPage, $page);
        // Her turnuvaya oyun nesnesini ekle
        foreach ($turnuvalar as &$turnuva) {
            $turnuva->oyun = $this->oyunRepo->find($turnuva->oyun_id);
        }
        return $turnuvalar;
    }

   public function getTurnuvaBySlug(string $slug): ?TurnuvaEntity
{
    $turnuva = $this->turnuvaRepo->findBySlug($slug);
    if ($turnuva) {
        $turnuva->oyun = $this->oyunRepo->find($turnuva->oyun_id);
    }
    return $turnuva;
}
public function getMaclarGrouped(int $turnuvaId): array
{
    $maclar = $this->macRepo->where('turnuva_id', $turnuvaId)
                           ->orderBy('tur', 'ASC')
                           ->orderBy('tarih', 'ASC')
                           ->findAll();

    $grouped = [];
    foreach ($maclar as $mac) {
        // $mac ister dizi ister nesne olsun, 'tur' değerini güvenle al
        $tur = '';
        if (is_object($mac)) {
            $tur = method_exists($mac, 'getTur') ? $mac->getTur() : ($mac->tur ?? 'Diğer');
        } elseif (is_array($mac)) {
            $tur = $mac['tur'] ?? 'Diğer';
        }

        // Hâlâ dizi ise string'e çevir
        if (is_array($tur)) {
            $tur = implode(' ', $tur);
        }

        $tur = (string) $tur ?: 'Diğer';
        
        if (!isset($grouped[$tur])) {
            $grouped[$tur] = [];
        }
        $grouped[$tur][] = $mac;
    }
    return $grouped;
}
   public function getTakimlar(int $turnuvaId): array
{
    $takimlar = $this->takimRepo->where('turnuva_id', $turnuvaId)->findAll();
    foreach ($takimlar as $index => $t) {
        if (is_array($t)) {
            $takimlar[$index] = new \App\Models\Entities\TakimEntity($t);
        }
    }
    return $takimlar;
}
}