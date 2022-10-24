<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use App\Models\Hospital\UserGroup;
use ScoutElastic\Searchable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Grup extends Model
{
	use DataLogger;
    use SoftDeletes;
	use Searchable;
    protected $connection = 'mysql';
	protected $table = 'group';
	protected $indexConfigurator = \App\IndexConfig\Grup::class;

	protected $mapping = [
        'properties' => [
            'name' => [
            	"type" => "text",
          		"analyzer" => "partial",
          		"search_analyzer" => "partial"
            ],
            'description' => [
            	"type" => "text",
          		"analyzer" => "partial",
          		"search_analyzer" => "partial"
            ],
        ]
    ];

    public function toSearchableArray()
    {
    	return $this->toArray();
    }



	public function recommended(){
		return $this->hasMany('App\Models\Hospital\RecommendedGroup');
	}

	public function usergroup(){
		return $this->hasMany('App\Models\Hospital\UserGroup', 'group_id', 'id');
	}

	public function post(){
		return $this->hasMany('App\Models\Hospital\GroupPost', 'group_id', 'id');
	}

    public function getMyRoleAttribute()
    {
        $getRole = UserGroup::where('users_id',Auth::user()->id)->where('group_id',$this->id)->first();
        return $getRole;
    }

    public function farmasi()
    {
    	return $this->hasOne('App\Models\Farmasi\Farmasi', 'group_id', 'id');
    }
}
