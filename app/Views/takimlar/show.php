<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
    <!-- Kart genişliği küçültüldü: col-lg-8 -> col-lg-6 -->
    <div class="col-lg-6">
        <!-- Breadcrumb (isteğe bağlı kaldırabilirsiniz) -->
        <?php /*<nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item"><a href="<?= site_url('/') ?>">Ana Sayfa</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('takimlar') ?>">Takımlar</a></li>
                <li class="breadcrumb-item active"><?= esc($takim->getAd()) ?></li>
            </ol>
        </nav>*/ ?>

        <div class="card border-0 shadow-lg rounded-4 overflow-hidden bg-dark text-white">
            <!-- İç boşluk azaltıldı: p-5 -> p-4 -->
            <div class="card-body p-4 text-center">
                <!-- Logo boyutu küçültüldü: 120x120 -> 80x80 -->
                <?php if (!empty($takim->logo)): ?>
                    <img src="<?= esc($takim->logo) ?>"
                         alt="<?= esc($takim->getAd()) ?>"
                         class="rounded-circle border border-3 border-primary mb-3"
                         width="80" height="80" style="object-fit: cover;">
                <?php else: ?>
                    <div class="rounded-circle bg-primary bg-opacity-25 d-inline-flex align-items-center justify-content-center border border-3 border-primary mb-3"
                         style="width:80px;height:80px;">
                        <i class="fa-solid fa-users fa-2x text-primary"></i>
                    </div>
                <?php endif; ?>

                <!-- Başlık boyutu küçültüldü: h1 -> h3 -->
                <h3 class="fw-bold mb-2"><?= esc($takim->getAd()) ?></h3>
                <?php if ($takim->getKisaAd()): ?>
                    <span class="badge bg-secondary mb-2 px-3 py-1"><?= esc($takim->getKisaAd()) ?></span>
                <?php endif; ?>

                <!-- Ayraç boşluğu azaltıldı -->
                <hr class="my-3 border-secondary opacity-25">

                <!-- Bilgi satırları küçültüldü (small sınıfı eklendi) -->
                <div class="row text-start small">
                    <div class="col-sm-6 mb-2">
                        <label class="text-secondary text-uppercase small fw-semibold">Turnuva</label>
                        <div class="fw-semibold"><?= esc($takim->turnuva_adi ?? 'Bilinmeyen') ?></div>
                    </div>
                    <div class="col-sm-6 mb-2">
                        <label class="text-secondary text-uppercase small fw-semibold">Kaptan ID</label>
                        <div class="fw-semibold"><?= esc($takim->kaptan_id ?? '-') ?></div>
                    </div>
                    <div class="col-sm-6 mb-2">
                        <label class="text-secondary text-uppercase small fw-semibold">Kayıt Tarihi</label>
                        <div class="fw-semibold"><?= $takim->created_at ? date('d M Y', strtotime($takim->created_at)) : '-' ?></div>
                    </div>
                </div>

                <!-- Geri dön butonu küçültüldü: btn-lg -> btn-sm -->
                <a href="<?= site_url('takimlar') ?>" class="btn btn-outline-light btn-sm rounded-pill px-4 mt-3">
                    <i class="fa-solid fa-arrow-left me-2"></i>Tüm Takımlara Dön
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>