<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Carbon\Carbon;

class Identitas extends Model
{
	use DataLogger;
  	protected $connection = 'kasus';
	protected $table = 'identitas';
	protected $appends = ['age', 'tanggal', 'gender'];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

	public function getAgeAttribute() {
        $dt = new Carbon($this->tanggal_lahir);
        $created_at = $this->created_at;
        $diff = $dt->diff($created_at);
        $day = $diff->format('%d');
        $month = $diff->format('%m');
        $year = $diff->format('%y');
        if($year == 0 && $month == 0)
        {
            $date = new Carbon($this->tanggal_lahir);
            return $date->diff($created_at)->format('%d Hari');
        }
        elseif($year == 0)
        {
            $date = new Carbon($this->tanggal_lahir);
            return $date->diff($created_at)->format('%m Bulan %d Hari');
        }
        else
        {
            $date = new Carbon($this->tanggal_lahir);
            return $date->diff($created_at)->format('%y Tahun');
        }
    }


    public function getAgeYearAttribute() {
        $created_at = $this->created_at;
        $date = new Carbon($this->tanggal_lahir);
        return $date->diff($created_at)->format('%y');
    }

    public function getAgeDayAttribute() {
        $created_at = $this->created_at;
        $date = new Carbon($this->tanggal_lahir);
        return $date->diffInDays($created_at)->format('%d');
    }

    public function getTanggalAttribute() {
        return Carbon::parse($this->attributes['tanggal_lahir'])->format('d F Y');
    }

    public function insurance() {
	    return $this->hasOne('App\Models\Pasien\Asuransi', 'id', 'asuransi');
    }

    public function getAlergiObatArrayAttribute($value)
    {
        return  array_filter(explode(",",$this->attributes['alergi_obat']));
    }

    public function getAlergiMakananArrayAttribute($value)
    {
        return  array_filter(explode(",",$this->attributes['alergi_makanan']));
    }

    public function getGenderAttribute()
    {
        if($this->jenis_kelamin == 'L')
            $gender = 'Laki laki';
        else
            $gender = 'Perempuan';

        return $gender;
    }


    public function update_user() {
        return $this->hasOne('App\User', 'id', 'updated_by');
    }



    public function getLamaTirahBaringAttribute(){

        $tanggal_tirah_baring_start = $this->attributes['tanggal_tirah_baring_start'];
        $tanggal_tirah_baring_end = $this->attributes['tanggal_tirah_baring_end'];
        
        if(!empty($tanggal_tirah_baring_start)){
            $tirah_start = $tanggal_tirah_baring_start;
            $tirah_start = Carbon::parse($tirah_start);
        }
        else
            $tirah_start = Carbon::today();

        if(!empty($tanggal_tirah_baring_end)){
            $tirah_end = $tanggal_tirah_baring_end;
            $tirah_end = Carbon::parse($tirah_end);
        }
        else
            $tirah_end = Carbon::today();

        $selisih = $tirah_start->diffInDays($tirah_end);

        return $selisih;
    }
}
