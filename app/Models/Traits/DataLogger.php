<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Model;

trait DataLogger
{
	public static function boot()
    {
        parent::boot();

        self::updating(function($model){
            $original = json_encode($model->getOriginal());
            app('App\Http\Controllers\Hospital\DataLog\CreateController')->create($model->connection,$model->table,$model->id,$original,'update');
        });

        self::deleting(function($model){
            $original = json_encode($model->toArray());
            app('App\Http\Controllers\Hospital\DataLog\CreateController')->create($model->connection,$model->table,$model->id,$original,'delete');
        });
    }
}
