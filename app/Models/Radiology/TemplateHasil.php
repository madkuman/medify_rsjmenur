<?php

namespace App\Models\Radiology;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class TemplateHasil extends Model
{
	use DataLogger;
    protected $connection = 'radiology';
    protected $table = 'template_hasil';

    public function tarif()
    {
        return $this->belongsTo('App\Models\Keuangan\TarifMaster', 'tarif_id')->withTrashed();
    }

    public function creator()
    {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

}