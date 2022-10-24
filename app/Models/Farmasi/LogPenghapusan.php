<?php

namespace App\Models\Farmasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogPenghapusan extends Model
{
	use DataLogger;
	protected $connection = 'farmasi';
	protected $table = 'log_penghapusan';

	use SoftDeletes;

	public function detail_item() {
	  return $this->hasOne('App\Models\Farmasi\Items', 'id', 'item_id')->withTrashed();
    }

    public function detail_penghapusan() {
      return $this->hasOne('App\Models\Farmasi\Penghapusan', 'id', 'penghapusan_id')->withTrashed();
    }

}
