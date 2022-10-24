<?php

namespace App\Http\Controllers\Admin\TNIPangkat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\TNIPangkat;

class DeleteController extends Controller
{
    public function delete($id)
    {
        $pangkat = TNIPangkat::find($id);
        $pangkat->delete();
        return;
    }
}