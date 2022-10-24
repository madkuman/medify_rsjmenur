<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use ScoutElastic\Searchable;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\MailResetPasswordToken;
use App\Models\Traits\DataLogger;



class User extends Authenticatable
{
    use Searchable;
    use HasRoles;
    use DataLogger;

    protected $connection = 'mysql';
    protected $table = 'users';
    
    use Notifiable;
    
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','slug'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $indexConfigurator = \App\IndexConfig\UserHospital::class;
    protected $searchRule = \App\SearchRule\User::class;
    protected $mapping = [
        'properties' => [
            'name' => [
                "type" => "text",
                "analyzer" => "partial",
                "search_analyzer" => "exact"
            ]
        ]
    ];

    public function toSearchableArray()
    {
        return $this->toArray();
    }
    public function profesi_detail() {
        return $this->hasOne('App\Models\Hospital\Profesi', 'id', 'profesi');
    }

    public function specialty_detail() {
        return $this->hasOne('App\Models\Hospital\Spesialisasi', 'id', 'specialty');
    }

    public function usergroup(){
        return $this->hasMany('App\Models\Hospital\UserGroup', 'id', 'group_id');
    }

    public function user_profile_public_settings(){
        return $this->hasOne('App\Models\Hospital\UserProfilePublic', 'users_id', 'id');
    }

    public function pendidikan(){
        return $this->hasMany('App\Models\Hospital\UserPendidikan', 'users_id', 'id')->select(['institusi', 'departemen', 'tahun_masuk','tahun_tamat']);
    }
    public function employee() {
        return $this->hasOne('App\Models\Kepegawaian\Pegawai', 'id', 'employee_id');
    }
    public function pelatihan(){
        return $this->hasMany('App\Models\Hospital\UserPelatihan', 'users_id', 'id')->select(['nama', 'tempat', 'tahun']);
    }
    public function karya(){
        return $this->hasMany('App\Models\Hospital\UserKarya', 'users_id', 'id')->select(['judul', 'jenis_karya', 'publikasi','tahun']);
    }
    public function skill(){
        return $this->hasMany('App\Models\Hospital\UserSkill', 'users_id', 'id')->select(['skill']);
    }
    public function jadwal(){
        return $this->hasMany('App\Models\RawatJalan\DokterJadwal', 'dokter_id', 'dokter_id')->orderBy('poliklinik_id','asc');
    }
    public function kolaborator(){
        return $this->hasMany('App\Models\Kasus\Kolaborator', 'user_id', 'id');
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPasswordToken($token));
    }
    public function dokter(){
        return $this->hasOne('App\Models\RawatJalan\Dokter', 'id', 'dokter_id');
    }
    public function dokumenEsakip()
    {
        return $this->hasMany('App\Models\Esakip\Dokumen', 'user_id', 'id');
    }

    public function hak_akses()
    {
        return $this->hasMany('App\Models\Hospital\HakAksesUsers', 'user_id', 'id');
    }
}
