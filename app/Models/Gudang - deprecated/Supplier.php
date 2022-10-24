<?php

namespace App\Models\Gudang;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Supplier extends Model
{
	use DataLogger;
    use SoftDeletes;
    //use Searchable;

    public function searchableAs()
	  {
	    return 'gudang_supplier';
	  }
    
    protected $connection = 'gudang';
    protected $table = 'supplier';
    //protected $dates = ['deleted_at'];

  	public function items() {
  	  return $this->hasMany('App\Models\Gudang\ItemsTemplate', 'supplier', 'id');
    }
}
