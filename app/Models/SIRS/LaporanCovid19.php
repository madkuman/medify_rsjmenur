<?php

namespace App\Models\SIRS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LaporanCovid19 extends Model
{
    use SoftDeletes;
    protected $connection = 'sirs';
    protected $table = 'laporan_covid_19';
}
