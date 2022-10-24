<?php

namespace App\Models\Gizi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class PemesananDetail extends Model
{
	use DataLogger;
   use SoftDeletes;
   protected $connection = 'gizi';
   protected $table = 'pemesanan_detail';

    public function waktu_makan()
    {
        return $this->hasOne('App\Models\Gizi\WaktuMakan','id','waktu_makan_id');
    }

    public function resep()
    {
        return $this->hasOne('App\Models\Gizi\Resep','id','resep_id');
    }

    public function pemesanan()
    {
        return $this->hasOne('App\Models\Gizi\Pemesanan','id','pemesanan_id');
    }

    public function pengantar()
    {
        return $this->hasOne('App\User','id','delivered_by');
    }
    public function lokasi()
    {
        return $this->hasOne('App\Models\Hospital\Lokasi','id','lokasi_id');
    }

    public function bangsal()
    {
        return $this->hasOne('App\Models\RawatInap\Bangsal','id','bangsal_id');
    }

    public function ruangan()
    {
        return $this->hasOne('App\Models\RawatInap\Ruangan','id','ruangan_id');
    }

    public function diet()
    {
        return $this->hasOne('App\Models\Gizi\Diet','id','diet_id')->withTrashed();
    }

    public function kode_diet()
    {
        return $this->hasOne('App\Models\Gizi\DietKode','id','kode_diet_id');
    }
    public function bentuk_makanan()
    {
        return $this->hasOne('App\Models\Gizi\BentukMakanan','id','bentuk_makanan_id');
    }

    public function jenis_makanan()
    {
        return $this->hasOne('App\Models\Gizi\JenisMakanan','id','jenis_makanan_id')->withTrashed();
    }
    public function kategori_makanan()
    {
        return $this->hasOne('App\Models\Gizi\KategoriMakanan','id','kategori_makanan_id');
    }

    public function menu()
    {
        return $this->hasOne('App\Models\Gizi\Menu','id','menu_id');
    }

    public function kelas()
    {
        return $this->hasOne('App\Models\Hospital\Kelas','id','kelas_id');
    }

    public function getMakananTambahanNamaAttribute()
    {
        $nama = [];
        $makanan_tambahan_ids = json_decode($this->makanan_tambahan_ids) ?? [];
        foreach ($makanan_tambahan_ids as $value) {
            $jenis_makanan_nama = JenisMakanan::find($value)->nama ?? null;
            if($jenis_makanan_nama) {
                array_push($nama, $jenis_makanan_nama);
            }
        }
        if (empty($nama)) $nama[] = null;
        return json_encode($nama);
    }
}
