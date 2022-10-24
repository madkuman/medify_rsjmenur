<?php

namespace App\Models\LabPK;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dokumen extends Model
{
	use DataLogger;
    use SoftDeletes;
    protected $connection = 'lab_pk';
    protected $table = 'dokumen';

    public function creator() {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function updater() {
        return $this->hasOne('App\User', 'id', 'updated_by');    	
    }


    public function transaksi_detail() {
        return $this->hasOne('App\Models\LabPK\TransaksiDetail','dokumen_id','id');
    }

    public function penunjang() {
    	return $this->hasOne('App\Models\Kasus\Penunjang', 'id', 'penunjang_id');
    }
}