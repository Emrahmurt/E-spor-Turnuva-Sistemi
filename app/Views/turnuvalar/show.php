<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<?php
// Güvenli string çıktı fonksiyonu
function safeString($value, $default = ''): string
{
    if (is_string($value) || is_numeric($value)) {
        return (string) $value;
    }
    if (is_array($value)) {
        $flat = [];
        array_walk_recursive($value, function ($item) use (&$flat) {
            if (is_scalar($item)) {
                $flat[] = (string) $item;
            }
        });
        return implode(' ', $flat);
    }
    if (is_object($value)) {
        if (method_exists($value, '__toString')) {
            return (string) $value;
        }
        if (method_exists($value, 'getAd')) {
            return $value->getAd();
        }
        if (isset($value->ad)) {
            return safeString($value->ad);
        }
    }
    return $default;
}
?>
<?php
// Güvenlik: $turnuva tanımlı değilse veya boşsa hata sayfası göster
if (!isset($turnuva) || empty($turnuva)): ?>
    <div class="alert alert-warning text-center py-5">
        <i class="fa-solid fa-trophy fa-3x mb-3"></i>
        <h3>Turnuva bulunamadı</h3>
        <p>Aradığınız turnuva mevcut değil veya kaldırılmış.</p>
        <a href="<?= site_url('turnuvalar') ?>" class="btn btn-primary mt-3">Tüm Turnuvalara Dön</a>
    </div>
<?php else: ?>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= site_url('turnuvalar') ?>">Turnuvalar</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= esc(safeString($turnuva->getAd() ?? ($takim['ad'] ?? ''))) ?></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-body">
                    <h1 class="h2 mb-3"><?= esc(safeString($turnuva->getAd() ?? ($takim['ad'] ?? ''))) ?></h1>
                    <div class="d-flex gap-3 mb-3 flex-wrap">
                        <?= $turnuva->getDurumBadge() ?>
                        <span class="badge bg-light text-dark">
                            <i class="fa-solid fa-gamepad"></i><?= esc(safeString($turnuva->getAd() ?? ($takim['ad'] ?? ''))) ?>
                        </span>
                        <span class="badge bg-light text-dark">
                            <i class="fa-regular fa-flag"></i> 
                            <?= esc(ucfirst(str_replace('_', ' ', $turnuva->format ?? 'Tek Eleme'))) ?>
                        </span>
                    </div>

                    <p><?= esc(safeString($turnuva->getAciklama() ?? ($takim['ad'] ?? ''))) ?></p>

                    <h5 class="mt-4">Ödüller</h5>
                    <p><?= esc(safeString($turnuva->getOdul() ?? ($takim['ad'] ?? ''))) ?></p>

                    <h5>Kurallar</h5>
                    <p><?= esc(safeString($turnuva->getKurallar() ?? ($takim['ad'] ?? ''))) ?></p>
                </div>
            </div>

            <!-- Maçlar ve Fikstür -->
            <div class="card">
                <div class="card-header fw-bold">Maçlar & Fikstür</div>
                <div class="card-body">
                   <?php if (!empty($maclar)): ?>
    <?php foreach ($maclar as $turAdi => $macListesi): ?>
        <h6 class="mt-3"><?= esc(is_scalar($turAdi) ? $turAdi : (is_array($turAdi) ? implode(' ', $turAdi) : 'Grup')) ?></h6>
        <div class="table-responsive">
            <table class="table table-sm table-hover">
                <tbody>
                    <?php foreach ($macListesi as $mac): ?>
                        <?php
                            // Takım 1 adını güvenle al
                            $takim1Adi = 'TBD';
                            if (isset($mac->takim1)) {
                                if (is_object($mac->takim1)) {
                                    $takim1Adi = method_exists($mac->takim1, 'getAd') ? $mac->takim1->getAd() : ($mac->takim1->ad ?? 'TBD');
                                } elseif (is_array($mac->takim1)) {
                                    $takim1Adi = $mac->takim1['ad'] ?? 'TBD';
                                }
                            } elseif (isset($mac->takim1_id)) {
                                $takim1Adi = 'Takım #' . $mac->takim1_id;
                            }

                            // Takım 2 adını güvenle al
                            $takim2Adi = 'TBD';
                            if (isset($mac->takim2)) {
                                if (is_object($mac->takim2)) {
                                    $takim2Adi = method_exists($mac->takim2, 'getAd') ? $mac->takim2->getAd() : ($mac->takim2->ad ?? 'TBD');
                                } elseif (is_array($mac->takim2)) {
                                    $takim2Adi = $mac->takim2['ad'] ?? 'TBD';
                                }
                            } elseif (isset($mac->takim2_id)) {
                                $takim2Adi = 'Takım #' . $mac->takim2_id;
                            }

                            // Skor gösterimi
                            $skor = '- : -';
                            if (isset($mac->skor1) && isset($mac->skor2)) {
                                $skor = $mac->skor1 . ' - ' . $mac->skor2;
                            }
                        ?>
                        <tr>
                            <td><?= $mac->tarih ? date('d M H:i', strtotime($mac->tarih)) : 'Tarih belli değil' ?></td>
                            <td class="text-end"><?= esc($turnuva) ?></td>
                            <td class="text-center fw-bold"><?= esc($skor) ?></td>
                            <td><?= esc($turnuva) ?></td>
                           <td><span class="badge bg-secondary"><?= is_string($mac->durum) ? esc($mac->durum) : 'planlandi' ?></span></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p class="text-muted">Henüz maç programı açıklanmadı.</p>
