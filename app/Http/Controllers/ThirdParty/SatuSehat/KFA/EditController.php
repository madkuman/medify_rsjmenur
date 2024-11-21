<?php

namespace App\Http\Controllers\ThirdParty\SatuSehat\KFA;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\ItemsTemplate;
use App\Models\Farmasi\KodeKfaDetail;

class EditController extends Controller
{
    public function updateItemTemplate(Request $request)
    {
        // Validasi request
        $request->validate([
            'kfa_code' => 'required|string'
        ]);

        $kfa_code = $request->input('kfa_code');
        $item_template_id = $request->input('item_template_id');

        //Simpan detail product ke tabel
        $result = app(\App\Http\Controllers\ThirdParty\SatuSehat\KFA\ReadController::class)->getProductDetail($kfa_code);
        // dd($result);
        $product_decoded = json_decode($result);
        $product_detail = $product_decoded->result;
        // dd($product_detail);

        $data = [
            'kode_kfa' => $product_detail->kfa_code
        ];

        $valuesToUpdateOrCreate = [
            'name' => $product_detail->name,
            'active' => $product_detail->active,
            'ucum' => $product_detail->ucum->cs_code,
            'uom' => $product_detail->uom->name,
            'nie' => $product_detail->nie,
            'manufacturer' => $product_detail->manufacturer,
            'generik' => $product_detail->generik,
            'fix_price' => $product_detail->fix_price,
            'het_price' => $product_detail->het_price,
            'nama_dagang' => $product_detail->nama_dagang,
            'kode_kfa_92' => $product_detail->product_template->kfa_code,
            'value' => $product_detail
        ];

        $item = KodeKfaDetail::updateOrCreate($data, $valuesToUpdateOrCreate);

        // Cari dan update kode KFA di tabel item_template
        $barang = ItemsTemplate::find($item_template_id);
        $barang->kode_kfa = $kfa_code;
        $barang->save();

        return response()->json(['message' => 'Kode KFA berhasil disimpan.']);
    }
}
