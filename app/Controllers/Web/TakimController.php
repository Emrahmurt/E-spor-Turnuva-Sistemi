<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use App\Models\Repositories\TakimRepository;
use App\Models\Repositories\TurnuvaRepository;

class TakimController extends BaseController
{
    protected TakimRepository $takimRepo;
    protected TurnuvaRepository $turnuvaRepo;

    public function __construct()
    {
        $this->takimRepo = new TakimRepository();
        $this->turnuvaRepo = new TurnuvaRepository();
    }
public function show($id)
{
    $takim = $this->takimRepo->find($id);
    if (!$takim) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Takım bulunamadı.');
    }

    $turnuva = $this->turnuvaRepo->find($takim->turnuva_id);
    $takim->turnuva_adi = $turnuva ? $turnuva->getAd() : 'Bilinmeyen';

    return $this->render('takimlar/show', [
        'title' => $takim->getAd() . ' - Takım Detayı',
        'takim' => $takim,
    ]);
}
    public function index(): string
    {
        $perPage = 12;
        $page    = (int) ($this->request->getGet('page') ?? 1);

        $takimlar = $this->takimRepo->orderBy('created_at', 'DESC')->paginate($perPage);
        
        // Her takıma turnuva adını ekle (isteğe bağlı)
        foreach ($takimlar as $t) {
            if (is_object($t)) {
                $turnuva = $this->turnuvaRepo->find($t->turnuva_id);
                $t->turnuva_adi = $turnuva ? $turnuva->getAd() : 'Bilinmeyen Turnuva';
            }
        }

        return $this->render('takimlar/index', [
            'title'    => 'Takımlar',
            'takimlar' => $takimlar,
            'pager'    => $this->takimRepo->pager,
        ]);
    }
}