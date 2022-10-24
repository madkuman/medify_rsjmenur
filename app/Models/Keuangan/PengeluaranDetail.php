<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class PengeluaranDetail extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'keuangan';
	protected $table = 'pengeluaran_detail';
	protected $fillable = ['id'];	
	protected $dates = ['deleted_at'];


	public function utang()
	{
		return $this->hasOne('App\Models\Keuangan\Utang','id','utang_id');
	}
}
