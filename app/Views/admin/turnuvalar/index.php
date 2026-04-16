<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 fw-bold mb-0">
        <i class="fa-solid fa-trophy text-warning me-2"></i>Turnuva Yönetimi
    </h1>
    <a href="<?= site_url('admin/turnuvalar/new') ?>" class="btn btn-primary rounded-pill px-4">
        <i class="fa-solid fa-plus me-1"></i>Yeni Turnuva
    </a>
</div>

<?php if (session()->has('message')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa-regular fa-circle-check me-1"></i><?= session('message') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>
<?php if (session()->has('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fa-regular fa-circle-xmark me-1"></i><?= session('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark bg-dark">
                <tr>
                    <th class="ps-4">Ad</th>
                    <th>Oyun</th>
                    <th>Durum</th>
                    <th>Başlangıç</th>
                    <th class="text-end pe-4">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($turnuvalar)): ?>
                    <?php foreach ($turnuvalar as $t): ?>
                        <?php
                            // Güvenli veri okuma (Entity veya dizi)
                            $ad        = is_object($t) ? $t->getAd() : ($t['ad'] ?? '');
                            $oyunAdi   = is_object($t) ? $t->getOyunAdi() : ($t['oyun_adi'] ?? 'Bilinmeyen');
                            $durumBadge= is_object($t) ? $t->getDurumBadge() : '';
                            $baslangic = is_object($t) ? ($t->baslangic_tarihi ?? null) : ($t['baslangic_tarihi'] ?? null);
                            $id        = is_object($t) ? $t->id : ($t['id'] ?? 0);
                        ?>
                        <tr>
                            <td class="ps-4 fw-semibold"><?= esc($ad) ?></td>
                            <td>
                                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">
                                    <i class="fa-solid fa-gamepad me-1"></i><?= esc($oyunAdi) ?>
                                </span>
                            </td>
                            <td><?= $durumBadge ?></td>
                            <td>
                                <?php if ($baslangic): ?>
                                    <span class="text-nowrap">
                                        <i class="fa-regular fa-calendar me-1 text-secondary"></i>
                                        <?= date('d M Y', strtotime($baslangic)) ?>
                                    </span>
                                <?php else: ?>
                                    <span class="text-muted">—</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end pe-4">
                                <a href="<?= site_url('admin/turnuvalar/edit/' . $id) ?>" 
                                   class="btn btn-sm btn-outline-warning rounded-pill px-3 me-1">
                                    <i class="fa-regular fa-pen-to-square me-1"></i>Düzenle
                                </a>
                                <a href="<?= site_url('admin/turnuvalar/delete/' . $id) ?>" 
                                   class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                   onclick="return confirm('Bu turnuvayı silmek istediğinize emin misiniz?')">
                                    <i class="fa-regular fa-trash-can me-1"></i>Sil
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <i class="fa-solid fa-trophy fa-3x text-secondary mb-3 opacity-50"></i>
                            <h5 class="fw-bold">Henüz turnuva eklenmemiş</h5>
                            <p class="text-secondary mb-3">Yeni bir turnuva oluşturarak başlayın.</p>
                            <a href="<?= site_url('admin/turnuvalar/new') ?>" class="btn btn-primary rounded-pill px-4">
                                <i class="fa-solid fa-plus me-1"></i>Yeni Turnuva Ekle
                            </a>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Sayfalama -->
<?php if (!empty($pager)): ?>
    <div class="d-flex justify-content-center mt-4">
        <?php
            try {
                echo $pager->links('default', 'bootstrap_pagination');
            } catch (\Exception $e) {
                echo $pager->links('default', 'default_full');
            }
        ?>
    </div>
<?php endif; ?>
<?php if (!empty($pager)): ?>
    <div class="d-flex justify-content-center mt-5">
        <?php
            // Önce 'bootstrap' takma adını dene, yoksa dosya kontrolü yap
            $template = 'bootstrap';
            $config = config('Pager');
            if (!isset($config->templates[$template])) {
                $template = 'default_full';
            }
            echo $pager->links('default', $template);
        ?>
    </div>
<?php endif; ?>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    .table > :not(caption) > * > * {
        padding-top: 1rem;
        padding-bottom: 1rem;
    }
    .table tbody tr:hover {
        background-color: rgba(255,255,255,0.02);
    }
</style>
<?= $this->endSection() ?>