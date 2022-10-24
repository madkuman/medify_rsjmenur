<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class AlatEdukasiPasienDetail extends Model
{
	use DataLogger;
    protected $connection = 'kasus';
	protected $table = 'alat_edukasi_pasien_detail';

}
