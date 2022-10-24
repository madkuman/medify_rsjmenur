<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemAlatMedis extends Model
{
	use DataLogger;
    use SoftDeletes;

    protected $table = 'items';
    protected $connection = 'alat_medis';

    public function user() {
        return $this->belongsTo('App\User','users_id');
    }

    public function itemsTemplate()
    {
        return $this->belongsTo('App\Models\AlatMedis\ItemsTemplate');
    }

    public function transaksiAlatMedis()
    {
        return $this->hasMany('App\Models\Kasus\TransaksiAlatMedis', 'item_id');
    }

}