<?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header fw-bold">Turnuva Bilgileri</div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fa-regular fa-calendar me-2"></i> Başlangıç: 
                            <strong><?= $turnuva->baslangic_tarihi ? date('d M Y', strtotime($turnuva->baslangic_tarihi)) : '-' ?></strong>
                        </li>
                        <li class="mb-2">
                            <i class="fa-regular fa-hourglass-half me-2"></i> Kayıt Bitiş: 
                            <strong><?= $turnuva->kayit_bitis ? date('d M Y', strtotime($turnuva->kayit_bitis)) : '-' ?></strong>
                        </li>
                        <li class="mb-2">
                            <i class="fa-solid fa-users me-2"></i> Katılımcı Sayısı: 
                            <strong><?= isset($takimlar) ? count($takimlar) : 0 ?></strong>
                        </li>
                    </ul>
                    <?php if ($turnuva->isKayitAcik()): ?>
                        <a href="#" class="btn btn-success w-100"><i class="fa-regular fa-pen-to-square"></i> Turnuvaya Kaydol</a>
                    <?php else: ?>
                        <button class="btn btn-secondary w-100" disabled>Kayıtlar Kapalı</button>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card">
                <div class="card-header fw-bold">Katılımcı Takımlar</div>
                <div class="card-body">
                    <?php if (!empty($logo)): ?>
                        <div class="list-group list-group-flush">
                            <?php foreach ($logo as $takim): ?>
                                <div class="list-group-item d-flex align-items-center">
                                    <?php if (!empty($takim->logo)): ?>
                                        <img src="<?= esc($logo) ?>" alt="logo" class="rounded-circle me-2" width="30" height="30">
                                    <?php endif; ?>
                                    
                                    <span>
                                        <?= esc(safeString($takim->getAd() ?? ($takim['ad'] ?? ''))) ?>
                                        <?= esc(safeString($takim->getKisaAd() ?? ($takim['ad'] ?? ''))) ?>
                                    </span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-muted">Henüz katılımcı takım yok.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Paylaşım -->
    <hr class="my-5">
    <div class="d-flex justify-content-between">
        <div>
            <span class="fw-semibold me-3">Paylaş:</span>
            <a href="https://twitter.com/intent/tweet?url=<?= urlencode(current_url()) ?>&text=<?= urlencode($turnuva->getAd()) ?>" 
               target="_blank" class="btn btn-outline-secondary btn-sm rounded-circle me-2">
                <i class="fa-brands fa-x-twitter"></i>
            </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(current_url()) ?>" 
               target="_blank" class="btn btn-outline-secondary btn-sm rounded-circle me-2">
                <i class="fa-brands fa-facebook-f"></i>
            </a>
            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= urlencode(current_url()) ?>&title=<?= urlencode($turnuva->getAd()) ?>" 
               target="_blank" class="btn btn-outline-secondary btn-sm rounded-circle">
                <i class="fa-brands fa-linkedin-in"></i>
            </a>
        </div>
    </div>

<?php endif; ?>

<?= $this->endSection() ?>