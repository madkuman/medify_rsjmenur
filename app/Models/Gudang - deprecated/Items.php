<?php

namespace App\Models\Gudang;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Items extends Model
{
	use DataLogger;
  //use Searchable;
  use SoftDeletes;

  protected $connection = 'gudang';
	protected $table = 'items';

	public function searchableAs()
  {
    return 'gudang_item';
  }

	public function detail_item() {
	  return $this->hasOne('App\Models\Gudang\ItemsTemplate', 'id', 'item_template_id')->withTrashed();
  }

  public function detail_pengadaan() {
    return $this->hasOne('App\Models\Gudang\Pengadaan', 'id', 'pengadaan_id')->withTrashed();
  }

  public function log() {
    return $this->hasMany('App\Models\Gudang\LogDistribusi', 'item_id', 'id');
  }

  public function user_detail() {
	  return $this->hasOne('App\User', 'id', 'created_by');
  }
}
