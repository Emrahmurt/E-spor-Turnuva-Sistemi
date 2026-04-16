<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="card-header bg-primary bg-gradient text-white py-4 px-4 border-0">
                <h2 class="h3 fw-bold mb-0">
                    <i class="fa-regular fa-user-circle me-2"></i>Profilim
                </h2>
            </div>

            <div class="card-body p-4 p-lg-5">
                <?php if (session()->has('message')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-regular fa-circle-check me-1"></i><?= session('message') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <div class="row g-4">
                    <div class="col-md-4 text-center">
                        <div class="mb-3">
                            <?php
                                $avatarUrl = 'https://ui-avatars.com/api/?name=' . urlencode($user->username ?? 'User') . '&size=120&background=6366f1&color=fff';
                            ?>
                            <img src="<?= $avatarUrl ?>" alt="Avatar" class="rounded-circle shadow-lg" width="120" height="120">
                        </div>
                        <h5 class="fw-bold mb-1"><?= esc($user->username) ?></h5>
                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mt-2">
                            <i class="fa-regular fa-envelope me-1"></i><?= esc($user->email) ?>
                        </span>
                    </div>

                    <div class="col-md-8">
                        <div class="card bg-light border-0 rounded-4 h-100">
                            <div class="card-body p-4">
                                <h5 class="fw-bold mb-4">
                                    <i class="fa-regular fa-address-card me-2 text-primary"></i>Hesap Bilgileri
                                </h5>

                                <ul class="list-unstyled mb-0">
                                    <li class="mb-3 d-flex align-items-center">
                                        <i class="fa-regular fa-user fa-fw text-primary me-3"></i>
                                        <div>
                                            <small class="text-secondary d-block">Kullanıcı Adı</small>
                                            <strong><?= esc($user->username) ?></strong>
                                        </div>
                                    </li>
                                    <li class="mb-3 d-flex align-items-center">
                                        <i class="fa-regular fa-envelope fa-fw text-primary me-3"></i>
                                        <div>
                                            <small class="text-secondary d-block">E-posta Adresi</small>
                                            <strong><?= esc($user->email) ?></strong>
                                        </div>
                                    </li>
                                    <li class="mb-3 d-flex align-items-center">
                                        <i class="fa-regular fa-calendar fa-fw text-primary me-3"></i>
                                        <div>
                                            <small class="text-secondary d-block">Kayıt Tarihi</small>
                                            <strong><?= $user->created_at ? date('d M Y', strtotime($user->created_at)) : 'Bilinmiyor' ?></strong>
                                        </div>
                                    </li>
                                    <li class="d-flex align-items-center">
                                        <i class="fa-regular fa-shield fa-fw text-primary me-3"></i>
                                        <div>
                                            <small class="text-secondary d-block">Roller</small>
                                            <strong>
                                                <?= !empty($roller) ? esc(implode(', ', $roller)) : 'Kullanıcı' ?>
                                            </strong>
                                        </div>
                                    </li>
                                </ul>

                                <hr class="my-4">

                                <div class="d-flex gap-3">
                                    <a href="#" class="btn btn-outline-primary rounded-pill px-4">
                                        <i class="fa-regular fa-pen-to-square me-1"></i>Düzenle
                                    </a>
                                    <a href="#" class="btn btn-outline-secondary rounded-pill px-4">
                                        <i class="fa-regular fa-key me-1"></i>Şifre Değiştir
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- İstatistikler -->
        <div class="row g-4 mt-2">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 text-center p-3">
                    <i class="fa-solid fa-users fa-2x text-primary mb-2"></i>
                    <h5 class="fw-bold">0</h5>
                    <p class="text-secondary small mb-0">Katıldığım Takımlar</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 text-center p-3">
                    <i class="fa-solid fa-trophy fa-2x text-warning mb-2"></i>
                    <h5 class="fw-bold">0</h5>
                    <p class="text-secondary small mb-0">Kazandığım Turnuvalar</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 text-center p-3">
                    <i class="fa-solid fa-calendar fa-2x text-success mb-2"></i>
                    <h5 class="fw-bold">0</h5>
                    <p class="text-secondary small mb-0">Gelecek Maçlar</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>