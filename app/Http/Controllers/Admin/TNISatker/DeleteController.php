<?php

namespace App\Http\Controllers\Admin\TNISatker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\TNISatker;

class DeleteController extends Controller
{
    public function delete($id)
    {
        $satker = TNISatker::find($id);
        $satker->delete();
        return;
    }
}