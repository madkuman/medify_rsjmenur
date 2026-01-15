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
		return $this->hasOne('App\Models\Farmasi\Farmasi','id', 'farmasi_id')->withTrashed();
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

	public function hitungHargaJual($aturan_harga, $jumlah = 1, $laba = false, $farmasi = null, $param = [])
	{
		$param = (object) $param;
        if(is_null($farmasi))
            $farmasi = $this->owner_detail;

		$final_harga = $this->item_template->harga;
		$final_harga = round($final_harga);

		if($laba !== false){
			if($laba === true){
				$persen_laba = 0;
				$selected_aturan_harga = app(\App\Http\Controllers\Farmasi\AturanHarga\ReadController::class)->findAturan($aturan_harga, $final_harga, false);
				if(isset($selected_aturan_harga)){
					$persen_laba = $selected_aturan_harga->laba;
				}
			}else{
				$persen_laba = $laba;
			}
			$final_harga = $final_harga * (100 + $persen_laba) / 100;
			if ($param->laba_round ?? true) {	
				$final_harga = round($final_harga);
			}
		}
		
		if ($param->return_object ?? false) {
			return (object) [
				'harga' => $final_harga,
				'laba' => $persen_laba ?? 0,
				'selected_aturan_harga' => $selected_aturan_harga ?? null,
			];
		}

		return $final_harga;
	}
}
