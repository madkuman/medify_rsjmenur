<?php

namespace App\Http\Controllers\Keuangan\PaketPemasukan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\PaketPemasukan;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

class EditController extends Controller
{
    public function updateFromChild($paket)
    {
        if(count($paket->detail) == 0)
        {
            $paket->delete();
        }
        else
        {
            $total = 0;
            foreach($paket->detail as $d)
            {
                $total += $d->total;
            }
            $paket->total = $total;
            $paket->save();
        }
    }

}