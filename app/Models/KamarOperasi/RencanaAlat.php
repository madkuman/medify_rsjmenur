<?php

namespace App\Models\KamarOperasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\Relation;

class RencanaAlat extends Model
{
	use DataLogger;
  use SoftDeletes;
  protected $dates = ['deleted_at'];
  protected $connection = 'kamaroperasi';
	protected $table = 'rencana_alat';

  public function item()
  {
    return $this->belongsTo('App\Models\CSSD\Alkes', 'item_id', 'id');
  }
}
