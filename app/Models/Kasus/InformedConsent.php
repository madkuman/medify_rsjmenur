<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InformedConsent extends Model
{
    use SoftDeletes;
    protected $connection = "kasus";
    protected $table = "informed_consent";
    
    public function setJenisInformasiAttribute($value)
    {
    	$this->attributes['jenis_informasi'] = json_encode($value);
    }

    public function setIsiInformasiAttribute($value)
    {
    	$this->attributes['isi_informasi'] = json_encode($value);
    }

    public function getJenisInformasiAttribute($value)
    {
    	return json_decode($this->attributes['jenis_informasi']);
    }

    public function getIsiInformasiAttribute($value)
    {
    	return json_decode($this->attributes['isi_informasi']);
    }
}