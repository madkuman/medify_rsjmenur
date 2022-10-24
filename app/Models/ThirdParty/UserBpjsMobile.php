<?php

namespace App\Models\ThirdParty;

use Illuminate\Database\Eloquent\Model;

class UserBpjsMobile extends Model
{
    protected $connection = 'thirdp';
    protected $table = 'user_bpjs_mobile';
}
