<?php

namespace App\Models\CSSD;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;


class TransaksiDetail extends Model
{
	use DataLogger;
	
	use SoftDeletes;
	protected $connection = 'cssd';
	protected $table = 'transaksi_detail';


	public function alkes()
	{
		return $this->hasOne('App\Models\Farmasi\ItemsTemplate', 'id', 'item_template_id')->withTrashed();
	}
	public function alkes_satuan()
	{
		return $this->hasOne('App\Models\CSSD\AlkesSatuan', 'id', 'alkes_satuan_id')->withTrashed();
	}
}
