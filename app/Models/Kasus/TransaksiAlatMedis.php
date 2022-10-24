<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransaksiAlatMedis extends Model
{
	use DataLogger;
    use SoftDeletes;

    protected $table = 'transaksi';
    protected $connection = 'alat_medis';

    protected $fillable = [
        'item_id',
        'kasus_id',

        'created_by'
    ];

    public function item() {
        return $this->belongsTo('App\Models\Kasus\ItemAlatMedis','item_id')->withTrashed();
    }
    public function user() {
        return $this->belongsTo('App\User','created_by');
    }
    public function kasus() {
        return $this->belongsTo('App\Models\Kasus\Kasus','kasus_id');
    }
}
