<?php

namespace App\Http\Controllers\Gizi\Pengaturan\Diet;

use App\Models\Gizi\Diet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EditController extends Controller
{
    public function edit($request,$id)
    {
        $diet = Diet::where('id',$id)->first();
        $diet->nama =$request->nama;
        $diet->save();
    }
}
