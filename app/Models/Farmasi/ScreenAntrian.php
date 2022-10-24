<?php

namespace App\Models\Farmasi;

use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScreenAntrian extends Model
{
    use DataLogger;
    protected $connection = 'farmasi';
    protected $table = 'screen_antrian';
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $appends = ['jenis_antrian_nama', 'jenis_resep_nama'];

    public function getJenisAntrianNamaAttribute()
    {
        $nama = [];
        $jenis_antrians = json_decode($this->jenis_antrian);
        foreach ($jenis_antrians as $value) {
            $jenis_antrian = JenisAntrian::find($value);
            array_push($nama, $jenis_antrian->nama);
        }
        if (empty($nama)) $nama[] = null;
        return json_encode($nama);
    }

    public function getJenisResepNamaAttribute()
    {
        $nama = [];
        $jenis_reseps = json_decode($this->jenis_resep);
        foreach ($jenis_reseps as $value) {
            $jenis_resep = WaktuEstimasiJenisResep::find($value);
            array_push($nama, $jenis_resep->jenis_resep);
        }
        if (empty($nama)) $nama[] = null;
        return json_encode($nama);
    }
}
