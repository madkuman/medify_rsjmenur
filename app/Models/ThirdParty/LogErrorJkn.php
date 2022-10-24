<?php

namespace App\Models\ThirdParty;

use Illuminate\Database\Eloquent\Model;

class LogErrorJkn extends Model
{
    protected $connection = 'thirdp';
    protected $table = 'log_error_jkn';
}
