<?php

namespace App\Models\KamarOperasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class PengembalianObat extends Model
{
	use DataLogger;
  use SoftDeletes;
  protected $dates = ['deleted_at'];
  protected $connection = 'kamaroperasi';
	protected $table = 'pengembalian_obat';

  public function item()
  {
    return $this->belongsTo('App\Models\Gudang\ItemsTemplate', 'item_id', 'id');
  }
}
