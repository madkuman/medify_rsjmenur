<?php

namespace App\Models\RawatInap;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;


class ToiLog extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'rawatinap';
	protected $table = 'toi_log';
	protected $dates = ['pasien_akhir_krs_at','pasien_baru_mrs_at','deleted_at'];
}
