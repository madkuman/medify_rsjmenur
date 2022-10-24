<?php

namespace App\Models\Aset;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes; // <-- This is required

class ItemsTemplate extends Model
{
    use DataLogger;
    //
    use SoftDeletes;

    protected $table = 'items_template';
    protected $connection = 'aset';

    protected $fillable = [
        'name',
        'description',
        'merk',
        'model',
        'satuan',
        'image_ori',
        'image_thumb',
        'slug',
        'price',

        'users_id'
    ];

    public function user() {
        return $this->belongsTo('App\User','users_id');
    }

    public function category() {
        return $this->belongsToMany('App\Models\Aset\Category');
    }

    public function items() {
        return $this->hasMany('App\Models\Aset\Items');
    }

}
