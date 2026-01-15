<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
//use Laravel\Scout\Searchable;
use ScoutElastic\Searchable;
// use Illuminate\Database\Eloquent\SoftDeletes;

class UserMedify extends Model
{
  use DataLogger;
  use Searchable;

  protected $connection = 'users';
  protected $table = 'users';
  protected $indexConfigurator = \App\IndexConfig\UsersMedify::class;

  protected $mapping = [
    'properties' => [
      'name' => [
        'type' => 'text',
        "analyzer" => "partial",
        "search_analyzer" => "partial"
      ],
      'email' => [
        'type' => 'text',
        "analyzer" => "partial",
        "search_analyzer" => "partial"
      ]
    ]
  ];



  public function toSearchableArray()
  {
    return [
      'name' => $this->name,
      'email' => $this->email
    ];
  }

  public function searchableAs()
  {
    return 'users';
  }

  public function pegawai()
  {
    return $this->hasMany('App\Models\Kepegawaian\Pegawai', 'id', 'user_id');
  }

  public function profesi_detail()
  {
    return $this->hasOne('App\Models\Hospital\Profesi', 'id', 'profesi');
  }
}
