<?php

namespace App\Http\Controllers\Farmasi\Screen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\ScreenAntrian;

class DeleteController extends Controller
{
    public function delete($data)
    {
        $screen = ScreenAntrian::find($data->screen_id);
        $screen->delete();
    }
}
