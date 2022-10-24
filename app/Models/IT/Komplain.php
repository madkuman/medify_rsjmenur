<?php

namespace App\Models\IT;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Komplain extends Model
{
	use DataLogger;
    use SoftDeletes;

    protected $table = 'komplain';
    protected $connection = 'it';

    protected $fillable = [
        'tgl_komplain',
        'jam_komplain',
        'jam_respon',
        'lokasi',
        'jenis_komplain_id',
        'catatan',
        'respon',
        'teknisi',
        'pesan',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    protected $dates = [
        'waktu_respon',
        'waktu_komplain'
    ];

    public function user() {
        return $this->belongsTo('App\User','users_id');
    }

    public function teknisinya() {
        return $this->belongsTo('App\User','teknisi');
    }

    public function creator() {
        return $this->belongsTo('App\User','created_by');
    }

    public function jenisKomplain() {
        return $this->belongsTo('App\Models\IT\JenisKomplain','jenis_komplain_id');
    }
}
