<?php

namespace App\Models\Laundry;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Carbon\Carbon;

class Transaksi extends Model
{
	use DataLogger;
  use SoftDeletes;
  protected $connection = 'laundry';
	protected $table = 'transaksi';

  public function getStatus(){
    return $this->belongsTo('App\Models\Laundry\Status','status_id');
  }

  public function TransaksiWaktu(){
    return $this->hasOne('App\Models\Laundry\Penanggungjawab','transaksi_id');
  }

  public function creator() {
       return $this->hasOne('App\User', 'id', 'created_by');
   }

  public function getGroupName(){
      return $this->hasOne('App\Models\Hospital\Grup', 'id', 'group_id');
  }
}
