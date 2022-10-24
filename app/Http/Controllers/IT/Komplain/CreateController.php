<?php

namespace App\Http\Controllers\IT\Komplain;

use Auth;
use App\Models\IT\Komplain;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CreateController extends Controller
{
    protected $model; 

    function __construct()
    {
        $this->model = new Komplain;
    }

    public function store($data)
    {
    	$komp = new Komplain;
        $komp->waktu_komplain = $data['waktu_komplain'];
        $komp->lokasi = $data['lokasi'];
        $komp->pesan = $data['pesan'];
        $komp->created_by = Auth::user()->id;

        if($data['image'])
        {
            $image_path = [];
            foreach ($data['image'] as $item)
            {
                $image = app('App\Http\Controllers\Functions\ImageUploader')->upload($item,'it');
                $image_path[] = $image['file_original'];
            }
            $komp->image_paths = json_encode($image_path);

        }
                
        $komp->save();
    }
}
