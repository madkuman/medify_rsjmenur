<?php

namespace App\Models\LabPK;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class HasilTransfusi extends Model
{
	use DataLogger;
    protected $connection = 'lab_pk';
    protected $table = 'hasil_transfusi';

	public function transaksi()
	{
		return $this->hasOne('App\Models\LabPK\Transaksi', 'id', 'transaksi_id');
	}
	
    public function creator() {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

}