<?php

namespace App\Models\Farmasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Items extends Model
{
	use DataLogger;
  protected $connection = 'farmasi';
	protected $table = 'items';
	//use Searchable;
	use SoftDeletes;

  public function record_keluar() {
    return $this->hasMany('App\Models\Apotek\RecipeDetail', 'obat_id', 'id');
  }

  public function detail_item() {
    return $this->hasOne('App\Models\Farmasi\ItemsFarmasi', 'id', 'item_farmasi_id')->withTrashed();
  }

  public function item_farmasi() {
    return $this->hasOne('App\Models\Farmasi\ItemsFarmasi', 'id', 'item_farmasi_id')->withTrashed();
  }

  public function detail_pengadaan() {
    return $this->hasOne('App\Models\Farmasi\Pengadaan', 'id', 'pengadaan_id')->withTrashed();
  }

  public function log_pengadaan() {
    return $this->hasOne('App\Models\Farmasi\LogPengadaan', 'id', 'log_pengadaan_id')->withTrashed();
  }

  public function detail_distribusi() {
    return $this->hasOne('App\Models\Farmasi\Distribusi', 'id', 'distribusi_id')->withTrashed();
  }

  public function owner_detail() {
	  return $this->hasOne('App\Models\Apotek\Pharmacy', 'id', 'pharmacy_id')->withTrashed();
  }

  public function record($skip) {
    $masuk = $this->record_masuk()->latest()->with('transaction_detail')->get();
    $keluar = $this->record_keluar()->latest()->with('resep_detail')->with('resep_detail.transaction_detail')->with('resep_detail.transaction_detail.pasien_detail')->get();
    if($skip < 0) return $masuk->merge($keluar)->sortByDesc('created_at');
    return $masuk->merge($keluar)->sortByDesc('created_at')->slice($skip,10);
  }
}
