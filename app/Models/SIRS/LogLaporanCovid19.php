<?php

namespace App\Models\SIRS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogLaporanCovid19 extends Model
{
    use SoftDeletes;
    protected $connection = 'sirs';
    protected $table = 'log_laporan_covid_19';
}
