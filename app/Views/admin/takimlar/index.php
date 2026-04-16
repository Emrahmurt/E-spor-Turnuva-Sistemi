<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 fw-bold mb-0">
        <i class="fa-solid fa-users text-primary me-2"></i>Takım Yönetimi
    </h1>
    <a href="<?= site_url('admin/takimlar/new') ?>" class="btn btn-primary rounded-pill px-4">
        <i class="fa-solid fa-plus me-1"></i>Yeni Takım Ekle
    </a>
</div>

<?php if (session()->has('message')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session('message') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>
<?php if (session()->has('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="row g-4">
    <?php if (!empty($takimlar)): ?>
     <?php foreach ($takimlar as $t): ?>
    <?php
        $id      = is_object($t) ? $t->id : ($t['id'] ?? 0);
        $ad      = is_object($t) ? $t->getAd() : ($t['ad'] ?? '');
        $kisaAd  = is_object($t) ? $t->getKisaAd() : ($t['kisa_ad'] ?? '');
        $turnuva = is_object($t) ? ($t->turnuva_adi ?? '') : ($t['turnuva_adi'] ?? '');
        $kaptan  = is_object($t) ? $t->kaptan_id : ($t['kaptan_id'] ?? '-');
        $logo    = is_object($t) ? $t->getLogo() : ($t['logo'] ?? '');
    ?>
    <div class="col-sm-6 col-lg-4 col-xl-3" data-aos="fade-up">
        <!-- KARTI SARAN TIKLANABİLİR ALAN -->
        <a href="<?= site_url('admin/takimlar/show/' . $id) ?>" class="text-decoration-none">
            <div class="card h-100 border-0 shadow-lg rounded-4 overflow-hidden bg-dark text-white">
                <!-- Logo Bölümü -->
                <div class="card-header bg-transparent border-0 pt-4 pb-2 text-center">
                    <?php if (!empty($logo)): ?>
                        <img src="<?= esc($logo) ?>" alt="<?= esc($ad) ?>" class="rounded-circle border border-3 border-primary" width="80" height="80" style="object-fit: cover;">
                    <?php else: ?>
                        <div class="rounded-circle bg-primary bg-opacity-25 d-flex align-items-center justify-content-center mx-auto border border-3 border-primary" style="width: 80px; height: 80px;">
                            <i class="fa-solid fa-users fa-3x text-primary"></i>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- İçerik -->
                <div class="card-body text-center px-3 pb-3">
                    <h5 class="fw-bold mb-1"><?= esc($ad) ?></h5>
                    <?php if (!empty($kisaAd)): ?>
                        <span class="badge bg-secondary mb-2"><?= esc($kisaAd) ?></span>
                    <?php endif; ?>

                    <div class="small text-secondary mt-3">
                        <div class="d-flex justify-content-between border-bottom border-secondary py-2">
                            <span><i class="fa-solid fa-trophy me-1"></i>Turnuva</span>
                            <span class="text-white"><?= esc($turnuva) ?></span>
                        </div>
                        <div class="d-flex justify-content-between py-2">
                            <span><i class="fa-solid fa-user me-1"></i>Kaptan ID</span>
                            <span class="text-white"><?= esc($kaptan) ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <!-- Düzenle ve Sil Butonları (Kartın Dışında) -->
        <div class="d-flex justify-content-center gap-2 mt-2">
            <a href="<?= site_url('admin/takimlar/edit/' . $id) ?>" class="btn btn-sm btn-outline-warning rounded-pill px-3">
                <i class="fa-regular fa-pen-to-square me-1"></i>Düzenle
            </a>
            <a href="<?= site_url('admin/takimlar/delete/' . $id) ?>" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirm('Silmek istediğinize emin misiniz?')">
                <i class="fa-regular fa-trash-can me-1"></i>Sil
            </a>
        </div>
    </div>
<?php endforeach; ?>
    <?php else: ?>
        <div class="col-12">
            <div class="text-center py-6">
                <i class="fa-solid fa-users-slash fa-4x text-secondary mb-4 opacity-50"></i>
                <h3 class="fw-bold">Henüz takım eklenmemiş</h3>
                <p class="text-secondary">İlk takımı eklemek için butonu kullanın.</p>
                <a href="<?= site_url('admin/takimlar/new') ?>" class="btn btn-primary rounded-pill px-4 mt-3">
                    <i class="fa-solid fa-plus me-1"></i>Yeni Takım Ekle
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Sayfalama -->
<?php if (!empty($pager)): ?>
    <div class="d-flex justify-content-center mt-5">
        <?= $pager->links('default', 'bootstrap') ?>
    </div>
<?php endif; ?>

<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    .match-card {
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        background-color: #1a1a2e !important;
        border: 1px solid rgba(255, 255, 255, 0.05);
    }
    .match-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 30px -8px rgba(0, 0, 0, 0.4) !important;
    }
    .py-6 {
        padding-top: 4rem !important;
        padding-bottom: 4rem !important;
    }
</style>
<?= $this->endSection() ?>