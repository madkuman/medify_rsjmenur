<?php

namespace App\Models\ThirdPartySatuSehat;

use Illuminate\Database\Eloquent\Model;

class LogBundle extends Model
{
    protected $connection = 'satusehat';
    protected $table = 'log_bundle';
}
