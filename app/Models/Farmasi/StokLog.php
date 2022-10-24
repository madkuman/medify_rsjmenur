<?php

namespace App\Models\Farmasi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class StokLog extends Model
{
	use SoftDeletes;
	protected $connection = 'farmasi';
	protected $table = 'stok_log';



	public function item_farmasi() {
		return $this->hasOne('App\Models\Farmasi\ItemsFarmasi', 'id', 'item_farmasi_id');
	}
	public function item() {
		return $this->hasOne('App\Models\Farmasi\Items', 'id', 'item_id');
	}
	public function item_template() {
		return $this->hasOne('App\Models\Farmasi\ItemsTemplate', 'id', 'item_template_id');
	}
	public function farmasi() {
		return $this->hasOne('App\Models\Farmasi\Farmasi', 'id', 'farmasi_id');
	}
}
