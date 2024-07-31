<?php

namespace App\Models\Farmasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class AturanEmbalase extends Model
{
	use DataLogger;
    use SoftDeletes;

    protected $connection = 'farmasi';
    protected $table = 'aturan_embalase';
    protected $appends = ['group_key'];

    public function detail_farmasi() {
  	  return $this->hasOne('App\Models\Farmasi\Farmasi', 'id', 'farmasi_id');
    }

    public function getGroupKeyAttribute()
    {
        return $this->perusahaan_tipe_id.'-'.$this->tipe_obat_id;
    }
}
