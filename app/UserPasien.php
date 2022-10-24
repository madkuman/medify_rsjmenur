<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use ScoutElastic\Searchable;

class UserPasien extends Authenticatable
{   
    use Notifiable;   
    use Searchable;

    protected $connection = 'mysql';
    protected $table = 'users_pasien';

    protected $primaryKey = 'id';



    protected $indexConfigurator = \App\IndexConfig\UserHospitalPasien::class;
    protected $mapping = [
        'properties' => [
            'nama' => [
                "type" => "text",
                "analyzer" => "partial",
                "search_analyzer" => "exact"
            ],
            'email' => [
                'type' => 'text',
                "analyzer" => "partial",
                "search_analyzer" => "exact"
            ],
            'alamat' => [
                'type' => 'text',
                "analyzer" => "partial",
                "search_analyzer" => "exact"
            ],
            'ktp' => [
                'type' => 'text',
                "analyzer" => "partial",
                "search_analyzer" => "exact"
            ],
            'tanggal_lahir' => [
                'type' => 'text',
                "analyzer" => "partial",
                "search_analyzer" => "exact"
            ]
        ]
    ];

    public function toSearchableArray()
    {
    	return $this->toArray();
    }
 
}
