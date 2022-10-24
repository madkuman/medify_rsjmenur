<?php

namespace App\Http\Controllers\Eusulan\Usulan;

use App\Models\Eusulan\Usulan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class DeleteController extends Controller
{
    function delete($id)
    {
        $usulan = Usulan::find($id);
        if($usulan) {
            $usulan->deleted_by = Auth::user()->id;
            $usulan->save();
            foreach ($usulan->detail as $item){
                $item->deleted_by = Auth::user()->id;
                $item->save();
                $item->delete();
            }
            $usulan->delete();
        }
    }
}
