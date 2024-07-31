<?php

namespace App\Models\Farmasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use ScoutElastic\Searchable;
use App\Models\Farmasi\Items;
use App\Models\CSSD\AlkesSatuan;
use Carbon\Carbon;
use DB;

class ItemsTemplate extends Model
{
	use DataLogger;

	use Searchable;
	use SoftDeletes;


	protected $connection = 'farmasi';
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

	public function items_available() {
		return $this->hasMany('App\Models\Farmasi\Items', 'item_template_id', 'id')->where('kadaluarsa', '>' , Carbon::today())->where('jumlah','>',0);
	}

	public function kategori_item() {
		return $this->hasMany('App\Models\Farmasi\ItemsKategori', 'item_template_id', 'id');
	}

	public function user_detail() {
		return $this->hasOne('App\User', 'id', 'created_by');
	}

	public function getKadaluarsaAttribute()
	{
		if ( ! array_key_exists('stok', $this->relations)) 
			$this->load('stok');

		$related = $this->getRelation('stok');
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
		return  $this->hasOne('App\Models\Farmasi\Items', 'item_template_id', 'id')
		->where(function($q){
			$q->where('kadaluarsa', '<=' , Carbon::today())->orWhereNull('kadaluarsa');
		})
		->where('jumlah','!=',0)
		->selectRaw('item_template_id, sum(`jumlah`) as aggregate')
		->groupBy('item_template_id');;
	}
	public function getStokKadaluarsaAttribute()
	{
		if ( ! array_key_exists('stok_kadaluarsa', $this->relations)) 
			$this->load('stok_kadaluarsa');

		$related = $this->getRelation('stok_kadaluarsa');
		return ($related) ? number_format((float) $related->aggregate, 2, '.', '') : 0;
	}

	public function harga_perusahaan()
	{
		return $this->hasMany('App\Models\Farmasi\ItemTemplateHarga', 'item_template_id', 'id');
	}



	public function cssd_alkes_satuan()
	{
		return $this->hasMany('App\Models\CSSD\AlkesSatuan', 'item_template_id', 'id');
	}

	public function cssd_stok_total()
	{
		return $this->hasMany('App\Models\CSSD\AlkesSatuan', 'item_template_id', 'id');
	}

	public function cssd_stok_siap_pakai()
	{
		return $this->hasMany('App\Models\CSSD\AlkesSatuan', 'item_template_id', 'id')->whereNull('ok_transaksi_id');
	}

	public function cssd_stok_sedang_digunakan()
	{
		return $this->hasMany('App\Models\CSSD\AlkesSatuan', 'item_template_id', 'id')->whereNotNull('ok_transaksi_id');
	}


	public function cssd_alkes_satuan_count()
	{
		return $this->hasMany('App\Models\CSSD\AlkesSatuan', 'item_template_id', 'id')->count();
	}

	public function cssd_stok_total_count()
	{
		return $this->hasMany('App\Models\CSSD\AlkesSatuan', 'item_template_id', 'id')->count();
	}

	public function cssd_stok_siap_pakai_count()
	{
		return $this->hasMany('App\Models\CSSD\AlkesSatuan', 'item_template_id', 'id')->whereNull('ok_transaksi_id')->count();
	}

	public function cssd_stok_sedang_digunakan_count()
	{
		return $this->hasMany('App\Models\CSSD\AlkesSatuan', 'item_template_id', 'id')->whereNotNull('ok_transaksi_id')->count();
	}

	public function getCssdHasIneffectiveItemAttribute()
	{
		$count = AlkesSatuan::where('item_template_id',$this->id)->where('jumlah_pemakaian','>=',$this->max_pemakaian)->count();
		if($count > 0) return 1;
		else return 0;
	}

	function bahan_aktif() {
		return $this->hasOne(\App\Models\Farmasi\MasterBahanAktif::class, 'id', 'bahan_aktif_id')->withTrashed();
	}

	public function kode_bidang()
	{
		return $this->hasOne(\App\Models\Farmasi\MasterKodeBidang::class, 'id', 'kode_bidang_id')->withTrashed();
	}

	public function satuan_kekuatan() {
		return $this->hasOne('App\Models\Farmasi\MasterSatuanKekuatan', 'id', 'satuan_kekuatan_id');
  	}

	public function rute() {
		return $this->hasOne('App\Models\Farmasi\MasterRute', 'id', 'rute_id');
  	}

	public function kelas_terapi() {
		return $this->hasOne('App\Models\Farmasi\Kategori', 'id', 'kelas_terapi_id');
	}

	# usage : attr_is_obat_high_alert
	public function getAttrIsObatHighAlertAttribute()
	{
		foreach ($this->kategori_item as $kategori_item) {
			if ($kategori_item->detail_kategori->nama == 'Obat High Alert') {
				return true;
			}
		}
		return false;	
	}
}
