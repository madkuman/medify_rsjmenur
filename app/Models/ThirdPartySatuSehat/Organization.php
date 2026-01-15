<?php

namespace App\Models\ThirdPartySatuSehat;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $connection = 'satusehat';
    protected $table = 'organization';
}
