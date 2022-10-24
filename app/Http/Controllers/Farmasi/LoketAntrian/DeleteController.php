<?php

namespace App\Http\Controllers\Farmasi\LoketAntrian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\LoketAntrian;
use Illuminate\Support\Facades\Auth;

class DeleteController extends Controller
{
    public function delete($data)
    {
        $loket = LoketAntrian::find($data->id);
        $loket->deleted_by = Auth::user()->id;
        $loket->save();
        $loket->delete();
    }
}
