<?php

namespace App\Models\Aset;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes; // <-- This is required

class Supplier extends Model
{
    use DataLogger;
    //
    use SoftDeletes;

    protected $table = 'supplier';
    protected $connection = 'aset';

    protected $fillable = [
        'name_perusahaan',
        'phone_perusahaan',
        'address_perusahaan',
        'npwp',

        'name_perwakilan',
        'phone_perwakilan',
        'description',

        'users_id'
    ];

    public function user() {
        return $this->belongsTo('App\User','users_id');
    }
}
