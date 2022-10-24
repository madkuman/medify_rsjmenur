<?php

namespace App\Models\LabPK;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hasil extends Model
{
	use DataLogger;

    use SoftDeletes;
    protected $connection = 'lab_pk';
    protected $table = 'hasil';

	public function transaksi()
	{
		return $this->hasOne('App\Models\LabPK\Transaksi', 'id', 'transaksi_id');
	}
	
    public function creator() {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function updater() {
        return $this->hasOne('App\User', 'id', 'updated_by');    	
    }
}