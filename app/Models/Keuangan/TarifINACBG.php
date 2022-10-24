<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use ScoutElastic\Searchable;

class TarifINACBG extends Model
{
	use DataLogger;
	use SoftDeletes;

	protected $connection = 'keuangan';
	protected $table = 'tarif_inacbg';

    public function tarif_kategori_inacbg()
    {
        return $this->hasOne('App\Models\Keuangan\TarifKategoriINACBG', 'id', 'tarif_kategori_inacbg_id');
    }

    public function tarif()
    {
        return $this->hasOne('App\Models\Keuangan\Tarif', 'id', 'tarif_id');
    }

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