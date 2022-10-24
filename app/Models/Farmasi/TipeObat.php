<?php

namespace App\Models\Farmasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class TipeObat extends Model
{
	use DataLogger;
    use SoftDeletes;
    //use Searchable;

    protected $connection = 'farmasi';
    protected $table = 'tipe_obat';

}
