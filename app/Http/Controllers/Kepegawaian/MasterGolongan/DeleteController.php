<?php

namespace App\Http\Controllers\Kepegawaian\MasterGolongan;

use App\Models\Kepegawaian\MasterGolongan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeleteController extends Controller
{
    public function delete($id)
    {
        $golongan = MasterGolongan::find($id);
        $golongan->delete();
    }
}
