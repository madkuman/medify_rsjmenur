<?php

namespace App\Models\KamarJenazah;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permintaan extends Model
{
	use DataLogger;
    use SoftDeletes;
    protected $connection = 'kamarjenazah';
    protected $table = 'permintaan';

    protected $fillable = [
        'waktu_meninggal', 'waktu_jemput', 'tempat_meninggal','detail_tempat','detail_kematian',
    ];

    public function searchableAs()
    {
        return 'hospital_kamarjenazah';
    }

    public function diagnosis()
    {
    	return $this->hasOne('App\Models\KamarJenazah\Diagnosis', 'id', 'diagnosis_id');
    }

    public function sebab_kematian()
    {
    	return $this->hasOne('App\Models\KamarJenazah\Sebab_kematian', 'id', 'sebab_kematian_id');
    }

    public function patient()
    {
      return $this->hasOne('App\Models\Pasien\Pasien','id','pasien_id');
    }

    public function lokasi()
    {
      return $this->hasOne('App\Models\KamarJenazah\Tempat_meninggal','id','tempat_meninggal');
    }
}
