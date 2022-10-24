<?php

namespace App\Models\Gudang;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogDistribusi extends Model
{
	use DataLogger;
	protected $connection = 'gudang';
	protected $table = 'log_distribusi';

	use SoftDeletes;

	public function detail_item() {
	  return $this->hasOne('App\Models\Gudang\Items', 'id', 'item_id')->withTrashed();
    }

    public function detail_distribusi() {
      return $this->hasOne('App\Models\Gudang\Distribusi', 'id', 'distribusi_id')->withTrashed();
    }

    public function status_distribusi() {
      return $this->hasOne('App\Models\Gudang\Distribusi', 'id', 'distribusi_id')->where('status',1);
    }

	/*public function item_detail()
	{
		return $this->hasOne('App\Models\Warehouse\Items','id', 'item_id')->withTrashed();
	}

	public function transaction_detail()
	{
		return $this->hasOne('App\Models\Warehouse\Transaction','id', 'transaction_id');
	}

	public function record_detail()
	{
		return $this->hasMany('App\Models\Warehouse\ItemsRecord','log_in', 'id');
	}

	public function log_detail()
	{
		return $this->hasMany('App\Models\Warehouse\ItemsRecord','log_out', 'id');
	}*/

}
