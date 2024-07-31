<?php

namespace App\Http\Controllers\Kasus\Gizi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\GiziPermintaan;

class DeleteController extends Controller
{
    public function permintaan($request)
    {
        $order = GiziPermintaan::find($request->permintaan_id);
        if (!empty($order->pemesanan_detail)) {
            return 'Permintaan sudah masuk dalam pemesanan';
        }

        $order->delete();

        return $order;
    }
}
