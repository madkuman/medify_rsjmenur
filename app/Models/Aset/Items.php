<?php

namespace App\Models\Aset;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes; // <-- This is required

class Items extends Model
{
    use DataLogger;
    //
    use SoftDeletes;

    protected $table = 'items';
    protected $connection = 'aset';

    protected $fillable = [
        'items_template_id',
        'transaction_id',
        'image_ori',
        'image_thumb',
        'description',
        'location',
        'price',
        'status',
        'condition',

        'users_id'
    ];

    public function user() {
        return $this->belongsTo('App\User','users_id');
    }

    public function transaction() {
        return $this->belongsTo('App\Models\Aset\Transaction','transaction_id');
    }

    public function itemstemplate() {
        return $this->belongsTo('App\Models\Aset\ItemsTemplate','items_template_id')->withTrashed();
    }

    public function itemscondition() {
        return $this->belongsTo('App\Models\Aset\ItemsCondition','condition')->withTrashed();
    }

    public function itemsstatus() {
        return $this->belongsTo('App\Models\Aset\ItemsStatus','status')->withTrashed();
    }

}
