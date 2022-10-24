<?php

namespace App\Models\KamarOperasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\Relation;

class Rencana extends Model
{
	use DataLogger;
  use SoftDeletes;
  protected $dates = ['deleted_at'];
  protected $connection = 'kamaroperasi';
  protected $table = 'rencana';

  public function getItem()
  {
    return $this->belongsTo('App\Models\Farmasi\ItemsTemplate', 'item_id', 'id')->withTrashed();
  }

  public function operasi()
  {
    return $this->belongsTo('App\Models\KamarOperasi\Transaksi', 'operasi_id', 'id');
  }
}
