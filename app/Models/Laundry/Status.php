<?php

namespace App\Models\Laundry;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class Status extends Model
{
	use DataLogger;
  protected $connection = 'laundry';
  protected $table = 'status';

  public function TransaksiStatus(){
      return $this->hasMany('App\Models\Laundry\Transaksi');
  }
}
