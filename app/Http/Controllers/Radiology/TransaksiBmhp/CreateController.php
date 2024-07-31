<?php

namespace App\Http\Controllers\Radiology\TransaksiBmhp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Radiology\TransaksiBmhp;
use Auth;

class CreateController extends Controller
{
    public function addData($bmhp_array,$transaksi_id)
    {
        $user_id = Auth::user()->id;
        TransaksiBmhp::where('transaksi_id',$transaksi_id)->update(['deleted_by' => $user_id]);
        TransaksiBmhp::where('transaksi_id',$transaksi_id)->delete();

        foreach($bmhp_array??[] as $item_template_index => $jumlah_item)
        {
            $data = new TransaksiBmhp();
            $data->transaksi_id = $transaksi_id;
            $data->item_template_id = $item_template_index;
            $data->jumlah = $jumlah_item;
            $data->created_by = $user_id;
            $data->save();
        }

        return 1;
    }
}
