<?php

namespace App\Models\LabPK;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class MikrobiologiSpesimen extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'lab_pk';
	protected $table = 'mikrobiologi_spesimen';


	public function kategori()
	{
		return $this->hasOne('App\Models\LabPK\MikrobiologiSpesimenKategori', 'id', 'mikrobiologi_spesimen_kategori_id');
	}
}
