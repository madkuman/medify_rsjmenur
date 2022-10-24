<?php

namespace App\Models\RekamMedis;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Hospital\Grup;
use App\User;
use Carbon\Carbon;

class Transaksi extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'rekammedis';
	protected $table = 'transaksi';
	protected $dates = ['created_at','deleted_at'];

	/*public function transaksi() {
	  return $this->hasMany('App\Models\RawatJalan\Transaksi', 'poliklinik_id', 'id');
	}*/
	public function pasien() {
		return $this->hasOne('App\Models\Pasien\Pasien', 'id', 'pasien_id');	
	}
	public function getHolderAttribute() {
		if($this->holder_type == 1)
		{
			$holder = User::find($this->holder_user_id);
		}
		else 
		{
			$holder = Grup::find($this->holder_group_id);
		}
		return $holder;
	}
	public function holder_user() {
		return $this->hasOne('App\User', 'id', 'holder_user_id');	
	}
	public function holder_group() {
		return $this->hasOne('App\Models\Hospital\Grup', 'id', 'holder_group_id');	
	}
	public function holder_confirmer() {
		return $this->hasOne('App\User', 'id', 'holder_confirmed_by');	
	}
	public function sender() {
		return $this->hasOne('App\User', 'id', 'sender_confirmed_by');	
	}
	public function tujuan() {
		return $this->hasOne('App\Models\RekamMedis\TransaksiTujuan', 'id', 'tujuan_id');		
	}
	public function getCreatedAtHumanAttribute()
	{
		return $this->created_at->diffForHumans(); 
	}
	public function getResponseTimeSendingAttribute()
	{
		$created_at = $this->created_at;
		$send_at = Carbon::parse($this->sender_confirmed_at);
		$response_day = $created_at->diffInDays($send_at);

		if($response_day == 0)
		{
			$response_time = $created_at->diff($send_at)->format('%h:%i:%s');
			return $response_time;
		}
		else
		{
			$response_time = $created_at->diff($send_at)->format('%d hari - %h:%i:%s');
			return $response_time;
		}
		

	}


}
