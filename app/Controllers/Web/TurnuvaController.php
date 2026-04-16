<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use App\Services\TurnuvaService;
use CodeIgniter\Exceptions\PageNotFoundException;

class TurnuvaController extends BaseController
{
    protected TurnuvaService $turnuvaService;

    public function __construct()
    {
        $this->turnuvaService = new TurnuvaService();
    }

    // Ana sayfa: Turnuva listesi
    public function index(): string
{
    $perPage = 12;
    $page    = (int)($this->request->getGet('page') ?? 1);

    $turnuvalar = $this->turnuvaService->getActiveTurnuvalar($perPage, $page);
    $pager      = $this->turnuvaService->getTurnuvaRepo()->pager;

    return $this->render('turnuvalar/index', [
        'title'      => 'e-Spor Turnuvaları',
        'turnuvalar' => $turnuvalar,
        'pager'      => $pager,
    ]);
}
    // Tekil turnuva sayfası
 public function show(string $slug): string
{
    $turnuva = $this->turnuvaService->getTurnuvaBySlug($slug);
    if (!$turnuva) {
        throw PageNotFoundException::forPageNotFound('Turnuva bulunamadı.');
    }

    $takimlar = $this->turnuvaService->getTakimlar($turnuva->id);
    $maclar   = $this->turnuvaService->getMaclarGrouped($turnuva->id);

    return $this->render('turnuvalar/show', [
        'title'    => $turnuva->getAd(),
        'turnuva'  => $turnuva,
        'takimlar' => $takimlar,
        'maclar'   => $maclar,
    ]);
}

}