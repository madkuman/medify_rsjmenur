<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use ScoutElastic\Searchable;

class TarifKategoriINACBG extends Model
{
	use DataLogger;
	use SoftDeletes;

	protected $connection = 'keuangan';
	protected $table = 'tarif_kategori_inacbg';

	public function creator()
    {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function editor()
    {
        return $this->hasOne('App\User', 'id', 'updated_by');
    }

    public function deletor()
    {
        return $this->hasOne('App\User', 'id', 'deleted_by');
    }
}