<?php

namespace App\Controllers\Admin;

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
        $maclar = $this->macRepo->orderBy('tarih', 'DESC')->paginate(10);
        
        // İlişkili turnuva ve takım bilgilerini ekleyelim
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

        return view('admin/maclar/index', [
            'title'  => 'Maç Yönetimi',
            'maclar' => $maclar,
            'pager'  => $this->macRepo->pager,
        ]);
    }

    public function new()
    {
        $turnuvalar = $this->turnuvaRepo->findAll();
        $takimlar   = $this->takimRepo->findAll();
        return view('admin/maclar/form', [
            'title'      => 'Yeni Maç Ekle',
            'turnuvalar' => $turnuvalar,
            'takimlar'   => $takimlar,
        ]);
    }

    public function create()
    {
        $data = $this->request->getPost();
        if ($this->macRepo->save($data)) {
            return redirect()->to('admin/maclar')->with('message', 'Maç eklendi.');
        }
        return redirect()->back()->withInput()->with('errors', $this->macRepo->errors());
    }

    public function edit($id)
    {
        $mac = $this->macRepo->find($id);
        if (!$mac) {
            return redirect()->to('admin/maclar')->with('error', 'Maç bulunamadı.');
        }
        $turnuvalar = $this->turnuvaRepo->findAll();
        $takimlar   = $this->takimRepo->findAll();
        return view('admin/maclar/form', [
            'title'      => 'Maç Düzenle',
            'mac'        => $mac,
            'turnuvalar' => $turnuvalar,
            'takimlar'   => $takimlar,
        ]);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $data['id'] = $id;
        if ($this->macRepo->save($data)) {
            return redirect()->to('admin/maclar')->with('message', 'Maç güncellendi.');
        }
        return redirect()->back()->withInput()->with('errors', $this->macRepo->errors());
    }

    public function delete($id)
    {
        $this->macRepo->delete($id);
        return redirect()->to('admin/maclar')->with('message', 'Maç silindi.');
    }
}