<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class PO extends Model
{
	use DataLogger;
    use SoftDeletes;
	protected $connection = 'keuangan';
	protected $table = 'po';
	protected $fillable = ['id'];
	protected $dates = ['deleted_at'];


	public function perusahaan()
	{
		return $this->hasOne('App\Models\Keuangan\Perusahaan','id','perusahaan_id')->withTrashed();
	}
	public function pjk()
	{
		return $this->hasMany('App\Models\Keuangan\Utang','po_id','id')->whereNotNull('nomorpjk');
	}
	public function penerimaan()
	{
		return $this->hasMany('App\Models\Keuangan\Utang','po_id','id')->whereNotNull('no_faktur');
	}
	public function detail()
	{
		return $this->hasMany('App\Models\Keuangan\PODetail','po_id','id');
	}
}
