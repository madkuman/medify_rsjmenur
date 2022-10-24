<?php

namespace App\Models\KamarOperasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class PengembalianAlat extends Model
{
	use DataLogger;
  use SoftDeletes;
  protected $dates = ['deleted_at'];
  protected $connection = 'kamaroperasi';
	protected $table = 'pengembalian_alat';

  public function item()
  {
    return $this->belongsTo('App\Models\CSSD\Alkes', 'item_id', 'id');
  }
}
