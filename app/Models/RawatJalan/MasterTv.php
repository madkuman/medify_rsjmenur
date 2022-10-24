<?php

namespace App\Models\RawatJalan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterTv extends Model
{
	use DataLogger;
    use SoftDeletes;
	protected $connection = 'rawatjalan';
	protected $table = 'master_tv';
    protected $dates = ['deleted_at'];
    protected $appends = ['level_nama', 'ruangan_nama'];

    public function getLevelNamaAttribute()
    {
        $nama = [];
        $levels = json_decode($this->antrian_level);
        foreach ($levels as $value) {
            $antrian_level = AntrianLevel::find($value);
            array_push($nama, $antrian_level->nama);
        }
        if (empty($nama)) $nama[] = null;
        return json_encode($nama);
    }

    public function getRuanganNamaAttribute()
    {
        $nama = [];
        $ruangans = json_decode($this->ruangan);
        foreach ($ruangans as $value) {
            $ruangan = Ruangan::find($value);
            if (empty($ruangan)) $names = '';
            else $names = $ruangan->nama;
            array_push($nama, $names);
        }
        if (empty($nama)) $nama[] = null;
        return json_encode($nama);
    }

    // public function getPoliNamaAttribute()
    // {
    //     $nama = [];
    //     $polis = json_decode($this->poliklinik);
    //     foreach ($polis as $value) {
    //         $poli = Poliklinik::find($value);
    //         array_push($nama, $poli->name);
    //     }
    //     if (empty($nama)) $nama[] = null;
    //     return json_encode($nama);
    // }
}
