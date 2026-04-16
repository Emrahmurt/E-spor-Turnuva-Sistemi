<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Repositories\TurnuvaRepository;
use App\Models\Repositories\OyunRepository;

class TurnuvaController extends BaseController
{
    protected TurnuvaRepository $turnuvaRepo;
    protected OyunRepository $oyunRepo;

    public function __construct()
    {
        $this->turnuvaRepo = new TurnuvaRepository();
        $this->oyunRepo    = new OyunRepository();
    }

    public function index()
    {
        $turnuvalar = $this->turnuvaRepo->orderBy('created_at', 'DESC')->paginate(10);
        foreach ($turnuvalar as $t) {
            if (is_object($t)) {
                $oyun = $this->oyunRepo->find($t->oyun_id);
                $t->oyun = $oyun;
            }
        }

        return view('admin/turnuvalar/index', [
            'title'      => 'Turnuva Yönetimi',
            'turnuvalar' => $turnuvalar,
            'pager'      => $this->turnuvaRepo->pager,
        ]);
    }

    public function new()
    {
        return view('admin/turnuvalar/form', [
            'title'   => 'Yeni Turnuva Ekle',
            'oyunlar' => $this->oyunRepo->findAll(),
        ]);
    }

    public function create()
    {
        $data = $this->request->getPost();
        $data['slug'] = url_title($data['ad'], '-', true);

        if ($this->turnuvaRepo->save($data)) {
            return redirect()->to('admin/turnuvalar')->with('message', 'Turnuva eklendi.');
        }
        return redirect()->back()->withInput()->with('errors', $this->turnuvaRepo->errors());
    }

    public function edit($id)
    {
        $turnuva = $this->turnuvaRepo->find($id);
        if (!$turnuva) {
            return redirect()->to('admin/turnuvalar')->with('error', 'Turnuva bulunamadı.');
        }

        return view('admin/turnuvalar/form', [
            'title'   => 'Turnuva Düzenle: ' . $turnuva->getAd(),
            'turnuva' => $turnuva,
            'oyunlar' => $this->oyunRepo->findAll(),
        ]);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $data['id'] = $id;
        if ($this->turnuvaRepo->save($data)) {
            return redirect()->to('admin/turnuvalar')->with('message', 'Turnuva güncellendi.');
        }
        return redirect()->back()->withInput()->with('errors', $this->turnuvaRepo->errors());
    }

    public function delete($id)
    {
        $this->turnuvaRepo->delete($id);
        return redirect()->to('admin/turnuvalar')->with('message', 'Turnuva silindi.');
    }
}