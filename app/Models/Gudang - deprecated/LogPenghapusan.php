<?php

namespace App\Models\Gudang;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogPenghapusan extends Model
{
	use DataLogger;
	protected $connection = 'gudang';
	protected $table = 'log_penghapusan';

	use SoftDeletes;

	public function detail_item() {
	  return $this->hasOne('App\Models\Gudang\Items', 'id', 'item_id')->withTrashed();
    }

    public function detail_penghapusan() {
      return $this->hasOne('App\Models\Gudang\Penghapusan', 'id', 'penghapusan_id')->withTrashed();
    }

}
