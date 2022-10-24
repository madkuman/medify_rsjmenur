<?php

namespace App\Models\LabPK;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

use Illuminate\Database\Eloquent\SoftDeletes;


class TransaksiSpesimen extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'lab_pk';
	protected $table = 'transaksi_spesimen';


	public function kategori()
	{
		return $this->hasOne('App\Models\LabPK\Transaksi', 'id', 'transaksi_id');
	}

	public function spesimen()
	{
		return $this->hasOne('App\Models\LabPK\MikrobiologiSpesimen', 'id', 'spesimen_id');
	}
}
