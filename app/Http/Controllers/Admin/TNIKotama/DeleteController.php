<?php

namespace App\Http\Controllers\Admin\TNIKotama;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\TNIKotama;

class DeleteController extends Controller
{
    public function delete($id)
    {
        $korps = TNIKotama::find($id);
        $korps->delete();
        return;
    }
}
