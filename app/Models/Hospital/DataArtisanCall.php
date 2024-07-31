<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataArtisanCall extends Model
{
    use SoftDeletes;
    protected $connection = 'mysql';
	protected $table = 'data_artisan_call';

    public function creator()
    {
        return $this->hasOne('App\User', 'id', 'created_by');
    }
}
