<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Carbon\Carbon;

class Log extends Model
{
	use DataLogger;
  	protected $connection = 'kasus';
	protected $table = 'log';
	protected $appends = ['tanggal'];

    public function creator() {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function getTanggalAttribute() {
        return  Carbon::parse($this->attributes['created_at'])->diffForHumans(Carbon::now(),true);
    }
}
