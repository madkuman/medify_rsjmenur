<?php

namespace App\Models\ThirdParty;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Log extends Model
{
    protected $connection = 'thirdp';
    protected $table      = 'log';

    public function creator()
    {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function getCreatedAtAttributes()
    {
        return Carbon::parse($this->attributes['created_at'])->forat('d-m-Y H:i:s');
    }
}
