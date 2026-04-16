<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row mb-5">
    <div class="col-lg-8 mx-auto text-center">
        <h1 class="display-4 fw-bold mb-3" data-aos="fade-down">
            <i class="fa-solid fa-users text-primary me-2"></i>Takımlar
        </h1>
        <p class="lead text-secondary" data-aos="fade-up" data-aos-delay="100">
            Turnuvalara katılan tüm takımları keşfedin.
        </p>
    </div>
</div>

<div class="row g-4">
    <?php if (!empty($takimlar)): ?>
        <?php foreach ($takimlar as $takim): ?>
            <?php
                // Veri güvenliği: Nesne veya dizi olabilir
                $id      = is_object($takim) ? ($takim->id ?? 0) : ($takim['id'] ?? 0);
                $ad      = is_object($takim) ? $takim->getAd() : ($takim['ad'] ?? '');
                $kisaAd  = is_object($takim) ? $takim->getKisaAd() : ($takim['kisa_ad'] ?? '');
                $logo    = is_object($takim) ? $takim->getLogo() : ($takim['logo'] ?? '');
                $turnuva = is_object($takim) ? ($takim->turnuva_adi ?? '') : ($takim['turnuva_adi'] ?? '');
                $kaptan  = is_object($takim) ? ($takim->kaptan_id ?? null) : ($takim['kaptan_id'] ?? null);
            ?>
            <div class="col-md-6 col-lg-4" data-aos="fade-up">
                <a href="<?= site_url('takimlar/' . $id) ?>" class="text-decoration-none">
                    <div class="card h-100 border-0 shadow-lg rounded-4 overflow-hidden bg-dark text-white match-card">
                        <div class="card-body p-4 d-flex align-items-center">
                            <?php if (!empty($logo)): ?>
                                <img src="<?= esc($logo) ?>" alt="<?= esc($ad) ?>" class="rounded-circle me-3" width="60" height="60" style="object-fit: cover;">
                            <?php else: ?>
                                <div class="rounded-circle bg-primary bg-opacity-25 d-flex align-items-center justify-content-center me-3" style="width:60px;height:60px;">
                                    <i class="fa-solid fa-users fa-2x text-primary"></i>
                                </div>
                            <?php endif; ?>
                            <div>
                                <h5 class="fw-bold mb-1"><?= esc($ad) ?></h5>
                                <?php if (!empty($kisaAd)): ?>
                                    <span class="badge bg-secondary mb-2"><?= esc($kisaAd) ?></span>
                                <?php endif; ?>
                                <p class="text-secondary small mb-0">
                                    <i class="fa-solid fa-trophy me-1"></i><?= esc($turnuva ?: 'Bilinmeyen Turnuva') ?>
                                </p>
                                <?php if ($kaptan): ?>
                                    <p class="text-secondary small mb-0 mt-1">
                                        <i class="fa-solid fa-user me-1"></i>Kaptan ID: <?= esc($kaptan) ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12">
            <div class="text-center py-6" data-aos="zoom-in">
                <i class="fa-solid fa-users-slash fa-4x text-secondary mb-4 opacity-50"></i>
                <h3 class="fw-bold">Henüz Takım Bulunmuyor</h3>
                <p class="text-secondary">İlk takımı oluşturmak için bir turnuvaya kaydolun.</p>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php if (!empty($pager)): ?>
    <div class="d-flex justify-content-center mt-5">
        <?= $pager->links('default', 'bootstrap') ?>
    </div>
<?php endif; ?>

<?= $this->endSection() ?>