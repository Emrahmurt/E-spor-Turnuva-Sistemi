<?= $this->extend('layouts/main') ?>
<?= $this->section('styles') ?>
    <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card border-0 shadow-lg rounded-4 p-4 p-md-5">
            <h1 class="h3 fw-bold mb-4"><i class="fa-regular fa-pen-to-square me-2 text-primary"></i><?= isset($post) ? 'Yazıyı Düzenle' : 'Yeni Yazı Oluştur' ?></h1>

            <?= form_open(current_url(), ['class' => 'needs-validation', 'novalidate' => '']) ?>
                <?= csrf_field() ?>
                
                <div class="mb-4">
                    <label for="title" class="form-label fw-semibold">Başlık *</label>
                    <input type="text" class="form-control form-control-lg" id="title" name="title" 
                           value="<?= old('title', $post->title ?? '') ?>" required minlength="3" maxlength="255">
                    <div class="invalid-feedback">Lütfen geçerli bir başlık girin (en az 3 karakter).</div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="status" class="form-label fw-semibold">Durum</label>
                        <select class="form-select" id="status" name="status">
                            <option value="draft" <?= old('status', $post->status ?? 'draft') === 'draft' ? 'selected' : '' ?>>Taslak</option>
                            <option value="published" <?= old('status', $post->status ?? '') === 'published' ? 'selected' : '' ?>>Yayınla</option>
                            <option value="archived" <?= old('status', $post->status ?? '') === 'archived' ? 'selected' : '' ?>>Arşiv</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="published_at" class="form-label fw-semibold">Yayın Tarihi</label>
                        <input type="datetime-local" class="form-control" id="published_at" name="published_at" 
                               value="<?= old('published_at', isset($post) && $post->published_at ? date('Y-m-d\TH:i', strtotime($post->published_at)) : date('Y-m-d\TH:i')) ?>">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="excerpt" class="form-label fw-semibold">Özet</label>
                    <textarea class="form-control" id="excerpt" name="excerpt" rows="2" maxlength="500"><?= old('excerpt', $post->excerpt ?? '') ?></textarea>
                    <div class="form-text">Opsiyonel, en fazla 500 karakter.</div>
                </div>

                <div class="mb-4">
                    <label for="featured_image" class="form-label fw-semibold">Öne Çıkan Görsel URL</label>
                    <input type="url" class="form-control" id="featured_image" name="featured_image" 
                           value="<?= old('featured_image', $post->featured_image ?? '') ?>" placeholder="https://...">
                </div>

                <div class="mb-4">
                    <label for="content" class="form-label fw-semibold">İçerik *</label>
                    <textarea class="form-control" id="content" name="content" rows="15" required minlength="10"><?= old('content', $post->content ?? '') ?></textarea>
                    <div class="invalid-feedback">İçerik en az 10 karakter olmalıdır.</div>
                </div>

                <hr class="my-4">

                <!-- SEO Alanları (opsiyonel accordion) -->
                <div class="accordion mb-4" id="seoAccordion">
                    <div class="accordion-item border-0">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-light rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSEO">
                                <i class="fa-solid fa-magnifying-glass me-2"></i> SEO Ayarları (Gelişmiş)
                            </button>
                        </h2>
                        <div id="collapseSEO" class="accordion-collapse collapse" data-bs-parent="#seoAccordion">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <label for="meta_title" class="form-label">Meta Başlık</label>
                                    <input type="text" class="form-control" id="meta_title" name="meta_title" value="<?= old('meta_title', $post->meta_title ?? '') ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="meta_description" class="form-label">Meta Açıklama</label>
                                    <textarea class="form-control" id="meta_description" name="meta_description" rows="2"><?= old('meta_description', $post->meta_description ?? '') ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3">
                    <a href="<?= site_url('blog') ?>" class="btn btn-light btn-lg px-4">İptal</a>
                    <button type="submit" class="btn btn-primary btn-lg px-5"><?= isset($post) ? 'Güncelle' : 'Yayınla' ?></button>
                </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // TinyMCE başlat
    tinymce.init({
        selector: '#content',
        height: 500,
        menubar: true,
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        language: 'tr',
        content_style: 'body { font-family:Inter, sans-serif; font-size:16px }',
        image_title: true,
        automatic_uploads: true,
        file_picker_types: 'image',
        images_upload_url: '<?= site_url('admin/upload-image') ?>', // Opsiyonel
        relative_urls: false,
        remove_script_host: false,
    });

    // Bootstrap validation
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
<?= $this->endSection() ?>