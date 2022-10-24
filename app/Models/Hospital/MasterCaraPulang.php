<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use ScoutElastic\Searchable;

class MasterCaraPulang extends Model
{
	use DataLogger;
	use SoftDeletes;

	protected $connection = 'mysql';
	protected $table = 'master_cara_pulang';

    public function inacbg()
    {
        return $this->hasOne('App\Models\Hospital\MasterCaraPulangINACBG', 'id', 'cara_pulang_inacbg_id');
    }

    public function slug_mapping()
    {
        return $this->hasOne('App\Models\Hospital\MasterCaraPulangSlug', 'slug', 'slug');
    }

	public function creator()
    {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function editor()
    {
        return $this->hasOne('App\User', 'id', 'updated_by');
    }

    public function deletor()
    {
        return $this->hasOne('App\User', 'id', 'deleted_by');
    }
}