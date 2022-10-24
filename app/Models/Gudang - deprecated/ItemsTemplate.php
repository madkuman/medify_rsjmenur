<?php

namespace App\Models\Gudang;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use ScoutElastic\Searchable;
use App\Models\Gudang\Items;
use Carbon\Carbon;
use DB;

class ItemsTemplate extends Model
{
	use DataLogger;
  use Searchable;
  use SoftDeletes;

  protected $connection = 'gudang';
	protected $table = 'item_template';
  protected $indexConfigurator = \App\IndexConfig\FarmasiItems::class;

  protected $mapping = [
    'properties' => [
      'nama' => [
        "type" => "text",
        "analyzer" => "partial",
        "search_analyzer" => "partial"
      ],
      'satuan' => [
        "type" => "text",
        "analyzer" => "partial",
        "search_analyzer" => "partial"
      ],
      'kode' => [
        "type" => "text",
        "analyzer" => "partial",
        "search_analyzer" => "partial"
      ],
    ]
  ];

  public function toSearchableArray()
  {
    return $this->toArray();
  }

	/*public function searchableAs()
  {
    return 'warehouse_item';
  }*/
	public function items_available() {
	  return $this->hasMany('App\Models\Gudang\Items', 'item_template_id', 'id')->where('kadaluarsa', '>' , Carbon::today())->where('jumlah','>',0);
  }

  public function items_category() {
    return $this->hasMany('App\Models\Gudang\ItemsKategori', 'item_template_id', 'id');
  }

  public function user_detail() {
	  return $this->hasOne('App\User', 'id', 'created_by');
  }

  public function supplier_detail() {
	  return $this->hasOne('App\Models\Gudang\Supplier', 'id', 'supplier')->withTrashed();
  }
  
  public function stok()
  {
    // return $this->items_available->sum('jumlah');
    return  $this->hasOne('App\Models\Gudang\Items', 'item_template_id', 'id')
                ->where('kadaluarsa', '>' , Carbon::today())
                ->where('jumlah','!=',0)
                ->selectRaw('item_template_id, sum(`jumlah`) as aggregate, min(`kadaluarsa`) as kadaluarsa')
                ->groupBy('item_template_id');;
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

  public function getKadaluarsaAttribute()
  {
        // if relation is not loaded already, let's do it first
        if ( ! array_key_exists('stok', $this->relations)) 
            $this->load('stok');

        $related = $this->getRelation('stok');
        // then return the count directly
        return ($related) ?  $related->kadaluarsa : 0;
  }

  public function getExpiredAttribute()
  {
    $items = Items::where('item_template_id', $this->id)->where('kadaluarsa', '>' , Carbon::today())->where('jumlah', '>' , 0)->min('kadaluarsa');
    $exp = Carbon::today()->diffForHumans($items,true);
    if(is_null($items)) return "Tidak ada Stok";
    return $exp;
  }

  public function getExpiredDayAttribute()
  {
    $items = Items::where('item_template_id', $this->id)->where('kadaluarsa', '>' , Carbon::today())->where('jumlah', '>' , 0)->min('kadaluarsa');
    $exp = Carbon::today()->diffInDays($items);
    if(is_null($items)) return 0;
    return $exp;
  }

  public function getMinimalKadaluarsaAttribute()
  {
    $items = Items::where('item_template_id', $this->id)->where('kadaluarsa', '>' , Carbon::today())->where('jumlah', '>' , 0)->min('kadaluarsa');
    return $items;
  }

  public function produksi()
  {
    return $this->hasOne('App\Models\Farmasi\Produksi', 'id', 'produksi_id')->withTrashed();
  }

  public function stok_kadaluarsa()
  {
    // return $this->items_available->sum('jumlah');
    return  $this->hasOne('App\Models\Gudang\Items', 'item_template_id', 'id')
                ->where(function($q){
                  $q->where('kadaluarsa', '<=' , Carbon::today())->orWhereNull('kadaluarsa');
                })
                ->where('jumlah','!=',0)
                ->selectRaw('item_template_id, sum(`jumlah`) as aggregate')
                ->groupBy('item_template_id');;
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
}
