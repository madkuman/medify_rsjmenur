<?php

namespace App\Models\Online;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Carbon\Carbon;

class Informasi extends Model
{
	use DataLogger;
	protected $connection = 'online';
	protected $table = 'cms_information_page';
	
}
