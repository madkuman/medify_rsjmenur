<?php

namespace App\Models\Farmasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Farmasi extends Model
{
	use DataLogger;
  use SoftDeletes;

  protected $connection = 'farmasi';
  protected $table = 'farmasi';

  public function items() {
    return $this->hasMany('App\Models\Farmasi\ItemsFarmasi', 'farmasi_id', 'id');
  }

  public function aturan_harga() {
    return $this->hasMany('App\Models\Farmasi\AturanHarga', 'farmasi_id', 'id');
  }

  public function aturan_embalase() {
    return $this->hasMany('App\Models\Farmasi\AturanEmbalase', 'farmasi_id', 'id');
  }

  public function aturan_shift() {
    return $this->hasMany('App\Models\Farmasi\AturanShift', 'farmasi_id', 'id');
  }

  public function lokasi()
  {
    return $this->hasOne('App\Models\Hospital\Lokasi', 'id', 'lokasi_id');
  }

  public function current_shift()
  {
    return $this->hasOne('App\Models\Farmasi\AturanShift', 'id', 'current_shift_id');    
  }

  public function jenis_detail()
  {
    return $this->hasOne('App\Models\Farmasi\FarmasiJenis', 'id', 'jenis');    
  }

  public function group()
  {
      return $this->hasOne('App\Models\Hospital\Grup','id','group_id');
  }
}