<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Keuangan\AkunPJK;
use Carbon\Carbon;

class Utang extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'keuangan';
	protected $table = 'utang';
	protected $fillable = ['id'];
	protected $dates = ['deleted_at'];
	// protected $appends = ['nomor_pjk'];

	// protected $attributes = [
    //     'flag' => 'pem'
    // ];

	public function po()
	{
		return $this->hasOne('App\Models\Keuangan\PO','id','po_id');
	}
	public function detail()
	{
		return $this->hasMany('App\Models\Keuangan\UtangDetail','utang_id','id');
	}
	public function file_transaksi()
	{
		return $this->hasMany('App\Models\Keuangan\TransaksiFileUtang','utang_id','id')->orderBy('updated_at', 'asc')->orderBy('created_at', 'asc');
	}
	public function kategori()
	{
		return $this->hasOne('App\Models\Keuangan\Kategori','id','kategori_id');
	}
	public function perusahaan()
	{
		return $this->hasOne('App\Models\Keuangan\Perusahaan','id','perusahaan_id')->withTrashed();
	}
	public function pengeluaranDetail()
	{
		return $this->hasMany('App\Models\Keuangan\PengeluaranDetail','utang_id','id');
	}
	public function UJIDetail()
	{
		return $this->hasMany('App\Models\Keuangan\Pengeluaran','utang_id','id');
	}
	public function akun()
	{
		return $this->hasOne('App\Models\Keuangan\AkunPJK','id','akun_pjk_id');
	}
	public function getNomorPjkAttribute() {
        $date = Carbon::parse($this->tanggal_transaksi);
        $no = $this->no_pjk;
        $bulan = app('App\Http\Controllers\Functions\DateFormatter')->numberToRoman($date->month);
        $tahun = $date->year;
        $akun_pjk = $this->akun->name ?? '-';
        $no_pjk = (!empty($no)) ? ($no).'/'.$bulan.'/'.$tahun.'/'.$akun_pjk : '-';

        return $no_pjk;
    }
}
