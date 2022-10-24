<?php

namespace App\Http\Controllers\Admin\TNIPangkatJenjang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\TNIPangkatJenjang;

class DeleteController extends Controller
{
    public function delete($id)
    {
        $jenjang = TNIPangkatJenjang::find($id);
        $jenjang->delete();
        return;
    }
}