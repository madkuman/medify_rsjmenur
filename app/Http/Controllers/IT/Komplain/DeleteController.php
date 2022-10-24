<?php

namespace App\Http\Controllers\IT\Komplain;

use App\Models\IT\Komplain;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeleteController extends Controller
{
    public function delete($id)
    {
    	$data = Komplain::find($id);

    	$data->delete();
    }
}
