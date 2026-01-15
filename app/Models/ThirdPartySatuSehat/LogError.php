<?php

namespace App\Models\ThirdPartySatuSehat;

use Illuminate\Database\Eloquent\Model;

class LogError extends Model
{
    protected $connection = 'satusehat';
    protected $table = 'log_error';
}
