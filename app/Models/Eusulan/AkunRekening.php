<?php

namespace App\Models\Eusulan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use ScoutElastic\Searchable;

class AkunRekening extends Model
{
    use DataLogger;
    use Searchable;
    use SoftDeletes;
    protected $connection = 'eusulan';
    protected $table = 'akun_rekening';
    protected $indexConfigurator = \App\IndexConfig\EusulanAkunRekening::class;
    protected $searchRule = [
        \App\SearchRule\EusulanAkunRekening::class
    ];

    protected $mapping = [
        'properties' => [
            'kode' => [
                'type' => 'text',
                "analyzer" => "code_analyzer",
                "search_analyzer" => "code_analyzer"
            ],
            'nama' => [
                'type' => 'text',
                "analyzer" => "partial",
                "search_analyzer" => "partial"
            ]
        ]
    ];

    public function toSearchableArray()
    {
        return [
            'nama' => $this->nama,
            'kode' => $this->kode
        ];
    }

    public function creator() {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function updater() {
        return $this->hasOne('App\User', 'id', 'updated_by');
    }

    public function akun_barang() {
        return $this->hasMany('App\Models\Eusulan\AkunBarang', 'akun_rekening_id', 'id');
    }

}
