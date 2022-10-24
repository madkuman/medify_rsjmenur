<?php

namespace App\Http\Controllers\Admin\TNIKorps;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\TNIKorps;

class DeleteController extends Controller
{
    public function delete($id)
    {
        $korps = TNIKorps::find($id);
        $korps->delete();
        return;
    }
}