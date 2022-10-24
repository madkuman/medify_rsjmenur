<?php

namespace App\Models\LabPK;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class MikrobiologiSpesimenKategori extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'lab_pk';
	protected $table = 'mikrobiologi_spesimen_kategori';


	public function spesimen()
	{
		return $this->hasMany('App\Models\LabPK\MikrobiologiSpesimen',  'mikrobiologi_spesimen_kategori_id','id');
	}
}
