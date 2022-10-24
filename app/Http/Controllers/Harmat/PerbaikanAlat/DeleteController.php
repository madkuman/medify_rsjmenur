<?php

namespace App\Http\Controllers\Harmat\PerbaikanAlat;

use Illuminate\Http\Request;
use App\Models\Harmat\PerbaikanAlat;
use App\Http\Controllers\Controller;

class DeleteController extends Controller
{
    public function delete($id)
    {
    	$data = PerbaikanAlat::find($id);

    	$data->delete();
    }
}
