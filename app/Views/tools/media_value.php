<?= $this->extend('layouts/main') ?>
<?= $this->section('styles') ?>
    <!-- Ekstra stil yok, ana tema yeterli -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php /*
<div class="row mb-4">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('/') ?>">Ana Sayfa</a></li>
                <li class="breadcrumb-item active" style="color: #6366f1; font-weight: 700;">Medya Değeri Hesaplayıcı</li>
            </ol>
        </nav>
    </div>
</div>
*/ ?>
<div class="row mb-5">
    <div class="col-lg-8 mx-auto text-center">
        <h1 class="display-4 fw-bold mb-3" data-aos="fade-down">
            <i class="fa-solid fa-chart-line text-primary me-2"></i>Medya Değeri Hesaplayıcı
        </h1>
        <p class="lead text-secondary" data-aos="fade-up">
            Espor yayınınızın veya turnuvanızın potansiyel reklam değerini anında tahmin edin.
        </p>
    </div>
</div>

<div class="row g-4">
    <!-- Sol Sütun: Giriş Formu -->
    <div class="col-lg-6" data-aos="fade-right">
        <div class="card border-0 shadow-lg rounded-4 h-100">
            <div class="card-header bg-transparent border-0 pt-4 px-4">
                <h4 class="fw-bold mb-0"><i class="fa-regular fa-keyboard me-2"></i>Metrikleri Girin</h4>
                <p class="text-muted small mt-1"><span class="text-danger">*</span> Zorunlu alanlar</p>
            </div>
            <div class="card-body px-4 pb-4">
                <form id="mediaValueForm">
                    <!-- Ortalama İzleyici -->
                    <div class="mb-4">
                        <label for="avgViewers" class="form-label fw-semibold">
                            Ortalama İzleyiciler <span class="text-danger">*</span>
                            <i class="fa-regular fa-circle-question text-secondary ms-1" 
                               data-bs-toggle="tooltip" 
                               title="Yayın boyunca ortalama eş zamanlı izleyici sayısı."></i>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fa-solid fa-users"></i></span>
                            <input type="number" 
                                   class="form-control form-control-lg" 
                                   id="avgViewers" 
                                   placeholder="Örn: 5000" 
                                   value="0" 
                                   min="0" 
                                   required>
                        </div>
                    </div>

                    <!-- Yayın Süresi -->
                    <div class="mb-4">
                        <label for="airtime" class="form-label fw-semibold">
                            Yayın Süresi (dakika) <span class="text-danger">*</span>
                            <i class="fa-regular fa-circle-question text-secondary ms-1" 
                               data-bs-toggle="tooltip" 
                               title="Toplam yayın süresini dakika cinsinden girin."></i>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fa-regular fa-clock"></i></span>
                            <input type="number" 
                                   class="form-control form-control-lg" 
                                   id="airtime" 
                                   placeholder="Örn: 180" 
                                   value="0" 
                                   min="0" 
                                   required>
                        </div>
                    </div>

                    <!-- Dil Seçimi -->
                    <div class="mb-4">
                        <label for="language" class="form-label fw-semibold">
                            Dil / Bölge
                            <i class="fa-regular fa-circle-question text-secondary ms-1" 
                               data-bs-toggle="tooltip" 
                               title="Dil, CPM oranını etkiler. Varsayılan İngilizce'dir."></i>
                        </label>
                        <select class="form-select form-select-lg" id="language">
                            <option value="en" selected>İngilizce (Global) - CPM $5.00</option>
                            <option value="tr">Türkçe - CPM $2.00</option>
                            <option value="es">İspanyolca - CPM $3.50</option>
                            <option value="pt">Portekizce - CPM $3.00</option>
                        </select>
                    </div>

                    <!-- Hesapla Butonu -->
                    <div class="d-grid">
                        <button type="button" id="calculateBtn" class="btn btn-primary btn-lg">
                            <i class="fa-solid fa-calculator me-2"></i>Hesapla
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Sağ Sütun: Sonuç Kartı -->
    <div class="col-lg-6" data-aos="fade-left">
        <div class="card border-0 shadow-lg rounded-4 h-100 bg-gradient-primary text-white" style="background: linear-gradient(145deg, #1e2a5e 0%, #2c3a8c 100%);">
            <div class="card-body d-flex flex-column justify-content-center p-5">
                <p class="text-uppercase small fw-semibold opacity-75 mb-2">Tahmini Medya Değeri</p>
                <h2 class="display-3 fw-bold mb-3" id="mediaValueDisplay">$0.00</h2>
                <div class="row mt-3">
                    <div class="col-6">
                        <p class="mb-1 small opacity-75">Toplam İzlenme (Gösterim)</p>
                        <h5 class="fw-bold" id="impressionsDisplay">0</h5>
                    </div>
                    <div class="col-6">
                        <p class="mb-1 small opacity-75">İzlenen Saatler</p>
                        <h5 class="fw-bold" id="hoursWatchedDisplay">0</h5>
                    </div>
                </div>
                <hr class="opacity-25 my-4">
                <p class="small opacity-75">
                    <i class="fa-solid fa-dollar-sign me-1"></i>
                    Değer, seçilen dil için standart CPM oranı kullanılarak hesaplanmıştır.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Metodoloji Bölümü (Accordion) -->
