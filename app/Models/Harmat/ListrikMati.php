<?php

namespace App\Models\Harmat;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes; // <-- This is required

class ListrikMati extends Model
{
	use DataLogger;
    use SoftDeletes;

    protected $table = 'listrik_mati';
    protected $connection = 'harmat';

    protected $fillable = [
        'mati_at',
        'nyala_at',
        'keterangan',

        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function user() {
        return $this->belongsTo('App\User','users_id');
    }
}
