<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use ScoutElastic\Searchable;
class  Tarif extends Model
{
	use DataLogger;
	use SoftDeletes;

	protected $connection = 'keuangan';
	protected $table = 'tarif';
	protected $fillable = ['id'];
	protected $dates = ['deleted_at'];

	public function master()
	{
		return $this->hasOne('App\Models\Keuangan\TarifMaster', 'id', 'tarif_master_id');
	}
	
	public function kelas()
	{
		return $this->hasOne('App\Models\Hospital\Kelas', 'id', 'kelas_id');
	}
	
	public function tipe()
	{
		return $this->hasOne('App\Models\Keuangan\TarifTipe', 'id', 'tipe_id');
	}
	
	public function tarif_detail()
	{
		return $this->hasMany('App\Models\Keuangan\TarifINACBG', 'tarif_id', 'id');
	}
}
