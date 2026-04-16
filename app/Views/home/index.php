<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- Hero Bölümü -->
<section class="py-5 py-lg-6">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-3">
                    <i class="fa-solid fa-bolt me-1"></i>Türkiye'nin E-Spor Platformu
                </span>
                <h1 class="display-3 fw-bold mb-4">
                    <span class="text-gradient">Şampiyonluğa</span> Giden Yol Burada Başlar
                </h1>
                <p class="lead text-secondary mb-4">
                    TurnuvaMerkezi ile takımını kur, turnuvalara katıl, ödülleri topla. 
                    İster amatör ister profesyonel, her seviyeye uygun turnuvalar seni bekliyor.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="<?= site_url('turnuvalar') ?>" class="btn btn-primary btn-lg rounded-pill px-4">
                        <i class="fa-solid fa-trophy me-2"></i>Turnuvaları Keşfet
                    </a>
                    <a href="<?= site_url('register') ?>" class="btn btn-primary btn-lg rounded-pill px-4">
                        <i class="fa-solid fa-user-plus me-2"></i>Hemen Kaydol
                    </a>
                </div>
                <div class="mt-4 d-flex align-items-center gap-4">
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-check-circle text-success me-2"></i>
                        <span class="small">Ücretsiz Katılım</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-check-circle text-success me-2"></i>
                        <span class="small">Canlı Destek</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="position-relative">
                    <div class="bg-primary bg-opacity-10 rounded-4 p-4">
                        <img src="https://cmsassets.rgpub.io/sanity/images/dsfx7636/news_live/8c1b51d99fe1d4174f4c60fa808e782c29f48a1c-1920x1080.jpg?accountingTag=VAL&auto=format&fit=fill&q=80&w=1480" 
                             class="img-fluid rounded-3" alt="E-Spor" 
                             style="filter: drop-shadow(0 0 20px rgba(99,102,241,0.3));">
                    </div>
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Öne Çıkan Turnuvalar -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-6 fw-bold mb-3">Öne Çıkan Turnuvalar</h2>
            <p class="text-secondary">Kaçırmaman gereken en popüler turnuvalar</p>
        </div>

        <div class="row g-4">
            <?php
            // Örnek turnuvaları göster (gerçek verilerle değiştirebilirsin)
            $featured = [
                ['ad' => 'Valorant Şampiyonlar Ligi', 'oyun' => 'Valorant', 'odul' => '50.000 TL', 'tarih' => '15 May 2026'],
                ['ad' => 'LoL Yaz Kupası', 'oyun' => 'League of Legends', 'odul' => '25.000 TL', 'tarih' => '22 May 2026'],
                ['ad' => 'CS2 Türkiye Masters', 'oyun' => 'CS2', 'odul' => '75.000 TL', 'tarih' => '10 Haz 2026'],
            ];
            foreach ($featured as $index => $t):
            ?>
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="<?= 100 * $index ?>">
                <div class="card h-100 border-0 shadow-lg rounded-4 bg-dark text-white">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between mb-3">
                            <span class="badge bg-primary"><?= $t['oyun'] ?></span>
                            <span class="badge bg-success">Kayıt Açık</span>
                        </div>
                        <h4 class="fw-bold mb-2"><?= $t['ad'] ?></h4>
                        <p class="text-secondary mb-3">
                            <i class="fa-regular fa-calendar me-1"></i><?= $t['tarih'] ?>
                        </p>
                        <p class="text-success mb-3">
                            <i class="fa-solid fa-trophy me-1"></i><?= $t['odul'] ?>
                        </p>
                        <a href="<?= site_url('turnuvalar') ?>" class="btn btn-outline-primary w-100 rounded-pill">
                            Detaylar <i class="fa-solid fa-trophy" me-1></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-5" data-aos="fade-up">
            <a href="<?= site_url('turnuvalar') ?>" class="btn btn-outline-light rounded-pill px-5">
                Tüm Turnuvaları Gör <i class="fa-regular fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Nasıl Çalışır? -->
<section class="py-5 bg-dark bg-opacity-25 rounded-4 my-5">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-6 fw-bold mb-3">Nasıl Çalışır?</h2>
            <p class="text-secondary">Üç adımda turnuva heyecanına ortak ol</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="0">
                <div class="text-center p-4">
                    <div class="rounded-circle bg-primary bg-opacity-25 d-inline-flex align-items-center justify-content-center mb-3" style="width:80px;height:80px;">
                        <i class="fa-solid fa-user-plus fa-3x text-primary"></i>
                    </div>
                    <h5 class="fw-bold">1. Kaydol</h5>
                    <p class="text-secondary small">Hemen ücretsiz hesap oluştur, profiline takım arkadaşlarını ekle.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="text-center p-4">
                    <div class="rounded-circle bg-primary bg-opacity-25 d-inline-flex align-items-center justify-content-center mb-3" style="width:80px;height:80px;">
                        <i class="fa-solid fa-trophy fa-3x text-primary"></i>
                    </div>
                    <h5 class="fw-bold">2. Turnuva Seç</h5>
                    <p class="text-secondary small">Oyununu ve seviyene uygun turnuvayı seç, takımınla kaydol.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="text-center p-4">
                    <div class="rounded-circle bg-primary bg-opacity-25 d-inline-flex align-items-center justify-content-center mb-3" style="width:80px;height:80px;">
                        <i class="fa-solid fa-medal fa-3x text-primary"></i>
                    </div>
                    <h5 class="fw-bold">3. Şampiyon Ol</h5>
                    <p class="text-secondary small">Maçlarını kazan, puan tablosunda yüksel ve ödülleri topla!</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- İstatistikler -->
<section class="py-5">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-md-3" data-aos="zoom-in" data-aos-delay="0">
                <div class="p-4">
                    <i class="fa-solid fa-trophy fa-3x text-warning mb-3"></i>
                    <h3 class="display-5 fw-bold">15+</h3>
                    <p class="text-secondary">Aktif Turnuva</p>
                </div>
            </div>
            <div class="col-md-3" data-aos="zoom-in" data-aos-delay="100">
                <div class="p-4">
                    <i class="fa-solid fa-users fa-3x text-primary mb-3"></i>
                    <h3 class="display-5 fw-bold">120+</h3>
                    <p class="text-secondary">Kayıtlı Takım</p>
                </div>
            </div>
            <div class="col-md-3" data-aos="zoom-in" data-aos-delay="200">
                <div class="p-4">
                    <i class="fa-solid fa-gamepad fa-3x text-success mb-3"></i>
                    <h3 class="display-5 fw-bold">8</h3>
                    <p class="text-secondary">Oyun Türü</p>
                </div>
            </div>
            <div class="col-md-3" data-aos="zoom-in" data-aos-delay="300">
                <div class="p-4">
                    <i class="fa-solid fa-sack-dollar fa-3x text-info mb-3"></i>
                    <h3 class="display-5 fw-bold">₺250K+</h3>
                    <p class="text-secondary">Toplam Ödül</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    .text-gradient {
        background: linear-gradient(135deg, #a855f7, #6366f1);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }
    .py-6 {
        padding-top: 5rem !important;
        padding-bottom: 5rem !important;
    }
    .py-lg-6 {
        padding-top: 6rem !important;
        padding-bottom: 6rem !important;
    }
</style>
<?= $this->endSection() ?>