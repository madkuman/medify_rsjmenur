<?php
namespace App\Models\Urikkes;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use App\Models\Kasus\Lain_Urikkes as UrikkesResume;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
	use DataLogger;
    use SoftDeletes;

	protected $connection = 'urikkes';
	protected $table = 'transaksi';
	protected $dates = [
		'ordered_at',
	];


	public function transaksi_detail()
	{
		return $this->hasMany('App\Models\Urikkes\TransaksiDetail','transaksi_id');
	}

	public function transaksi_detail_first()
	{
		return $this->hasOne('App\Models\Urikkes\TransaksiDetail','transaksi_id')->oldest();
	}

	public function pasien_detail() {
		return $this->hasOne('App\Models\Pasien\Pasien', 'id', 'pasien_id');
	}

	public function kasus()
	{
		return $this->hasOne('App\Models\Kasus\Kasus','id','kasus_id');
	}

	public function lokasi()
	{
		return $this->hasOne('App\Models\Hospital\Lokasi','id','lokasi_id');
	}

	public function scopeHasStakes($query, $stakes)
	{
		$kasus_id = UrikkesResume::whereIn('kasus_id', $query->pluck('kasus_id'))->whereIn('stakes', $stakes)->pluck('kasus_id');

		return $query->whereIn('kasus_id', $kasus_id);
	}

	public function getDetailTarifIdAttribute()
	{
		return $this->transaksi_detail->pluck('tarif_id')->toArray();
	}

	public function pembayaran()
    {
        return $this->hasOne('App\Models\Pasien\PasienPembayaran', 'id', 'pasien_pembayaran_id')->withTrashed();
    }

    public function piutang()
    {
        return $this->hasOne('App\Models\Keuangan\Piutang', 'id', 'piutang_id');
    }

    public function dokter()
    {
        return $this->hasOne('App\User', 'id', 'dokter_id');
    }

    public function pasien() {
        return $this->hasOne('App\Models\Pasien\Pasien', 'id', 'pasien_id');
    }
}