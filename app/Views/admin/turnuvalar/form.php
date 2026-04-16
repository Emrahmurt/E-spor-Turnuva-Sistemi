<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h1 class="mb-4"><?= $title ?></h1>

<?php
// Form action: Yeni kayıt için POST /admin/turnuvalar, düzenleme için POST /admin/turnuvalar/update/ID
if (isset($turnuva) && !empty($turnuva->id)) {
    $formAction = site_url('admin/turnuvalar/update/' . $turnuva->id);
} else {
    $formAction = site_url('admin/turnuvalar');
}
?>

<form action="<?= $formAction ?>" method="post">
    <?= csrf_field() ?>

    <div class="mb-3">
        <label class="form-label">Oyun</label>
        <select name="oyun_id" class="form-select" required>
            <option value="">Oyun Seçin</option>
            <?php foreach ($oyunlar as $o): ?>
                <?php $selected = old('oyun_id', $turnuva->oyun_id ?? '') == $o->id ? 'selected' : ''; ?>
                <option value="<?= $o->id ?>" <?= $selected ?>><?= esc($o->getAd()) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Turnuva Adı</label>
        <input type="text" name="ad" class="form-control" value="<?= old('ad', $turnuva->ad ?? '') ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Açıklama</label>
        <textarea name="aciklama" class="form-control" rows="3"><?= old('aciklama', $turnuva->aciklama ?? '') ?></textarea>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Başlangıç Tarihi</label>
            <input type="datetime-local" name="baslangic_tarihi" class="form-control" value="<?= old('baslangic_tarihi', isset($turnuva) ? date('Y-m-d\TH:i', strtotime($turnuva->baslangic_tarihi)) : '') ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Kayıt Bitiş</label>
            <input type="datetime-local" name="kayit_bitis" class="form-control" value="<?= old('kayit_bitis', isset($turnuva) ? date('Y-m-d\TH:i', strtotime($turnuva->kayit_bitis)) : '') ?>">
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Format</label>
        <select name="format" class="form-select">
            <option value="tek_eleme" <?= old('format', $turnuva->format ?? '') == 'tek_eleme' ? 'selected' : '' ?>>Tek Eleme</option>
            <option value="lig" <?= old('format', $turnuva->format ?? '') == 'lig' ? 'selected' : '' ?>>Lig</option>
            <option value="grup_playoff" <?= old('format', $turnuva->format ?? '') == 'grup_playoff' ? 'selected' : '' ?>>Grup + Playoff</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Ödül</label>
        <input type="text" name="odul" class="form-control" value="<?= old('odul', $turnuva->odul ?? '') ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Kurallar</label>
        <textarea name="kurallar" class="form-control" rows="3"><?= old('kurallar', $turnuva->kurallar ?? '') ?></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Durum</label>
        <select name="durum" class="form-select">
            <option value="yakinda" <?= old('durum', $turnuva->durum ?? '') == 'yakinda' ? 'selected' : '' ?>>Yakında</option>
            <option value="kayit_acik" <?= old('durum', $turnuva->durum ?? '') == 'kayit_acik' ? 'selected' : '' ?>>Kayıt Açık</option>
            <option value="devam_ediyor" <?= old('durum', $turnuva->durum ?? '') == 'devam_ediyor' ? 'selected' : '' ?>>Devam Ediyor</option>
            <option value="tamamlandi" <?= old('durum', $turnuva->durum ?? '') == 'tamamlandi' ? 'selected' : '' ?>>Tamamlandı</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success rounded-pill px-4">Kaydet</button>
    <a href="<?= site_url('admin/turnuvalar') ?>" class="btn btn-secondary rounded-pill px-4">İptal</a>
</form>

<?= $this->endSection() ?>