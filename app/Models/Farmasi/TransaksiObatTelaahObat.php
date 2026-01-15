<?php

namespace App\Models\Farmasi;

use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransaksiObatTelaahObat extends Model
{
	use SoftDeletes;

	protected $connection = 'farmasi';
	protected $table = 'transaksi_obat_telaah_obat';
    protected $dates = ['telaah_at'];

    function user_telaah()
    {
        return $this->hasOne(\App\User::class, 'id', 'telaah_by');
    }
}