<div class="row mt-5" data-aos="fade-up">
    <div class="col-12">
        <h3 class="h4 fw-bold mb-4"><i class="fa-solid fa-question me-2"></i>Metodoloji ve SSS</h3>
        <div class="accordion" id="methodologyAccordion">
            <div class="accordion-item border-0 shadow-sm rounded-3 mb-3">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                        Media Value hesaplama metodolojisi nasıl çalışır?
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#methodologyAccordion">
                    <div class="accordion-body text-secondary">
                        Etkinliğinizin reklam eşdeğerini tahmin etmek için CPM (Bin Gösterim Başına Maliyet) modelini kullanıyoruz. Algoritmamız izleyici metriklerini analiz eder ve kitlenin bölgesine ve diline özel sektör standartlarındaki reklam oranlarıyla karşılaştırır.
                    </div>
                </div>
            </div>
            <div class="accordion-item border-0 shadow-sm rounded-3 mb-3">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                        Maliyet hesaplamasında hangi standart kullanılıyor?
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#methodologyAccordion">
                    <div class="accordion-body text-secondary">
                        Ortaya çıkan değer, yayın süresinin %100’ü boyunca ekranın %1’ini kaplayan bir banner reklamının maliyetini yansıtır. Bu yaklaşım, gerçekçi bir marka görünürlüğü temeli sunmaya yardımcı olur.
                    </div>
                </div>
            </div>
            <div class="accordion-item border-0 shadow-sm rounded-3 mb-3">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                        Media Value nasıl hesaplanır?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#methodologyAccordion">
                    <div class="accordion-body text-secondary">
                        <p><strong>Formül:</strong></p>
                        <code>İzlenme (Gösterim) = Ortalama İzleyici × Yayın Süresi (saat) × 3600</code><br>
                        <code>Media Value = (İzlenme / 1000) × CPM</code>
                        <p class="mt-2 mb-0">Burada 3600, bir saatteki saniye sayısıdır; her saniye potansiyel bir gösterim olarak kabul edilir.</p>
                    </div>
                </div>
            </div>
            <!-- Daha fazla SSS eklenebilir -->
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tooltip'leri aktif et
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Dil bazlı CPM değerleri (USD)
        const cpmRates = {
            en: 5.00,
            tr: 2.00,
            es: 3.50,
            pt: 3.00
        };

        // DOM elementleri
        const avgViewersInput = document.getElementById('avgViewers');
        const airtimeInput = document.getElementById('airtime');
        const languageSelect = document.getElementById('language');
        const calculateBtn = document.getElementById('calculateBtn');
        const mediaValueDisplay = document.getElementById('mediaValueDisplay');
        const impressionsDisplay = document.getElementById('impressionsDisplay');
        const hoursWatchedDisplay = document.getElementById('hoursWatchedDisplay');

        // Hesaplama fonksiyonu
        function calculateMediaValue() {
            let avgViewers = parseFloat(avgViewersInput.value) || 0;
            let airtimeMin = parseFloat(airtimeInput.value) || 0;
            
            // Saate çevir
            let airtimeHours = airtimeMin / 60;
            
            // İzlenen saatler = ortalama izleyici * saat
            let hoursWatched = avgViewers * airtimeHours;
            
            // Gösterim sayısı = ortalama izleyici * saat * 3600
            let impressions = avgViewers * airtimeHours * 3600;
            
            // Seçili dilin CPM'i
            let selectedLang = languageSelect.value;
            let cpm = cpmRates[selectedLang] || 5.00;
            
            // Media Value = (gösterim / 1000) * CPM
            let mediaValue = (impressions / 1000) * cpm;
            
            // UI güncelle
            mediaValueDisplay.textContent = '$' + mediaValue.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
            
            impressionsDisplay.textContent = impressions.toLocaleString('en-US', {
                maximumFractionDigits: 0
            });
            
            hoursWatchedDisplay.textContent = hoursWatched.toLocaleString('en-US', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            });
        }

        // Butona tıklandığında hesapla
        calculateBtn.addEventListener('click', calculateMediaValue);
        
        // İlk yüklemede hesapla (varsayılan 0 değerleriyle)
        calculateMediaValue();

        // Opsiyonel: input değiştiğinde otomatik hesapla (tercihe bağlı)
        // avgViewersInput.addEventListener('input', calculateMediaValue);
        // airtimeInput.addEventListener('input', calculateMediaValue);
        // languageSelect.addEventListener('change', calculateMediaValue);
    });
</script>
<?= $this->endSection() ?>