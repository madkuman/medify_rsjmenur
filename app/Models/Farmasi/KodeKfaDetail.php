<?php

namespace App\Models\Farmasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KodeKfaDetail extends Model
{
    use SoftDeletes;

    // Tentukan koneksi yang digunakan
    protected $connection = 'farmasi';

    // Tentukan nama tabel
    protected $table = 'kode_kfa_detail';

    // Kolom yang dapat diisi
    protected $fillable = [
        'kode_kfa',
        'name',
        'active',
        'ucum',
        'uom',
        'nie',
        'manufacturer',
        'generik',
        'fix_price',
        'het_price',
        'nama_dagang',
        'kode_kfa_92',
        'value'
    ];

    // Kolom yang akan disimpan sebagai JSON
    protected $casts = [
        'value' => 'array',
    ];
}
