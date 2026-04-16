<!DOCTYPE html>
<html lang="tr" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'E-Spor Turnuvaları' ?> | TurnuvaMerkezi</title>
    <meta name="description" content="<?= $meta_description ?? 'En güncel e-spor turnuvaları, takımlar ve maç sonuçları.' ?>">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('favicon.ico') ?>">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- AOS Animation CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">

    <!-- Özel Stil Dosyası -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

    <!-- Ekstra CSS -->
    <style>
        .main-content {
            margin-bottom: 100px !important;
        }
        body {
            background-color: #0f0f1a;
            font-family: 'Inter', sans-serif;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
        }
    </style>

    <?= $this->renderSection('styles') ?>
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark" style="background: rgba(18, 18, 30, 0.85); backdrop-filter: blur(12px);">
        <div class="container">
            <!-- LOGO: title eklendi, Turnuva mavi ve kalın, Merkezi beyaz -->
            <a class="navbar-brand fw-bold fs-3" href="<?= site_url('/') ?>" title="TurnuvaMerkezi">
                <i class="fa-solid fa-gamepad me-2" style="color: #0ea5e9;"></i>
                <span style="color: #0ea5e9; font-weight: 800;">Turnuva</span><span style="color: #ffffff; font-weight: 600;">Merkezi</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                    <li class="nav-item"><a class="nav-link <?= url_is('/') ? 'active' : '' ?>" href="<?= site_url('/') ?>"><i class="fa-solid fa-house me-1"></i>Ana Sayfa</a></li>
                    <li class="nav-item"><a class="nav-link <?= url_is('turnuvalar*') ? 'active' : '' ?>" href="<?= site_url('turnuvalar') ?>"><i class="fa-solid fa-trophy me-1"></i>Turnuvalar</a></li>
                    <li class="nav-item"><a class="nav-link <?= url_is('takimlar*') ? 'active' : '' ?>" href="<?= site_url('takimlar') ?>"><i class="fa-solid fa-users me-1"></i>Takımlar</a></li>
                    <li class="nav-item"><a class="nav-link <?= url_is('media-value*') ? 'active' : '' ?>" href="<?= site_url('media-value') ?>"><i class="fa-solid fa-chart-line me-1"></i>Medya Değeri</a></li>

                    <?php if (auth()->loggedIn()): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <img src="https://ui-avatars.com/api/?name=<?= urlencode(auth()->user()->username) ?>&background=6366f1&color=fff" class="rounded-circle me-1" width="32" height="32" alt="avatar">
                                <?= esc(auth()->user()->username) ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="<?= site_url('profil') ?>"><i class="fa-regular fa-user me-2"></i>Profilim</a></li>
                                <?php if (auth()->user()->inGroup('admin')): ?>
                                    <li><a class="dropdown-item" href="<?= site_url('admin') ?>"><i class="fa-regular fa-gauge-high me-2"></i>Yönetim Paneli</a></li>
                                <?php endif; ?>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?= site_url('logout') ?>"><i class="fa-solid fa-right-from-bracket me-2"></i>Çıkış Yap</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item"><a class="btn btn-outline-light ms-2 rounded-pill px-4" href="<?= site_url('login') ?>"><i class="fa-solid fa-arrow-right-to-bracket me-1"></i>Giriş Yap</a></li>
                        <li class="nav-item"><a class="btn btn-primary ms-2 rounded-pill px-4" href="<?= site_url('register') ?>">Kaydol</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Ana İçerik -->
    <main class="flex-fill mt-5 pt-4">
    <div class="container">
        <?= $this->renderSection('content') ?>
    </div>
</main>

    <!-- Footer -->
    <footer class="footer mt-auto py-4 bg-dark text-white">
        <div class="container">
            <div class="row gy-4">
                <div class="col-md-4">
                    <h5 class="fw-bold"><i class="fa-solid fa-gamepad me-2"></i>TurnuvaMerkezi</h5>
                    <p class="text-secondary small">En büyük e-spor turnuva platformu. Takımını kur, turnuvalara katıl, şampiyon ol!</p>
                    <div>
                        <a href="#" class="text-secondary me-3"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#" class="text-secondary me-3"><i class="fa-brands fa-discord"></i></a>
                        <a href="#" class="text-secondary"><i class="fa-brands fa-twitch"></i></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <h6 class="fw-bold">Keşfet</h6>
                    <ul class="list-unstyled">
                        <li><a href="<?= site_url('turnuvalar') ?>" class="text-secondary text-decoration-none">Turnuvalar</a></li>
                        <li><a href="<?= site_url('takimlar') ?>" class="text-secondary text-decoration-none">Takımlar</a></li>
                        <li><a href="<?= site_url('maclar') ?>" class="text-secondary text-decoration-none">Maçlar</a></li>
                       
                    </ul>
                </div>
                <div class="col-md-2">
                    <h6 class="fw-bold">Destek</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-secondary text-decoration-none">SSS</a></li>
                        <li><a href="#" class="text-secondary text-decoration-none">Kurallar</a></li>
                        <li><a href="#" class="text-secondary text-decoration-none">İletişim</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6 class="fw-bold">Bülten</h6>
                    <p class="small text-secondary">Yeni turnuvalardan haberdar ol.</p>
                    <div class="input-group">
                        <input type="email" class="form-control form-control-sm" placeholder="E-posta adresiniz">
                        <button class="btn btn-primary btn-sm" type="button">Abone Ol</button>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <span class="text-secondary small">© <?= date('Y') ?> TurnuvaMerkezi. Tüm hakları saklıdır.</span>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="text-secondary small text-decoration-none me-3">Gizlilik</a>
                    <a href="#" class="text-secondary small text-decoration-none">Kullanım Koşulları</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Özel JS -->
    <script src="<?= base_url('assets/js/main.js') ?>"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({ duration: 800, once: true });

            <?php if (session()->has('message')): ?>
                Swal.fire({ icon: 'success', title: 'Başarılı', text: '<?= session('message') ?>', timer: 3000, showConfirmButton: false });
            <?php endif; ?>
            <?php if (session()->has('error')): ?>
                Swal.fire({ icon: 'error', title: 'Hata', text: '<?= session('error') ?>' });
            <?php endif; ?>
        });
    </script>

    <?= $this->renderSection('scripts') ?>
</body>
</html>