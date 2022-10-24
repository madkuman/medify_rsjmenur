<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MutuIndikator extends Model
{
    protected $connection = "kasus";
    protected $table = "mutu_indikator";
    use SoftDeletes;
}
