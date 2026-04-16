<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row mb-5">
    <div class="col-lg-8 mx-auto text-center">
        <h1 class="display-4 fw-bold mb-3" data-aos="fade-down">
            <i class="fa-solid fa-trophy text-warning me-2"></i>Turnuvalar
        </h1>
        <p class="lead text-secondary" data-aos="fade-up" data-aos-delay="100">
            En güncel e-spor turnuvalarına göz at, takımını kur, şampiyonluk için mücadele et!
        </p>
    </div>
</div>

<div class="row g-4">
    <?php if (!empty($turnuvalar)): ?>
        <?php $index = 0; ?>
        <?php foreach ($turnuvalar as $t): ?>
            <?php
                $ad        = is_object($t) ? $t->getAd() : ($t['ad'] ?? '');
                $oyunAdi   = is_object($t) ? $t->getOyunAdi() : ($t['oyun_adi'] ?? 'Bilinmeyen Oyun');
                $aciklama  = is_object($t) ? $t->getAciklama() : ($t['aciklama'] ?? '');
                $odul      = is_object($t) ? $t->getOdul() : ($t['odul'] ?? '');
                $link      = is_object($t) ? $t->getLink() : site_url('turnuvalar/' . ($t['slug'] ?? ''));
                $baslangic = is_object($t) ? ($t->baslangic_tarihi ?? null) : ($t['baslangic_tarihi'] ?? null);
                $kayitBitis= is_object($t) ? ($t->kayit_bitis ?? null) : ($t['kayit_bitis'] ?? null);
                $durumBadge= is_object($t) ? $t->getDurumBadge() : '';
            ?>
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="<?= 100 * ($index % 3) ?>">
                <div class="card h-100 border-0 shadow-lg rounded-4 overflow-hidden bg-dark text-white">
                    <div class="card-header bg-primary bg-opacity-25 border-0 py-3 px-4 d-flex justify-content-between align-items-center">
                        <span class="badge bg-primary text-white px-3 py-2 rounded-pill">
                            <i class="fa-solid fa-gamepad me-1"></i><?= esc($oyunAdi) ?>
                        </span>
                        <?= $durumBadge ?>
                    </div>
                    <div class="card-body p-4">
                        <h3 class="h4 fw-bold mb-3">
                            <a href="<?= $link ?>" class="text-decoration-none text-white stretched-link-hover">
                                <?= esc($ad) ?>
                            </a>
                        </h3>
                        <p class="text-secondary mb-4"><?= character_limiter(strip_tags($aciklama), 120) ?></p>
                        <div class="d-flex flex-column gap-3 mt-auto">
                            <?php if ($baslangic): ?>
                                <div class="d-flex align-items-center text-secondary">
                                    <i class="fa-regular fa-calendar-check me-3 fa-fw text-primary"></i>
                                    <span>Başlangıç: <strong class="text-white"><?= date('d M Y', strtotime($baslangic)) ?></strong></span>
                                </div>
                            <?php endif; ?>
                            <?php if ($kayitBitis): ?>
                                <div class="d-flex align-items-center text-secondary">
                                    <i class="fa-regular fa-hourglass-half me-3 fa-fw text-warning"></i>
                                    <span>Kayıt Bitiş: <strong class="text-white"><?= date('d M Y', strtotime($kayitBitis)) ?></strong></span>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($odul)): ?>
                                <div class="d-flex align-items-center text-success">
                                    <i class="fa-solid fa-trophy me-3 fa-fw"></i>
                                    <span>Ödül: <strong><?= esc($odul) ?></strong></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pb-4 px-4 d-flex justify-content-end">
                        <a href="<?= $link ?>" class="btn btn-outline-primary rounded-pill px-4">
                            Detaylar <i class="fa-solid fa-trophy ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php $index++; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12">
            <div class="text-center py-6" data-aos="zoom-in">
                <i class="fa-solid fa-trophy fa-4x text-secondary mb-4 opacity-50"></i>
                <h3 class="fw-bold">Aktif Turnuva Bulunmuyor</h3>
                <p class="text-secondary">Yeni turnuvalar için takipte kalın.</p>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php if (!empty($pager)): ?>
    <div class="d-flex justify-content-center mt-5">
        <?php
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