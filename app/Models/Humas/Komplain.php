<?php

namespace App\Models\Humas;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Komplain extends Model
{
	use DataLogger;
    use SoftDeletes;
    protected $connection = 'humas';
	protected $table = 'komplain';
    protected $dates = ['deleted_at'];
}
