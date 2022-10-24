<?php

namespace App\Models\CSSD;
use DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;


class Transaksi extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'cssd';
	protected $table = 'transaksi';

	public function transaksi_ok()
	{
		return $this->hasOne('App\Models\KamarOperasi\Transaksi', 'id', 'ok_transaksi_id');
	}

	public function getStatusTextAttribute()
	{
		if($this->status == 0) return '';
		else return 'Selesai';
	}

	public function detail_group()
	{
		return $this->hasMany('App\Models\CSSD\TransaksiDetail', 'transaksi_id', 'id')->where('extra',0)->select('item_template_id',DB::raw('count(*) as total'))->groupBy('item_template_id');
	}

	public function detail()
	{
		return $this->hasMany('App\Models\CSSD\TransaksiDetail', 'transaksi_id', 'id');
	}


	public function sender() {
		return $this->hasOne('App\User', 'id', 'sent_by');
	}

}
