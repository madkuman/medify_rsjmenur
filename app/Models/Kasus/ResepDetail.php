<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\Models\Farmasi\AturanObat;

class ResepDetail extends Model
{
	use DataLogger;
	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $connection = 'kasus';
	protected $table = 'resep_detail';

	public function kasus_resep() {
        return $this->hasOne('App\Models\Kasus\Resep', 'id', 'kasus_resep_id');
    }
	public function racikan_detail() {
        return $this->hasMany('App\Models\Kasus\ResepRacikanDetail', 'resep_detail_id', 'id');
    }

    public function getExpectedReorderAtAttribute() {
    	$jumlah = (int)$this->attributes['jumlah'];
    	$aturan = $this->attributes['aturan'];

    	$usage_per_day = AturanObat::where('nama', $aturan)->pluck('usage_per_day')->first();
    	$created_date = Carbon::parse($this->attributes['created_at']);

		return $reorder = (!empty($usage_per_day)) ? $created_date->copy()->addDays((int)($jumlah/$usage_per_day)) : null;
	}

    public function item_template() {
        return $this->hasOne('App\Models\Farmasi\ItemsTemplate', 'id', 'obat_id');
    }
}
