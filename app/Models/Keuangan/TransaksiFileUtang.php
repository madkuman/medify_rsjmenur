<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class TransaksiFileUtang extends Model
{
	use DataLogger;
    use SoftDeletes;
	protected $connection = 'keuangan';
	protected $table = 'transaksi_file_utang';
	protected $dates = ['created_at','deleted_at'];
	protected $appends = ['sent_at', 'confirmed_at'];

	/*public function transaksi() {
	  return $this->hasMany('App\Models\RawatJalan\Transaksi', 'poliklinik_id', 'id');
	}*/
	public function file() {
		return $this->hasOne('App\Models\Keuangan\Utang', 'id', 'utang_id');	
	}
	public function holder() {
		return $this->hasOne('App\User', 'id', 'holder_confirmed_by');	
	}
	public function sender() {
		return $this->hasOne('App\User', 'id', 'sender_sent_by');	
	}
	public function send_canceler() {
		return $this->hasOne('App\User', 'id', 'cancel_sent_by');	
	}
	public function confirm_canceler() {
		return $this->hasOne('App\User', 'id', 'cancel_confirmed_by');	
	}
	public function transaksi_asal() {
		return $this->hasOne('App\Models\Keuangan\TransaksiFileUtang', 'id', 'transaksi_asal_id');	
	}
	public function getResponseTimeSendingAttribute()
	{
		$created_at = $this->created_at;
		$send_at = Carbon::parse($this->sender_sent_at);
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
	public function getSentAtAttribute()
	{
		return indonesian_date($this->sender_sent_at, "j F Y, H:i", "WIB");
	}
	public function getConfirmedAtAttribute()
	{
		return indonesian_date($this->holder_confirmed_at, "j F Y, H:i", "WIB");
	}
}
