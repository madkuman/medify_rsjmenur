<?php

namespace App\Http\Controllers\K3\Logbook;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\K3\Logbook;

class ViewController extends Controller
{
    public function index()
    {
      if(session('has_k3_access'))
        return view('k3.index');
      else
        return redirect('/');
    }

    public function addPage()
    {
      if(session('has_k3_access'))      
        return view('k3.add-k3');
      else
        return redirect('/');
    }
}
