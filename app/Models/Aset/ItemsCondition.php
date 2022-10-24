<?php

namespace App\Models\Aset;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes; // <-- This is required

class ItemsCondition extends Model
{
    use DataLogger;
    //
    protected $table = 'items_condition';
    protected $connection = 'aset';

    use Softdeletes;

    protected $fillable = [
        'name',
    ];

    public function item()
    {
    	return $this->hasOne('App\Models\Aset\items', 'condition', 'id');
    }
}
