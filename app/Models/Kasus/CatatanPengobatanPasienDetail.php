<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatatanPengobatanPasienDetail extends Model
{
	use DataLogger;
    use SoftDeletes;

	protected $connection = 'kasus';
	protected $table = 'catatan_pengobatan_pasien_detail';
    protected $dates = ['pemberian_at'];
    protected $appends = array('pemberian_at_waktu','pemberian_at_waktu_short','pemberian_at_jam','status_warna');


    public function creator() {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function updater() {
        return $this->hasOne('App\User', 'id', 'updated_by');
    }
    public function deleter() {
        return $this->hasOne('App\User', 'id', 'deleted_by');
    }
    public function catatan_pengobatan_pasien() {
        return $this->hasOne('App\Models\Kasus\CatatanPengobatanPasien', 'id', 'catatan_pengobatan_pasien_id');
    }
    public function verifikator_1() {
        return $this->hasOne('App\User', 'id', 'verified_by');
    }
    public function verifikator_2() {
        return $this->hasOne('App\User', 'id', 'verified_by_2');
    }

    public function getPemberianAtWaktuAttribute()
    {
        $time = $this->pemberian_at->format('H');
        if($time < 4) return 'Extra';
        else if($time < 10) return 'Pagi';
        else if($time < 14) return 'Siang';
        else if($time < 18) return 'Sore';
        else if($time < 22) return 'Malam';
        else return 'Extra';
    }

    public function getPemberianAtWaktuShortAttribute()
    {
        $time = $this->pemberian_at->format('H');
        if($time < 4) return 'Ex';
        else if($time < 10) return 'Pg';
        else if($time < 14) return 'Si';
        else if($time < 18) return 'So';
        else if($time < 22) return 'Mlm';
        else return 'Ex';
    }

    public function getPemberianAtJamAttribute()
    {
        $time = $this->pemberian_at->format('H:i');
        return $time;
    }

    public function getObatIdAttribute()
    {
        return $this->catatan_pengobatan_pasien->obat_id;
    }

    public function getStatusWarnaAttribute()
    {
        return config('medify.kasus.riwayat_pemberian_obat.'.$this->status,'primary');
    }

}
