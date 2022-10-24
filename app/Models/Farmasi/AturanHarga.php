<?php

namespace App\Models\Farmasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class AturanHarga extends Model
{
	use DataLogger;
    use SoftDeletes;
    //use Searchable;

    protected $connection = 'farmasi';
    protected $table = 'aturan_harga';

    public function detail_farmasi() {
  	  return $this->hasOne('App\Models\Farmasi\Farmasi', 'id', 'farmasi_id');
    }
}
