<?php

namespace App\Models\ThirdPartySatuSehat;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $connection = 'satusehat';
    protected $table = 'patient';
}
