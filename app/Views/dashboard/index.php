<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <h1 class="mb-4">Hoş Geldin, <?= esc(auth()->user()->username) ?>!</h1>
        
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fa-solid fa-trophy fa-3x text-warning mb-3"></i>
                        <h5>Turnuvalar</h5>
                        <a href="<?= site_url('turnuvalar') ?>" class="btn btn-outline-primary">Turnuvalara Git</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fa-solid fa-users fa-3x text-primary mb-3"></i>
                        <h5>Takımlar</h5>
                        <a href="<?= site_url('takimlar') ?>" class="btn btn-outline-primary">Takımlara Git</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fa-solid fa-chart-line fa-3x text-success mb-3"></i>
                        <h5>Medya Değeri</h5>
                        <a href="<?= site_url('media-value') ?>" class="btn btn-outline-primary">Hesapla</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>