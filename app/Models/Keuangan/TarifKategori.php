<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use ScoutElastic\Searchable;

class  TarifKategori extends Model
{
	use DataLogger;
	use SoftDeletes;

	protected $connection = 'keuangan';
	protected $table = 'tarif_kategori';


	public function parent()
	{
		return $this->hasOne('App\Models\Keuangan\TarifKategori', 'id', 'parent_id');
	}
	public function children()
	{
		return $this->hasMany('App\Models\Keuangan\TarifKategori', 'parent_id', 'id');
	}

	public function getAncestorNameAttribute()
	{
		if($this->parent_id == 0 || !($this->parent instanceof TarifKategori)){
			return $this->nama;
		}else{
			return $this->nama." ".$this->parent->ancestor_name;
		}
	}
	public function departemen()
	{
		return $this->hasOne('App\Models\Keuangan\Departemen','id','departemen_id');
	}

	public function getAllAncestorNameAttribute()
	{
		$kategori_id = $this->id;
		$kategori = TarifKategori::find($kategori_id);
		$nama = $kategori->nama;
		while($kategori->parent_id != 0)
		{
			$kategori = TarifKategori::find($kategori->parent_id);
			$nama.= ' - '. $kategori->nama; 
		}

		return $nama;
	}
	
}