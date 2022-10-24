<?php

namespace App\Models\Farmasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogDistribusi extends Model
{
	use DataLogger;
	protected $connection = 'farmasi';
	protected $table = 'log_distribusi';

	use SoftDeletes;

	public function detail_item() {
	  return $this->hasOne('App\Models\Farmasi\Items', 'id', 'item_id')->withTrashed();
    }

    public function detail_distribusi() {
      return $this->hasOne('App\Models\Farmasi\Distribusi', 'id', 'distribusi_id')->withTrashed();
    }

    public function item_farmasi() {
	  return $this->hasOne('App\Models\Farmasi\ItemsFarmasi', 'id', 'item_farmasi_id')->withTrashed();
    }

}
