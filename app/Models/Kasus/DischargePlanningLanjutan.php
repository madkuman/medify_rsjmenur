<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class DischargePlanningLanjutan extends Model
{
	use DataLogger;
    protected $connection = "kasus";
    protected $table = "discharge_planning_lanjutan";
    use SoftDeletes;

    public function creator() {
        return $this->hasOne("App\User", "id", "created_by");
    }
    
}