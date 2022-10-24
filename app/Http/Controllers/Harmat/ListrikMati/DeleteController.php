<?php

namespace App\Http\Controllers\Harmat\ListrikMati;

use Illuminate\Http\Request;
use App\Models\Harmat\ListrikMati;
use App\Http\Controllers\Controller;

class DeleteController extends Controller
{
    public function delete($id)
    {
    	$data = ListrikMati::find($id);

    	$data->delete();
    }
}
