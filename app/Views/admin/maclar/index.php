<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 fw-bold mb-0">
        <i class="fa-solid fa-futbol text-danger me-2"></i>Maç Yönetimi
    </h1>
    <a href="<?= site_url('admin/maclar/new') ?>" class="btn btn-primary rounded-pill px-4">
        <i class="fa-solid fa-plus me-1"></i>Yeni Maç
    </a>
</div>

<?php if (session()->has('message')): ?>
    <div class="alert alert-success"><?= session('message') ?></div>
<?php endif; ?>
<?php if (session()->has('error')): ?>
    <div class="alert alert-danger"><?= session('error') ?></div>
<?php endif; ?>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark bg-dark">
                <tr>
                    <th>Turnuva</th>
                    <th>Takım 1</th>
                    <th>Skor</th>
                    <th>Takım 2</th>
                    <th>Tarih</th>
                    <th>Tur</th>
                    <th>Durum</th>
                    <th class="text-end">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($maclar)): ?>
                    <?php foreach ($maclar as $m): ?>
                        <tr>
                            <td><?= esc($m->turnuva_adi ?? '') ?></td>
                            <td><?= esc($m->takim1_adi ?? 'TBD') ?></td>
                            <td class="fw-bold text-center">
                                <?= ($m->skor1 !== null && $m->skor2 !== null) ? $m->skor1 . ' - ' . $m->skor2 : '- : -' ?>
                            </td>
                            <td><?= esc($m->takim2_adi ?? 'TBD') ?></td>
                            <td><?= $m->tarih ? date('d M H:i', strtotime($m->tarih)) : '-' ?></td>
                            <td><?= esc($m->tur) ?></td>
                            <td><span class="badge bg-info"><?= esc($m->durum) ?></span></td>
                            <td class="text-end">
                                <a href="<?= site_url('admin/maclar/edit/' . $m->id) ?>" class="btn btn-sm btn-outline-warning me-1">Düzenle</a>
                                <a href="<?= site_url('admin/maclar/delete/' . $m->id) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Silinsin mi?')">Sil</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="8" class="text-center py-5">Henüz maç eklenmemiş.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php if (!empty($pager)): ?>
    <div class="d-flex justify-content-center mt-4">
        <?= $pager->links('default', 'bootstrap') ?>
    </div>
<?php endif; ?>

<?= $this->endSection() ?>