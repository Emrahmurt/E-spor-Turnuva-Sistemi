<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h1 class="mb-4"><?= $title ?></h1>

<?php
// Yeni kayıt mı yoksa düzenleme mi?
if (isset($takim) && !empty($takim->id)) {
    $formAction = site_url('admin/takimlar/update/' . $takim->id);
} else {
    $formAction = site_url('admin/takimlar');
}
?>

<form action="<?= $formAction ?>" method="post">
    <?= csrf_field() ?>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Takım Adı</label>
            <input type="text" name="ad" class="form-control" value="<?= old('ad', $takim->ad ?? '') ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Kısa Ad (Opsiyonel)</label>
            <input type="text" name="kisa_ad" class="form-control" value="<?= old('kisa_ad', $takim->kisa_ad ?? '') ?>" maxlength="10">
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Turnuva</label>
        <select name="turnuva_id" class="form-select" required>
            <option value="">Turnuva Seçin</option>
            <?php foreach ($turnuvalar as $turnuva): ?>
                <?php $selected = old('turnuva_id', $takim->turnuva_id ?? '') == $turnuva->id ? 'selected' : ''; ?>
                <option value="<?= $turnuva->id ?>" <?= $selected ?>><?= esc($turnuva->getAd()) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Kaptan ID (Kullanıcı)</label>
        <input type="number" name="kaptan_id" class="form-control" value="<?= old('kaptan_id', $takim->kaptan_id ?? '') ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Logo URL</label>
        <input type="text" name="logo" class="form-control" value="<?= old('logo', $takim->logo ?? '') ?>" placeholder="https://...">
    </div>

    <button type="submit" class="btn btn-success rounded-pill px-4">Kaydet</button>
    <a href="<?= site_url('admin/takimlar') ?>" class="btn btn-secondary rounded-pill px-4">İptal</a>
</form>

<?= $this->endSection() ?>