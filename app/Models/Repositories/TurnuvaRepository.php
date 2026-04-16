<?php

namespace App\Models\Repositories;

use App\Models\Entities\TurnuvaEntity;
use CodeIgniter\Model;

class TurnuvaRepository extends Model
{
    protected $table         = 'turnuvalar';
    protected $primaryKey    = 'id';
    protected $useAutoIncrement = true;
    protected $returnType    = TurnuvaEntity::class;
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'oyun_id', 'ad', 'slug', 'aciklama', 'baslangic_tarihi', 'kayit_bitis',
        'format', 'odul', 'kurallar', 'durum'
    ];
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';

    // Cache ayarları
    protected $cachePrefix = 'turnuva_';
    protected $cacheTTL    = 3600;

    /**
     * Slug'a göre turnuva getir (cache'li)
     */
    public function findBySlug(string $slug): ?TurnuvaEntity
    {
        $cacheKey = $this->cachePrefix . 'slug_' . $slug;
        return cache()->remember($cacheKey, $this->cacheTTL, function () use ($slug) {
            return $this->where('slug', $slug)->first();
        });
    }

    /**
     * Aktif turnuvaları listele (sayfalı)
     */
    public function paginateActive(int $perPage = 12, int $page = 1): array
    {
        $cacheKey = $this->cachePrefix . "active_page_{$page}_per_{$perPage}";
        return cache()->remember($cacheKey, $this->cacheTTL / 2, function () use ($perPage) {
            return $this->whereIn('durum', ['kayit_acik', 'devam_ediyor', 'yakinda'])
                        ->orderBy('baslangic_tarihi', 'ASC')
                        ->paginate($perPage);
        });
    }

    public function clearCache(): void
    {
        cache()->clean();
    }
}