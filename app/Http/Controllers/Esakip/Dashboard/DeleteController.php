<?php

namespace App\Http\Controllers\Esakip\Dashboard;

use App\Models\Esakip\Dokumen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeleteController extends Controller
{
    public function delete($id)
    {
        $dokumen=Dokumen::find($id);
        $dokumen->delete();
    }
}
