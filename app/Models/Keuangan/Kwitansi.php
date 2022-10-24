<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kwitansi extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'keuangan';
	protected $table = 'kwitansi';
	protected $fillable = ['id'];
	protected $dates = ['deleted_at'];

	public function kategori()
	{
		return $this->hasOne('App\Models\Keuangan\Kategori','id','kategori_id');
	}

}
