<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Repositories\TakimRepository;
use App\Models\Repositories\TurnuvaRepository;

class TakimController extends BaseController
{
    protected TakimRepository $takimRepo;
    protected TurnuvaRepository $turnuvaRepo;

    public function __construct()
    {
        $this->takimRepo   = new TakimRepository();
        $this->turnuvaRepo = new TurnuvaRepository();
    }

    // Listeleme
    public function index()
    {
        $takimlar = $this->takimRepo->orderBy('created_at', 'DESC')->paginate(10);
        foreach ($takimlar as $t) {
            if (is_object($t)) {
                $turnuva = $this->turnuvaRepo->find($t->turnuva_id);
                $t->turnuva_adi = $turnuva ? $turnuva->getAd() : 'Bilinmeyen';
            }
        }

       return view('admin/takimlar/index', [
    'title'    => 'Takım Yönetimi',
    'takimlar' => $takimlar,
    'pager'    => $this->takimRepo->pager,
]);
    }
    /**
 * Takım detay sayfası
 */
/**
 * Takım detay sayfası
 */
public function show($id)
{
    $takim = $this->takimRepo->find($id);
    if (!$takim) {
        return redirect()->to('admin/takimlar')->with('error', 'Takım bulunamadı.');
    }

    // Turnuva adını ekle
    $turnuva = $this->turnuvaRepo->find($takim->turnuva_id);
    $takim->turnuva_adi = $turnuva ? $turnuva->getAd() : 'Bilinmeyen';

    // Maçları getir (opsiyonel)
    $maclar = [];
    if (class_exists('\App\Models\Repositories\MacRepository')) {
        $macRepo = new \App\Models\Repositories\MacRepository();
        $maclar = $macRepo->where('takim1_id', $id)
                          ->orWhere('takim2_id', $id)
                          ->orderBy('tarih', 'DESC')
                          ->findAll(5);
    }

    return view('admin/takimlar/show', [
        'title'  => $takim->getAd() . ' - Detay',
        'takim'  => $takim,
        'maclar' => $maclar,
    ]);
}

    // Yeni form
    public function new()
    {
        $turnuvalar = $this->turnuvaRepo->findAll();
        return view('admin/takimlar/form', [
            'title'      => 'Yeni Takım Ekle',
            'turnuvalar' => $turnuvalar,
        ]);
    }

    // Kaydet (create)
    public function create()
    {
        $data = $this->request->getPost();
        if ($this->takimRepo->save($data)) {
            return redirect()->to('admin/takimlar')->with('message', 'Takım eklendi.');
        }
        return redirect()->back()->withInput()->with('errors', $this->takimRepo->errors());
    }

    // Düzenle form
    public function edit($id)
    {
        $takim = $this->takimRepo->find($id);
        if (!$takim) {
            return redirect()->to('admin/takimlar')->with('error', 'Takım bulunamadı.');
        }
        $turnuvalar = $this->turnuvaRepo->findAll();
        return view('admin/takimlar/form', [
            'title'      => 'Takım Düzenle: ' . $takim->getAd(),
            'takim'      => $takim,
            'turnuvalar' => $turnuvalar,
        ]);
    }

    // Güncelle (update)
    public function update($id)
    {
        $data = $this->request->getPost();
        $data['id'] = $id;
        if ($this->takimRepo->save($data)) {
            return redirect()->to('admin/takimlar')->with('message', 'Takım güncellendi.');
        }
        return redirect()->back()->withInput()->with('errors', $this->takimRepo->errors());
    }

    // Sil (delete)
    public function delete($id)
{
    $this->takimRepo->delete($id);
    return redirect()->to('admin/takimlar')->with('message', 'Takım silindi.');
}
}