<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Berkas extends Model
{
  use SoftDeletes;

  protected $connection = 'kepegawaian';
  protected $table = 'berkas';

  protected $fillable = [
    'filename',
    'mime',
    'path',
    'size'
  ];

  public function pegawai()
	{
		return $this->hasOne('App\Models\Kepegawaian\Pegawai');
	}


  
}
	