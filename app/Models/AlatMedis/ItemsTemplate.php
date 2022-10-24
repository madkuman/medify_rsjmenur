<?php

namespace App\Models\AlatMedis;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemsTemplate extends Model
{
    use DataLogger;
    //
    use SoftDeletes;

    protected $table = 'items_template';
    protected $connection = 'alat_medis';

    protected $fillable = [
        'name',
        'description',
        'merk',
        'model',
        'image_ori',
        'image_thumb',
        'slug',

        'created_by'
    ];

    public function user() {
        return $this->belongsTo('App\User','users_id');
    }

    public function itemAlatMedis()
    {
        return $this->hasMany('App\Models\AlatMedis\Items');
    }
}
