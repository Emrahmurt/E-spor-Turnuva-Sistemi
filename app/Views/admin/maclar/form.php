<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h1 class="mb-4"><?= $title ?></h1>

<?php
$formAction = isset($mac) && $mac->id
    ? site_url('admin/maclar/update/' . $mac->id)
    : site_url('admin/maclar');
?>

<form action="<?= $formAction ?>" method="post">
    <?= csrf_field() ?>

    <div class="mb-3">
        <label class="form-label">Turnuva</label>
        <select name="turnuva_id" class="form-select" required>
            <option value="">Seçiniz</option>
            <?php foreach ($turnuvalar as $t): ?>
                <option value="<?= $t->id ?>" <?= old('turnuva_id', $mac->turnuva_id ?? '') == $t->id ? 'selected' : '' ?>>
                    <?= esc($t->getAd()) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Takım 1</label>
            <select name="takim1_id" class="form-select" required>
                <option value="">Seçiniz</option>
                <?php foreach ($takimlar as $t): ?>
                    <option value="<?= $t->id ?>" <?= old('takim1_id', $mac->takim1_id ?? '') == $t->id ? 'selected' : '' ?>>
                        <?= esc($t->getAd()) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Takım 2</label>
            <select name="takim2_id" class="form-select" required>
                <option value="">Seçiniz</option>
                <?php foreach ($takimlar as $t): ?>
                    <option value="<?= $t->id ?>" <?= old('takim2_id', $mac->takim2_id ?? '') == $t->id ? 'selected' : '' ?>>
                        <?= esc($t->getAd()) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-3">
            <label class="form-label">Skor 1</label>
            <input type="number" name="skor1" class="form-control" value="<?= old('skor1', $mac->skor1 ?? '') ?>" min="0">
        </div>
        <div class="col-md-4 mb-3">
            <label class="form-label">Skor 2</label>
            <input type="number" name="skor2" class="form-control" value="<?= old('skor2', $mac->skor2 ?? '') ?>" min="0">
        </div>
        <div class="col-md-4 mb-3">
            <label class="form-label">Tarih</label>
            <input type="datetime-local" name="tarih" class="form-control" value="<?= old('tarih', isset($mac) ? date('Y-m-d\TH:i', strtotime($mac->tarih)) : '') ?>">
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Tur</label>
            <input type="text" name="tur" class="form-control" value="<?= old('tur', $mac->tur ?? '') ?>" placeholder="Grup A, Çeyrek Final...">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Durum</label>
            <select name="durum" class="form-select">
                <option value="planlandi" <?= old('durum', $mac->durum ?? '') == 'planlandi' ? 'selected' : '' ?>>Planlandı</option>
                <option value="oynaniyor" <?= old('durum', $mac->durum ?? '') == 'oynaniyor' ? 'selected' : '' ?>>Oynanıyor</option>
                <option value="tamamlandi" <?= old('durum', $mac->durum ?? '') == 'tamamlandi' ? 'selected' : '' ?>>Tamamlandı</option>
            </select>
        </div>
    </div>

    <button type="submit" class="btn btn-success rounded-pill px-4">Kaydet</button>
    <a href="<?= site_url('admin/maclar') ?>" class="btn btn-secondary rounded-pill px-4">İptal</a>
</form>

<?= $this->endSection() ?>