<?php

namespace App\Models\KamarOperasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaketItem extends Model
{
	use DataLogger;
  protected $connection = 'kamaroperasi';
	protected $table = 'paket_item';

  public function paket()
  {
    return $this->belongsTo('App\Models\KamarOperasi\Paket');
  }

  public function getItem()
  {
    // if ($this->tipe == 'alkes') return $this->belongsTo('App\Models\CSSD\Alkes', 'item_id', 'id');
    // else
     return $this->hasOne('App\Models\Farmasi\ItemsTemplate', 'id', 'item_id');
  }
}
