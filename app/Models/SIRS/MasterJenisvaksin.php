<?php

namespace App\Models\SIRS;

use Illuminate\Database\Eloquent\Model;

class MasterJenisvaksin extends Model
{
    protected $connection = 'sirs';
    protected $table = 'master_jenisvaksin';
}
