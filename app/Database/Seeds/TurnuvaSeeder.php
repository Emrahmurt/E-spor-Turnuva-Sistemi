<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TurnuvaSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();

        // --- OYUNLAR ---
        $oyunlar = [
            ['ad' => 'Valorant', 'max_oyuncu' => 5],
            ['ad' => 'League of Legends', 'max_oyuncu' => 5],
            ['ad' => 'CS2', 'max_oyuncu' => 5],
            ['ad' => 'PUBG Mobile', 'max_oyuncu' => 4],
            ['ad' => 'Rocket League', 'max_oyuncu' => 3],
            ['ad' => 'FIFA 24', 'max_oyuncu' => 1],
            ['ad' => 'Apex Legends', 'max_oyuncu' => 3],
        ];

        foreach ($oyunlar as $oyun) {
            $db->table('oyunlar')->insert([
                'ad'         => $oyun['ad'],
                'max_oyuncu' => $oyun['max_oyuncu'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        // Oyun ID'lerini al
        $oyunIds = $db->table('oyunlar')->select('id, ad')->get()->getResultArray();
        $oyunMap = [];
        foreach ($oyunIds as $o) {
            $oyunMap[$o['ad']] = $o['id'];
        }

        // --- 12 ADET TÜRKÇE TURNUVA (PROFESYONEL İSİMLER) ---
        $turnuvalar = [
            // 1-4: Valorant
            ['oyun' => 'Valorant', 'ad' => 'VALORANT Champions Tour 2026: Türkiye Açık Elemeleri', 'aciklama' => 'VCT 2026 yolunda ilk adım! Türkiye\'nin en iyi Valorant takımları, uluslararası arenaya çıkmak için karşı karşıya.', 'odul' => '100.000 TL + VCT Puanları', 'format' => 'grup_playoff', 'durum' => 'kayit_acik'],
            ['oyun' => 'Valorant', 'ad' => 'Gaming İstanbul Valorant Kupası', 'aciklama' => 'Gaming İstanbul fuarı kapsamında düzenlenen LAN turnuvası. Final maçları fuar alanında seyircili oynanacak.', 'odul' => '60.000 TL + Gaming Ekipmanları', 'format' => 'tek_eleme', 'durum' => 'yakinda'],
            ['oyun' => 'Valorant', 'ad' => 'Valorant Türkiye Ligi 2026 Sezonu', 'aciklama' => 'Türkiye\'nin en uzun soluklu Valorant ligi. 8 hafta sürecek normal sezon ve playoff karşılaşmaları.', 'odul' => '200.000 TL + VCT Ascension Bileti', 'format' => 'lig', 'durum' => 'devam_ediyor'],
            ['oyun' => 'Valorant', 'ad' => 'Red Bull Campus Clutch Türkiye Elemeleri', 'aciklama' => 'Üniversite öğrencilerine özel dünya çapında Valorant turnuvası. Kazanan takım dünya finallerinde ülkemizi temsil edecek.', 'odul' => '50.000 TL + Red Bull Özel Ödülleri', 'format' => 'tek_eleme', 'durum' => 'kayit_acik'],

            // 5-6: League of Legends
            ['oyun' => 'League of Legends', 'ad' => 'Şampiyonluk Ligi Yaz Mevsimi 2026', 'aciklama' => 'Türkiye Büyükler Ligi\'ne yükselmek isteyen takımlar için en prestijli fırsat. Yaz mevsimi boyunca sürecek lig formatında şampiyon belli olacak.', 'odul' => '250.000 TL + Yükselme Hakkı', 'format' => 'lig', 'durum' => 'kayit_acik'],
            ['oyun' => 'League of Legends', 'ad' => 'LoL Sezon Ortası Turnuvası', 'aciklama' => 'Sezon ortasında takımların formunu göstereceği özel kupa. Tüm lig takımları davetlidir.', 'odul' => '100.000 TL + RP', 'format' => 'tek_eleme', 'durum' => 'yakinda'],

            // 7-8: CS2
            ['oyun' => 'CS2', 'ad' => 'ESL Türkiye CS2 Masters 2026', 'aciklama' => 'ESL iş birliğiyle düzenlenen, Türkiye\'nin en büyük Counter-Strike 2 turnuvası. Kazanan takım uluslararası ESL Challenger\'da ülkemizi temsil edecek.', 'odul' => '150.000 TL + ESL Challenger Bileti', 'format' => 'grup_playoff', 'durum' => 'devam_ediyor'],
            ['oyun' => 'CS2', 'ad' => 'CS2 Türkiye Kupası 2026', 'aciklama' => 'Amatör ve yarı profesyonel takımlara açık, Türkiye çapında düzenlenen resmi kupa.', 'odul' => '75.000 TL', 'format' => 'tek_eleme', 'durum' => 'kayit_acik'],

            // 9-10: PUBG Mobile
            ['oyun' => 'PUBG Mobile', 'ad' => 'PUBG Mobile Türkiye Ulusal Kupası 2026', 'aciklama' => 'Mobil e-sporun zirvesi! 32 takımın katılacağı dev turnuvada şampiyon olan takım, PMGC yolunda önemli bir avantaj elde edecek.', 'odul' => '75.000 TL + PMGC Puanları', 'format' => 'grup_playoff', 'durum' => 'yakinda'],
            ['oyun' => 'PUBG Mobile', 'ad' => 'PUBG Mobile Üniversiteler Ligi', 'aciklama' => 'Üniversite öğrencilerine özel, kampüsler arası rekabet. Şampiyon takıma özel burs ve ödüller.', 'odul' => '30.000 TL + Burs', 'format' => 'lig', 'durum' => 'kayit_acik'],

            // 11: Rocket League
            ['oyun' => 'Rocket League', 'ad' => 'RLCS 2026 Türkiye Open Qualifier', 'aciklama' => 'Rocket League Championship Series yolunda ilk durak! Kazanan takım Avrupa Bölgesel Finalleri\'ne katılma hakkı kazanacak.', 'odul' => '30.000 TL + RLCS Puanları', 'format' => 'tek_eleme', 'durum' => 'kayit_acik'],

            // 12: FIFA 24
            ['oyun' => 'FIFA 24', 'ad' => 'eSüper Kupa FIFA 24 Turnuvası', 'aciklama' => 'Türkiye\'nin en iyi FIFA oyuncuları bu turnuvada buluşuyor! Tek maç eleme usulü ile şampiyon belli olacak.', 'odul' => '20.000 TL + Oyun Koltuğu', 'format' => 'tek_eleme', 'durum' => 'kayit_acik'],
        ];

        // Tarih aralıkları
        $today = time();
        foreach ($turnuvalar as $t) {
            $oyunId = $oyunMap[$t['oyun']] ?? 1;
            $baslangic = date('Y-m-d H:i:s', strtotime('+' . rand(5, 30) . ' days', $today));
            $kayitBitis = date('Y-m-d H:i:s', strtotime('-3 days', strtotime($baslangic)));
            $slug = url_title($t['ad'], '-', true);

            $db->table('turnuvalar')->insert([
                'oyun_id'          => $oyunId,
                'ad'               => $t['ad'],
                'slug'             => $slug,
                'aciklama'         => $t['aciklama'],
                'baslangic_tarihi' => $baslangic,
                'kayit_bitis'      => $kayitBitis,
                'format'           => $t['format'],
                'odul'             => $t['odul'],
                'kurallar'         => "• Resmi oyun kuralları geçerlidir.\n• Hile ve bug kullanımı yasaktır.\n• Organizasyon kararları nihaidir.",
                'durum'            => $t['durum'],
                'created_at'       => date('Y-m-d H:i:s'),
                'updated_at'       => date('Y-m-d H:i:s'),
            ]);
        }

        echo "✅ 12 adet Türkçe profesyonel turnuva başarıyla eklendi.\n";
    }
}