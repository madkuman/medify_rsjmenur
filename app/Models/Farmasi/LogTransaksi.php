<?php

namespace App\Models\Farmasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogTransaksi extends Model
{
	use DataLogger;
	protected $connection = 'farmasi';
	protected $table = 'log_transaksi';

	use SoftDeletes;

	public function detail_item() {
	  return $this->hasOne('App\Models\Farmasi\Items', 'id', 'item_id')->withTrashed();
    }

    public function detail_resep() {
      return $this->hasOne('App\Models\Farmasi\ResepDetail', 'id', 'resep_detail_id')->withTrashed();
    }

    public function laporanTransaksi()
    {
        return $this->morphOne('App\Models\Farmasi\LaporanTransaksi', 'jenis');
    }

}
