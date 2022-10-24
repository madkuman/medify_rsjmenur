<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class PemasukanDetail extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'keuangan';
	protected $table = 'pemasukan_detail';	
	protected $fillable = ['id'];
	protected $dates = ['deleted_at'];

	public function tipe()
	{
		return $this->hasOne('App\Models\Keuangan\TarifTipe','id','tarif_tipe_id');
	}

    public function detail_bpjs()
    {
        return $this->hasOne('App\Models\Keuangan\PenagihanBPJS','id','penagihan_bpjs_id');
    }

	public function tarif()
	{
		return $this->hasOne('App\Models\Keuangan\Tarif','id','tarif_id');
	}

	public function kelas()
	{
		return $this->hasOne('App\Models\Hospital\Kelas','id','kelas_id');
	}

	public function pemasukan()
	{
		return $this->hasOne('App\Models\Keuangan\Pemasukan','id','pemasukan_id');
	}

	public function piutang()
	{
		return $this->hasOne('App\Models\Keuangan\Piutang','id','piutang_id');
	}

	public function tagihan()
	{
		return $this->hasOne('App\Models\Kasir\Tagihan','id','tagihan_id');
	}

	public function creator()
	{
		return $this->hasOne('App\User','id','created_by');
	}

	public function lokasi()
	{
		return $this->hasOne('App\Models\Hospital\Lokasi','id','lokasi_id')->withTrashed();
	}
	public function kategori()
	{
		return $this->hasOne('App\Models\Keuangan\Kategori','id','kategori_id');
	}
}

