<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class PenunjangKomentar extends Model
{
	use DataLogger;
  	protected $connection = 'kasus';
	protected $table = 'penunjang_komentar';

	public function penunjang() {
		return $this->belongsTo('App\Models\Kasus\Penunjang', 'id', 'penunjang_id');
	}
	
    public function creator() {
        return $this->hasOne('App\User', 'id', 'created_by');
    }
}