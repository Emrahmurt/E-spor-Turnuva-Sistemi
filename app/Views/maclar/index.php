<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- Sayfa Başlığı -->
<div class="row mb-4">
    <div class="col-lg-8 mx-auto text-center">
        <h1 class="display-4 fw-bold mb-3" data-aos="fade-down">
            <i class="fa-solid fa-futbol text-gradient me-2"></i>Maçlar
        </h1>
        <p class="lead text-secondary mb-4" data-aos="fade-up" data-aos-delay="100">
            Güncel maç programı ve sonuçları takip edin.
        </p>
    </div>
</div>

<!-- Filtre / Arama Çubuğu - daha yukarıda -->
<div class="row mb-5" data-aos="fade-up">
    <div class="col-md-8 col-lg-6 mx-auto">
        <div class="input-group shadow-sm">
            <span class="input-group-text bg-dark border-secondary text-white">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <input type="text" class="form-control bg-dark border-secondary text-white py-2" 
                   placeholder="Turnuva veya takım ara...">
            <button class="btn btn-primary px-4" type="button">
                <i class="fa-solid fa-filter me-1"></i>Filtrele
            </button>
        </div>
    </div>
</div>

<!-- Maç Kartları Grid -->
<div class="row g-4">
    <?php if (!empty($maclar)): ?>
        <?php $index = 0; ?>
        <?php foreach ($maclar as $m): ?>
            <?php
                $turnuva = $m->turnuva_adi ?? 'Bilinmeyen Turnuva';
                $takim1  = $m->takim1_adi ?? 'TBD';
                $takim2  = $m->takim2_adi ?? 'TBD';
                $skor1   = $m->skor1;
                $skor2   = $m->skor2;
                $tarih   = $m->tarih ? date('d M Y - H:i', strtotime($m->tarih)) : 'Tarih belirsiz';
                $tur     = $m->tur ?: 'Grup';
                $durum   = $m->durum ?? 'planlandi';
                
                $durumBadge = [
                    'planlandi'  => 'bg-info',
                    'oynaniyor'  => 'bg-warning text-dark',
                    'tamamlandi' => 'bg-success',
                ];
                $badgeClass = $durumBadge[$durum] ?? 'bg-secondary';
                $skorGoster = ($skor1 !== null && $skor2 !== null) ? "{$skor1} - {$skor2}" : 'VS';
            ?>
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="<?= 50 * ($index % 6) ?>">
                <div class="card h-100 border-0 shadow-lg rounded-4 overflow-hidden bg-dark text-white match-card">
                    <!-- Turnuva Başlığı -->
                    <div class="card-header bg-primary bg-opacity-10 border-0 py-3 px-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-semibold text-white">
                                <i class="fa-solid fa-trophy me-2 text-warning"></i><?= esc($turnuva) ?>
                            </span>
                            <span class="badge <?= $badgeClass ?> rounded-pill px-3 py-2">
                                <?= esc($durum) ?>
                            </span>
                        </div>
                    </div>
                    
                    <!-- Maç Detayı -->
                    <div class="card-body p-4 text-center">
                        <!-- Takımlar ve Skor -->
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="text-center team-col">
                                <div class="team-icon mb-2">
                                    <i class="fa-solid fa-shield-halved fa-2x text-primary"></i>
                                </div>
                                <h5 class="fw-bold mb-0 team-name"><?= esc($takim1) ?></h5>
                            </div>
                            
                            <div class="text-center score-col">
                                <span class="display-6 fw-bold text-gradient">
                                    <?= $skorGoster ?>
                                </span>
                            </div>
                            
                            <div class="text-center team-col">
                                <div class="team-icon mb-2">
                                    <i class="fa-solid fa-shield-halved fa-2x text-danger"></i>
                                </div>
                                <h5 class="fw-bold mb-0 team-name"><?= esc($takim2) ?></h5>
                            </div>
                        </div>
                        
                        <!-- Maç Bilgileri -->
                        <hr class="my-4 border-secondary opacity-25">
                        <div class="d-flex justify-content-around text-secondary small">
                            <div class="d-flex align-items-center">
                                <i class="fa-regular fa-calendar me-2"></i>
                                <span><?= $tarih ?></span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fa-regular fa-flag me-2"></i>
                                <span><?= esc($tur) ?></span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Kart Alt Butonu -->
                    <div class="card-footer bg-transparent border-0 pb-4 px-4 d-flex justify-content-center">
                        <a href="#" class="btn btn-outline-primary rounded-pill w-100 py-2">
                            <i class="fa-regular fa-eye me-2"></i>Maç Detayı
                        </a>
                    </div>
                </div>
            </div>
            <?php $index++; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12">
            <div class="text-center py-6" data-aos="zoom-in">
                <i class="fa-solid fa-futbol fa-4x text-secondary mb-4 opacity-50"></i>
                <h3 class="fw-bold">Henüz Maç Bulunmuyor</h3>
                <p class="text-secondary">Yeni maçlar eklendiğinde burada listelenecek.</p>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Sayfalama -->
<?php if (!empty($pager)): ?>
    <div class="d-flex justify-content-center mt-5">
        <?= $pager->links('default', 'bootstrap') ?>
    </div>
<?php endif; ?>

<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    .text-gradient {
        background: linear-gradient(135deg, #a855f7, #6366f1);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }
    .match-card {
        transition: all 0.3s ease;
        background-color: #1a1a2e !important;
        border: 1px solid rgba(255, 255, 255, 0.05);
    }
    .match-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 25px 35px -10px rgba(0, 0, 0, 0.5) !important;
        border-color: rgba(99, 102, 241, 0.3);
    }
    .team-col {
        width: 40%;
    }
    .score-col {
        width: 20%;
    }
    .team-name {
        font-size: 1.1rem;
        line-height: 1.3;
        word-break: break-word;
    }
    .team-icon {
        opacity: 0.9;
    }
    .py-6 {
        padding-top: 4rem !important;
        padding-bottom: 4rem !important;
    }
    .badge {
        font-weight: 500;
        letter-spacing: 0.3px;
    }
    .card-header {
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }
    .btn-outline-primary {
        border-color: #6366f1;
        color: #a5b4fc;
    }
    .btn-outline-primary:hover {
        background-color: #6366f1;
        border-color: #6366f1;
        color: white;
    }
    .input-group-text, .form-control {
        border-right: none;
    }
    .form-control:focus {
        box-shadow: none;
        border-color: #6366f1;
    }
    .btn-primary {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border: none;
    }
</style>
<?= $this->endSection() ?>