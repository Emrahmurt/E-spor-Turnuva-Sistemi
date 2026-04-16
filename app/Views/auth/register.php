<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card bg-dark text-white border-0 shadow-lg rounded-4">
            <div class="card-body p-4">
                <h2 class="text-center mb-4">
                    <i class="fa-solid fa-user-plus me-2 text-primary"></i>Kaydol
                </h2>

                <?php if (session()->has('error')): ?>
                    <div class="alert alert-danger"><?= session('error') ?></div>
                <?php endif; ?>

                <?php if (session()->has('errors')): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach (session('errors') as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?= site_url('register') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="username" class="form-label">Kullanıcı Adı</label>
                        <input type="text" name="username" id="username"
                               class="form-control bg-transparent text-white border-secondary"
                               value="<?= old('username') ?>" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">E-posta Adresi</label>
                        <input type="email" name="email" id="email"
                               class="form-control bg-transparent text-white border-secondary"
                               value="<?= old('email') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Şifre</label>
                        <input type="password" name="password" id="password"
                               class="form-control bg-transparent text-white border-secondary" required>
                    </div>

                    <div class="mb-4">
                        <label for="password_confirm" class="form-label">Şifre Tekrar</label>
                        <input type="password" name="password_confirm" id="password_confirm"
                               class="form-control bg-transparent text-white border-secondary" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-semibold">
                        <i class="fa-regular fa-user-plus me-2"></i>Kaydol
                    </button>
                </form>

                <hr class="my-4 border-secondary">

                <p class="text-center small mb-0">
                    Zaten hesabın var mı?
                    <a href="<?= site_url('login') ?>" class="text-primary text-decoration-none fw-semibold">
                        Giriş Yap
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>