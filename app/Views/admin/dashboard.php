<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h1 class="mb-4"><i class="fa-solid fa-gauge-high me-2"></i>Yönetim Paneli</h1>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card text-center h-100 border-0 shadow-sm rounded-4">
            <div class="card-body py-5">
                <i class="fa-solid fa-trophy fa-3x text-warning mb-3"></i>
                <h5 class="fw-bold">Turnuvalar</h5>
                <p class="text-secondary small">Turnuva ekle, düzenle, sil</p>
                <a href="<?= site_url('admin/turnuvalar') ?>" class="btn btn-outline-warning rounded-pill px-4">
                    Yönet <i class="fa-regular fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center h-100 border-0 shadow-sm rounded-4">
            <div class="card-body py-5">
                <i class="fa-solid fa-users fa-3x text-primary mb-3"></i>
                <h5 class="fw-bold">Takımlar</h5>
                <p class="text-secondary small">Takımları yönet, düzenle</p>
                <a href="<?= site_url('admin/takimlar') ?>" class="btn btn-outline-primary rounded-pill px-4">
                    Yönet <i class="fa-regular fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center h-100 border-0 shadow-sm rounded-4">
            <div class="card-body py-5">
                <i class="fa-solid fa-futbol fa-3x text-danger mb-3"></i>
                <h5 class="fw-bold">Maçlar</h5>
                <p class="text-secondary small">Maç programı ve sonuçları</p>
                <a href="<?= site_url('admin/maclar') ?>" class="btn btn-outline-danger rounded-pill px-4">
                    Yönet <i class="fa-regular fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>