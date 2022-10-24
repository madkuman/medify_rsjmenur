<?php

namespace App\Http\Controllers\Gizi\Pengaturan\Diet;

use App\Models\Gizi\Diet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeleteController extends Controller
{
    public function delete($id)
    {
        $diet = Diet::find($id);
        $diet->delete();
    }
}
