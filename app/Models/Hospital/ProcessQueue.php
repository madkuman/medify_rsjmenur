<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Model;

class ProcessQueue extends Model
{
	protected $connection = 'mysql';
	protected $table = 'process_queue';

    protected $fillable = ['slug', 'payload', 'expired_at'];
}
