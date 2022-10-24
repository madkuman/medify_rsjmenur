<?php

namespace App\Models\Esakip;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dokumen extends Model
{
	use DataLogger;
	protected $connection = 'esakip';
	protected $table = 'dokumen';

	use SoftDeletes;

    public function kategori() {
        return $this->hasOne('App\Models\Esakip\Kategori', 'id', 'kategori_id');
    }

    public function user() {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function creator() {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function verified_atasan() {
        return $this->hasOne('App\User', 'id', 'verified_by');
    }

    public function verified_admin() {
        return $this->hasOne('App\User', 'id', 'verified_admin_by');
    }

}
