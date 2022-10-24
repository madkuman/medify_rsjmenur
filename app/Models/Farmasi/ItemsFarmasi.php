<?php

namespace App\Models\Farmasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Farmasi\Items;
use Carbon\Carbon;

class ItemsFarmasi extends Model
{
	use DataLogger;
	protected $connection = 'farmasi';
	protected $table = 'items_farmasi';

	use SoftDeletes;

	public function items_available() {
	  return $this->hasMany('App\Models\Farmasi\Items', 'item_farmasi_id', 'id')->where('kadaluarsa', '>' , Carbon::today())->where('jumlah','>',0);
    }

	public function items_all() {
	  return $this->hasMany('App\Models\Farmasi\Items', 'item_farmasi_id', 'id')->where('jumlah','>',0);
    }

	public function item_detail()
	{
		return $this->hasOne('App\Models\Farmasi\ItemsTemplate','id', 'item_template_id')->withTrashed();
	}

	public function item_template()
	{
		return $this->hasOne('App\Models\Farmasi\ItemsTemplate','id', 'item_template_id')->withTrashed();
	}

	public function owner_detail()
	{
		return $this->hasOne('App\Models\Farmasi\Apotek','id', 'farmasi_id')->withTrashed();
	}

	public function stok()
	{
		return  $this->hasOne('App\Models\Farmasi\Items', 'item_farmasi_id', 'id')
                ->where('kadaluarsa', '>' , Carbon::today()->endOfDay())
                ->where('jumlah','!=',0)
                ->selectRaw('item_farmasi_id, TRUNCATE(sum(`jumlah`), 2) as aggregate')
                ->groupBy('item_farmasi_id');

		// $items = Items::where('item_farmasi_id', $this->id)->where('kadaluarsa', '>' , Carbon::today())->get();
		// $stok = $items->sum('jumlah');
		// return $stok;
	}

	public function getStokAttribute()
	{
		// if relation is not loaded already, let's do it first
        if ( ! array_key_exists('stok', $this->relations)) 
            $this->load('stok');

        $related = $this->getRelation('stok');
        // then return the count directly
        return ($related) ? number_format((float) $related->aggregate, 2, '.', '') : 0;		
	}

    public function allStok()
    {
        return  $this->hasOne('App\Models\Farmasi\Items', 'item_farmasi_id', 'id')
            ->where('jumlah','!=',0)
            ->selectRaw('item_farmasi_id, TRUNCATE(sum(`jumlah`), 2) as aggregate')
            ->groupBy('item_farmasi_id');

        // $items = Items::where('item_farmasi_id', $this->id)->where('kadaluarsa', '>' , Carbon::today())->get();
        // $stok = $items->sum('jumlah');
        // return $stok;
    }

    public function getAllStokAttribute()
    {
        // if relation is not loaded already, let's do it first
        if ( ! array_key_exists('allStok', $this->relations))
            $this->load('allStok');

        $related = $this->getRelation('allStok');
        // then return the count directly
        return ($related) ? number_format((float) $related->aggregate, 2, '.', '') : 0;
    }

	public function getExpiredAttribute()
	{
		$items = Items::where('item_farmasi_id', $this->id)->where('kadaluarsa', '>' , Carbon::today())->where('jumlah', '>' , 0)->min('kadaluarsa');
		$exp = Carbon::today()->diffForHumans($items,true);
		if(is_null($items)) return "Tidak ada Stok";
		return $exp;
	}

	public function getExpiredDayAttribute()
	{
		$items = Items::where('item_farmasi_id', $this->id)->where('kadaluarsa', '>' , Carbon::today())->where('jumlah', '>' , 0)->min('kadaluarsa');
		$exp = Carbon::today()->diffInDays($items);
		if(is_null($items)) return 0;
		return $exp;
	}

	public function kadal()
	{
		
		return  $this->hasOne('App\Models\Farmasi\Items', 'item_farmasi_id', 'id')
                ->where('kadaluarsa', '>' , Carbon::today())
                ->where('jumlah','!=',0)
                ->selectRaw('item_farmasi_id, date(min(`kadaluarsa`)) as kadal')
                ->groupBy('item_farmasi_id');
	}

	public function getKadalAttribute()
	{
		if ( ! array_key_exists('kadal', $this->relations)) 
            $this->load('kadal');

        $related = $this->getRelation('kadal');
        // then return the count directly
        return ($related) ? $related->kadal : "-";

	  // $items = Items::where('item_farmasi_id', $this->id)->where('kadaluarsa', '>' , Carbon::today())->where('jumlah', '>' , 0)->min('kadaluarsa');
	  // return $items;
	}
	public function stok_kadaluarsa()
	{
		// return $this->items_available->sum('jumlah');
		return  $this->hasOne('App\Models\Farmasi\Items', 'item_farmasi_id', 'id')
	            ->where(function($q){
	              $q->where('kadaluarsa', '<=' , Carbon::today())->orWhereNull('kadaluarsa');
	            })
	            ->where('jumlah','!=',0)
	            ->selectRaw('item_farmasi_id, sum(`jumlah`) as aggregate')
	            ->groupBy('item_farmasi_id');;
	}
	public function getStokKadaluarsaAttribute()
	{
	    // if relation is not loaded already, let's do it first
	    if ( ! array_key_exists('stok_kadaluarsa', $this->relations)) 
	        $this->load('stok_kadaluarsa');

	    $related = $this->getRelation('stok_kadaluarsa');
	    // then return the count directly
	    return ($related) ? number_format((float) $related->aggregate, 2, '.', '') : 0;
	}

    public function all_items() {
        return $this->hasMany('App\Models\Farmasi\Items', 'item_farmasi_id', 'id');
    }
}
