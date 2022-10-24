<?php

namespace App\Models\Harmat;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes; // <-- This is required

class PerbaikanAlat extends Model
{
	use DataLogger;
    use SoftDeletes;

    protected $table = 'perbaikan_alat';
    protected $connection = 'harmat';

    protected $fillable = [
        'nama_alat',
        'asal_ruangan',
        'alasan',
        'status',
        'tgl_laporan',
        'tgl_identifikasi',
        'tgl_mulai',
        'tgl_selesai',

        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function user() {
        return $this->belongsTo('App\User','users_id');
    }
}
