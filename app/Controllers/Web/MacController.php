<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use App\Models\Repositories\MacRepository;
use App\Models\Repositories\TurnuvaRepository;
use App\Models\Repositories\TakimRepository;

class MacController extends BaseController
{
    protected MacRepository $macRepo;
    protected TurnuvaRepository $turnuvaRepo;
    protected TakimRepository $takimRepo;

    public function __construct()
    {
        $this->macRepo     = new MacRepository();
        $this->turnuvaRepo = new TurnuvaRepository();
        $this->takimRepo   = new TakimRepository();
    }

    public function index()
    {
        $perPage = 12;
        $page    = (int) ($this->request->getGet('page') ?? 1);

        $maclar = $this->macRepo->orderBy('tarih', 'DESC')->paginate($perPage);

        // İlişkili verileri ekle
        foreach ($maclar as $m) {
            if (is_object($m)) {
                $turnuva = $this->turnuvaRepo->find($m->turnuva_id);
                $takim1  = $this->takimRepo->find($m->takim1_id);
                $takim2  = $this->takimRepo->find($m->takim2_id);
                $m->turnuva_adi = $turnuva ? $turnuva->getAd() : '-';
                $m->takim1_adi  = $takim1 ? $takim1->getAd() : 'TBD';
                $m->takim2_adi  = $takim2 ? $takim2->getAd() : 'TBD';
            }
        }

        return $this->render('maclar/index', [
            'title'  => 'Maçlar',
            'maclar' => $maclar,
            'pager'  => $this->macRepo->pager,
        ]);
    }
}