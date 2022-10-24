<?php

namespace App\Models\Aset;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes; // <-- This is required

class Transaction extends Model
{
    use DataLogger;
//
    protected $table = 'transaction';
    protected $connection = 'aset';

    protected $fillable = [
        'kode',
        'date',
        'total_price',
        'description',
        'json',
        'image_ori',

        'supplier_id',
        'users_id'
    ];

    public function user() {
        return $this->belongsTo('App\User','users_id');
    }
    public function supplier() {
        return $this->belongsTo('App\Models\Aset\Supplier','supplier_id')->withTrashed();
    }
}
