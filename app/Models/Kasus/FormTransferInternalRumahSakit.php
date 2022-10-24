<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormTransferInternalRumahSakit extends Model
{
    protected $connection = "kasus";
    protected $table = "form_transfer_internal_rumah_sakit";
    use SoftDeletes;

    public function creator() {
        return $this->hasOne("App\User", "id", "created_by");
    }
    public function updater() {
        return $this->hasOne("App\User", "id", "updated_by");
    }
    public function penerima() {
        return $this->hasOne("App\User", "id", "terima_by");
    }
    
}