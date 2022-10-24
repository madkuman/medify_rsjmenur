<?php

namespace App\Models\Radiology;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class Photo extends Model
{
	use DataLogger;
    protected $connection = 'radiology';
    protected $table = 'photo';

    public function creator() {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function updater() {
        return $this->hasOne('App\User', 'id', 'updated_by');    	
    }

    public function penunjang() {
    	return $this->hasOne('App\Models\Kasus\Penunjang', 'id', 'penunjang_id');
    }
}