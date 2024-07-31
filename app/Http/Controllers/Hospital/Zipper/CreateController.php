<?php

namespace App\Http\Controllers\Hospital\Zipper;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\Zipper;
use App\Models\Hospital\ZipperDetail;

class CreateController extends Controller
{
    function create($slug, $param, $zipper_detail = [])
    {
        $zipper = new Zipper();
        $zipper->slug = $slug;
        $zipper->param = json_encode($param);
        $zipper->status = 0;
        $zipper->percentage = 0;
        $zipper->created_by = auth()->id() ?? 1;
        $zipper->save();

        if (count($zipper_detail) != 0) {
            $set = [];
            foreach ($zipper_detail as $item) {
                $row = [
                    'zipper_id' => $zipper->id,
                    'referensi_id' => $item['referensi_id'],
                ];
                if (isset($item['data'])) {
                    $row['data'] = json_encode($item['data']);
                }
                $set[] = $row;
            }

            foreach (array_chunk($set, 500) as $chunk) {
                ZipperDetail::insert($set);
            }
        }

        return $zipper;
    }
}
