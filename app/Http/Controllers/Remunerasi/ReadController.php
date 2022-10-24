<?php

namespace App\Http\Controllers\Remunerasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Pegawai;


class ReadController extends Controller
{

	public function getPegawai(Request $request) {
        
        $search = preg_replace("/[^[:alnum:][:space:]]/u", '', $request->keyword);
        
        $pegawai = Pegawai::where('name', 'like', '%' . $search . '%')->paginate(10);
               
        $data = [];
        foreach($pegawai as $row){
         
            $data[] = [
                "id" => $row->id,
                "text" => $row->name,
            ];
        }

        return json_encode($data);
        
    }

}