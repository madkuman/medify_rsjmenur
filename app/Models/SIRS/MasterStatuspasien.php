<?php

namespace App\Models\SIRS;

use Illuminate\Database\Eloquent\Model;

class MasterStatuspasien extends Model
{
    protected $connection = 'sirs';
    protected $table = 'master_statuspasien';
}
