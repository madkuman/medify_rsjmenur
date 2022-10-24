<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class UserProfilePublic extends Model
{
	use DataLogger;
    protected $connection = 'mysql';
	protected $table = 'user_profile_public';
}
