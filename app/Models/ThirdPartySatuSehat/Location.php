<?php

namespace App\Models\ThirdPartySatuSehat;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $connection = 'satusehat';
    protected $table = 'location';
}
