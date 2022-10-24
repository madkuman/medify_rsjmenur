<?php

namespace App\Models\Gizi;

use App\Models\RawatInap\Bangsal;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnggaranMakanan extends Model
{
    use DataLogger;
    use SoftDeletes;
    protected $connection = 'gizi';
    protected $table = 'anggaran_makanan';

    public function getJenisMakananNamaAttribute()
    {
        $nama = [];
        $jenis_makanan = json_decode($this->jenis_makanan_ids);
        foreach ($jenis_makanan as $value) {
            $jenis_makanan_nama = JenisMakanan::find($value)->nama ?? '';
            array_push($nama, $jenis_makanan_nama);
        }
        if (empty($nama)) $nama[] = null;
        return json_encode($nama);
    }

    public function getKelasNamaAttribute()
    {
        $nama = [];
        $kelas = json_decode($this->kelas_ids);
        foreach ($kelas as $value) {
            $kelas_nama = \App\Models\Hospital\Kelas::find($value)->nama ?? '';
            array_push($nama, $kelas_nama);
        }
        if (empty($nama)) $nama[] = null;
        return json_encode($nama);
    }

    public function getBangsalNamaAttribute()
    {
        $nama = [];
        $bangsal = json_decode($this->bangsal_ids);
        foreach ($bangsal as $value) {
            $bangsal_nama = Bangsal::find($value)->nama ?? '';
            array_push($nama, $bangsal_nama);
        }
        if (empty($nama)) $nama[] = null;
        return json_encode($nama);
    }

    public function detail()
    {
        return $this->hasMany('App\Models\Gizi\AnggaranMakananDetail', 'anggaran_makanan_id', 'id');
    }

    public function creator()
    {
        return $this->hasOne('App\User','id','created_by');
    }

    public function anggaran_makanan_tahun($tahun)
    {
        return $this->hasOne('App\Models\Gizi\AnggaranMakananDetail', 'anggaran_makanan_id', 'id')->where('tahun',$tahun);
    }

}
