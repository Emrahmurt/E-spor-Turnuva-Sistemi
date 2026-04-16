<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card bg-dark text-white">
            <div class="card-body p-4">
                <h3 class="text-center mb-4">Kaydol</h3>
                
                <?php if (session()->has('error')): ?>
                    <div class="alert alert-danger"><?= session('error') ?></div>
                <?php endif; ?>

                <form action="<?= site_url('register') ?>" method="post">
                    <?= csrf_field() ?>
                    
                    <div class="mb-3">
                        <label>Kullanıcı Adı</label>
                        <input type="text" name="username" class="form-control" value="<?= old('username') ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label>E-posta</label>
                        <input type="email" name="email" class="form-control" value="<?= old('email') ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label>Şifre</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label>Şifre Tekrar</label>
                        <input type="password" name="password_confirm" class="form-control" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100">Kaydol</button>
                </form>
                
                <hr class="my-4">
                <p class="text-center">
                    <a href="<?= site_url('login') ?>">Zaten hesabın var mı? Giriş yap</a>
                </p>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>