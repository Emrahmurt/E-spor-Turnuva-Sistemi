<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-lg-10 mx-auto">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('admin') ?>">Yönetim Paneli</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('admin/takimlar') ?>">Takım Yönetimi</a></li>
                <li class="breadcrumb-item active"><?= esc($takim->getAd()) ?></li>
            </ol>
        </nav>

        <!-- Takım Bilgi Kartı -->
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden bg-dark text-white mb-4">
            <div class="card-body p-5">
                <div class="row align-items-center">
                    <!-- Logo Bölümü -->
                    <div class="col-md-4 text-center mb-4 mb-md-0">
                        <?php if (!empty($takim->logo)): ?>
                            <img src="<?= esc($takim->logo) ?>" alt="<?= esc($takim->getAd()) ?>" 
                                 class="rounded-circle img-fluid border border-3 border-primary" 
                                 style="width: 160px; height: 160px; object-fit: cover;">
                        <?php else: ?>
                            <div class="rounded-circle bg-primary bg-opacity-25 d-inline-flex align-items-center justify-content-center border border-3 border-primary" 
                                 style="width: 160px; height: 160px;">
                                <i class="fa-solid fa-users fa-4x text-primary"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Takım Bilgileri -->
                    <div class="col-md-8">
                        <h1 class="h2 fw-bold mb-2"><?= esc($takim->getAd()) ?></h1>
                        <?php if (!empty($takim->getKisaAd())): ?>
                            <span class="badge bg-secondary mb-3 px-3 py-2"><?= esc($takim->getKisaAd()) ?></span>
                        <?php endif; ?>
                        
                        <div class="row mt-4">
                            <div class="col-sm-6 mb-3">
                                <label class="text-secondary small text-uppercase">Turnuva</label>
                                <div class="fw-semibold fs-5"><?= esc($takim->turnuva_adi) ?></div>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label class="text-secondary small text-uppercase">Kaptan ID</label>
                                <div class="fw-semibold fs-5"><?= esc($takim->kaptan_id) ?></div>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label class="text-secondary small text-uppercase">Kayıt Tarihi</label>
                                <div class="fw-semibold">
                                    <?= $takim->created_at ? date('d M Y', strtotime($takim->created_at)) : '-' ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- İşlem Butonları -->
                <hr class="my-4 border-secondary opacity-25">
                <div class="d-flex justify-content-end gap-2">
                    <a href="<?= site_url('admin/takimlar/edit/' . $takim->id) ?>" class="btn btn-outline-warning rounded-pill px-4">
                        <i class="fa-regular fa-pen-to-square me-1"></i>Düzenle
                    </a>
                    <a href="<?= site_url('admin/takimlar/delete/' . $takim->id) ?>" 
                       class="btn btn-outline-danger rounded-pill px-4" 
                       onclick="return confirm('Bu takımı silmek istediğinize emin misiniz?')">
                        <i class="fa-regular fa-trash-can me-1"></i>Sil
                    </a>
                </div>
            </div>
        </div>

        <!-- Takımın Maçları -->
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden bg-dark text-white">
            <div class="card-header bg-transparent border-0 pt-4 pb-2">
                <h5 class="fw-bold mb-0">
                    <i class="fa-solid fa-futbol text-gradient me-2"></i>Son Maçlar
                </h5>
            </div>
            <div class="card-body p-4">
                <?php if (!empty($maclar)): ?>
                    <div class="table-responsive">
                        <table class="table table-dark table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Tarih</th>
                                    <th>Rakip</th>
                                    <th class="text-center">Skor</th>
                                    <th>Turnuva</th>
                                    <th>Durum</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($maclar as $mac): ?>
                                    <?php
                                        $isTakim1 = ($mac->takim1_id == $takim->id);
                                        $rakipId  = $isTakim1 ? $mac->takim2_id : $mac->takim1_id;
                                        $rakip    = $isTakim1 ? ($mac->takim2_adi ?? 'TBD') : ($mac->takim1_adi ?? 'TBD');
                                        $skorGoster = ($mac->skor1 !== null && $mac->skor2 !== null) 
                                            ? $mac->skor1 . ' - ' . $mac->skor2 
                                            : '- : -';
                                    ?>
                                    <tr>
                                        <td><?= date('d M H:i', strtotime($mac->tarih)) ?></td>
                                        <td><?= esc($rakip) ?></td>
                                        <td class="text-center fw-bold"><?= $skorGoster ?></td>
                                        <td><?= esc($mac->turnuva_adi ?? '-') ?></td>
                                        <td><span class="badge bg-info"><?= esc($mac->durum) ?></span></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-secondary text-center py-4">Henüz maç kaydı bulunmuyor.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>