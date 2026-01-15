<?php

namespace App\Http\Controllers\Kasus\Asesmen\FormSkriningManajerPelayananPasien;

use App\Http\Controllers\Controller;
use App\Models\Kasus\AlatBantu;

class ReadController extends Controller
{
    public function get($kasus_id, $type)
    {
        $asesmen = AlatBantu::with('creator:id,name,avatar_thumb')
            ->where(['kasus_id' => $kasus_id, 'type' => $type])
            ->orderBy('id', 'desc')
            ->get()
            ->each(function ($item) {
                $item->val = !empty($item->val) ? json_decode($item->val, true) : $item->val;
            });

        return $asesmen;
    }

    public function find($id)
    {
        $asesmen = AlatBantu::findOrFail($id);
        return $asesmen;
    }
}
