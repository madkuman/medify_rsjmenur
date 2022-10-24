<?php

namespace App\Models\Aset;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
    use DataLogger;
    use SoftDeletes;
    protected $table = 'category';
    protected $connection = 'aset';

    protected $fillable = [
        'slug',
        'name',
        'description',
        'users_id'
    ];

    public function user() {
        return $this->belongsTo('App\User','users_id');
    }

    public function itemstemplate() {
        return $this->belongsToMany('App\Models\Aset\ItemsTemplate');
    }

}
