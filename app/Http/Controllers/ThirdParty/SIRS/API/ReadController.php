<?php

namespace App\Http\Controllers\ThirdParty\SIRS\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SIRS\APIList;

class ReadController extends Controller
{
    public function getAPIBySlug($api_slug)
    {
        $api = APIList::where('slug', $api_slug)->first();
        return $api;
    }

    public function getAPIData($api_slug, $page = 1, $limit = 1000)
    {
        $data['page'] = $page;
        $data['limit'] = $limit;
        $result = app(\App\Http\Controllers\ThirdParty\SIRS\API\RequestController::class)->requestAPI($api_slug, $data);
        if ($result['response']['status'] ?? false) {
            return collect($result['response']['data']);
        } else {
            return collect();
        }
    }

    public function getAutoSyncStatus()
    {
        $all_auto_sync = APIList::where('auto_sync', 1)->get();
        foreach ($all_auto_sync as $item) {
            if (!empty($item->kolom_values)) {
                $sync_attr = json_decode($item->kolom_values, true);
                $item->sync_row = \DB::connection($item->connection)->table($item->tabel)->whereNotNull($sync_attr['id'])->count();
            } else {
                $item->sync_row = \DB::connection($item->connection)->table($item->tabel)->count();
            }
        }
        return $all_auto_sync;
    }
}
