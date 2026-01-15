<?php

namespace App\Models\ThirdParty;

use Illuminate\Database\Eloquent\Model;

class LogSatuSehatAuth extends Model
{
    protected $connection = 'thirdp';
    protected $table = 'log_satusehat_auth';
}
