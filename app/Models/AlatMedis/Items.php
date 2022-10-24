<?php

namespace App\Models\AlatMedis;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes; // <-- This is required

class Items extends Model
{
    use DataLogger;
    //
    use SoftDeletes;

    protected $table = 'items';
    protected $connection = 'alat_medis';

    protected $fillable = [
        'no_items',
        'items_template_id',
        'kasus_id',
        'image_ori',
        'image_thumb',
        'description',
        'location',
        'status',

        'users_id'
    ];
    public function itemstemplate() {
        return $this->belongsTo('App\Models\AlatMedis\ItemsTemplate','items_template_id')->withTrashed();
    }
    public function user() {
        return $this->belongsTo('App\User','created_by');
    }
    public function transaksi() {
        return $this->hasMany('App\Models\Kasus\TransaksiAlatMedis','item_id');
    }
}
