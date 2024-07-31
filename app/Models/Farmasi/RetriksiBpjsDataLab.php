<?php

namespace App\Models\Farmasi;

use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RetriksiBpjsDataLab extends Model
{
    use DataLogger;
    protected $connection = 'farmasi';
    protected $table = 'retriksi_bpjs_data_lab';

    use SoftDeletes;

    public function item_template()
    {
        return $this->hasOne('App\Models\Farmasi\ItemsTemplate','id', 'item_template_id');
    }

    public function form()
    {
        return $this->hasOne('App\Models\LabPK\Form','id', 'form_id');
    }


}
