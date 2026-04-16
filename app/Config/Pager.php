<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Pager extends BaseConfig
{
    /**
     * Sayfa başına varsayılan öğe sayısı
     */
    public int $perPage = 12;

    /**
     * Sayfalama şablonları
     */
    public array $templates = [
        'default_full'   => 'CodeIgniter\Pager\Views\default_full',
        'default_simple' => 'CodeIgniter\Pager\Views\default_simple',
        'bootstrap'      => 'App\Views\Pager\bootstrap_pagination',
    ];
}