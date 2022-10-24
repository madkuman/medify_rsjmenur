<?php

namespace App\Models\SIRS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class APIList extends Model
{
    use SoftDeletes;
    protected $connection = 'sirs';
    protected $table = 'api_list';
}
