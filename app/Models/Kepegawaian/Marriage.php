<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Marriage extends Model
{
	use DataLogger;
	use SoftDeletes;
	
  protected $connection = 'kepegawaian';
	protected $table = 'marriages';

	protected $fillable = [
		'status',
		'total_child',
		'marriage_certificate',
		'marriage_date',
		'marriage_place',
		'couple_job'
	];

	public function getMarriageDateFormattedAttribute() {
		setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
		if(is_null($this->marriage_date) || $this->marriage_date == '0000-00-00 00:00:00') {
			return '';
		}
		else{
			$dt = new Carbon($this->marriage_date);
			return $dt->formatLocalized('%d %B %Y');
		}
	}
}
