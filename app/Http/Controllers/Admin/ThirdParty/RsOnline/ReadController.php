<?php

namespace App\Http\Controllers\Admin\ThirdParty\RsOnline;

use App\Http\Controllers\Controller;
use App\Models\Online\Informasi;

class ReadController extends Controller
{
    public function getBySlug($slug){
        return Informasi::where('slug', $slug)->first();
    }
}