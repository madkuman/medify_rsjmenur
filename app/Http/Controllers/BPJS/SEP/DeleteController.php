<?php

namespace App\Http\Controllers\BPJS\SEP;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\BPJSSEP;

class DeleteController extends Controller
{
    public function delete($no_sep)
    {
    	$sep = BPJSSEP::where('no_sep', $no_sep)->orderBy('id', 'DESC')->first()->delete();
    }
}
