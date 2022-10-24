<?php

namespace App\Http\Controllers\BPJS\RujukBalik;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ThirdParty\RujukBalik;

class DeleteController extends Controller
{
    public function delete($id)
    {
        $data = RujukBalik::find($id);
        $now = now();
        
        foreach($data->detail as $item){
            $item->deleted_at = $now;
            $item->save();
        }

        $data->deleted_at = $now;
        return $data->save();
    }
}
