<?php

namespace App\Models\ThirdPartySatuSehat;

use Illuminate\Database\Eloquent\Model;

class Practitioner extends Model
{
    protected $connection = 'satusehat';
    protected $table = 'practitioner';
}
