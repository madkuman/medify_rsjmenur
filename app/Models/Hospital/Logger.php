<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Model;

class Logger extends Model
{
	protected $connection = 'mysql';
	protected $table = 'logger';

    protected $casts = [
        'param' => 'array',
        'data' => 'array',
    ];
}
