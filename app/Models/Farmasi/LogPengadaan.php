<?php

namespace App\Models\Farmasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class LogPengadaan extends Model
{
	use DataLogger;
  //use Searchable;
  use SoftDeletes;

  protected $connection = 'farmasi';
	protected $table = 'log_pengadaan';

	/*public function searchableAs()
  {
    return 'gudang_item';
  }*/

	public function detail_item() {
	  return $this->hasOne('App\Models\Farmasi\Items', 'id', 'item_id')->withTrashed();
  }

  public function detail_pengadaan() {
    return $this->hasOne('App\Models\Farmasi\Pengadaan', 'id', 'pengadaan_id')->withTrashed();
  }

  public function pengadaan() {
    return $this->hasOne('App\Models\Farmasi\Pengadaan', 'id', 'pengadaan_id')->withTrashed();
  }


  public function user_detail() {
	  return $this->hasOne('App\User', 'id', 'created_by');
  }

  public function produsen()
  {
    return $this->hasOne('App\Models\Keuangan\Perusahaan','id', 'produsen_id')->withTrashed();
  }
}
