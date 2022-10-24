<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormHasil extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'kasus';
	protected $table = 'form_hasil';


	public function form() {
		return $this->hasOne('App\Models\Kasus\Form', 'id', 'form_id')->orderBy('created_at','desc');
	}

	
    public function creator() {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

}
