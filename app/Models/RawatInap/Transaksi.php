<?php

namespace App\Models\RawatInap;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
	use DataLogger;
	protected $connection = 'rawatinap';
	protected $table = 'transaksi';
    use SoftDeletes;
    protected $dates = [
        'created_at',
        'updated_at',
        'waktu_masuk'
    ];

	public function pasien()
	{
		return $this->hasOne('App\Models\Pasien\Pasien', 'id', 'pasien_id');
	}

	public function kasus()
	{
		return $this->hasOne('App\Models\Kasus\Kasus', 'id', 'kasus_id');
	}


    public function transaksi_masuk_detail()
    {
      	return $this->hasOne('App\Models\Hospital\TransaksiUtama','id','transaksi_masuk_detail_id');
    }

    public function tempat_tidur() {
    	    return $this->hasOne('App\Models\RawatInap\TempatTidur', 'id', 'tempat_tidur_id');
    }

    public function getUsiaMasukYearAttribute(){
            return floor($this->usia_masuk/365);
    }


    public function creator()
    {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function rm_transaksi()
    {
      return $this->hasOne('App\Models\RekamMedis\Transaksi','id','rm_transaksi_id');
    }

    public function farmasi_transaksi_obat_kirim_ruangan()
    {
        return $this->hasMany(\App\Models\Farmasi\TransaksiObat::class, 'kasus_id', 'kasus_id')->where('telaah_kirim_ruangan', '1');
    }

}
