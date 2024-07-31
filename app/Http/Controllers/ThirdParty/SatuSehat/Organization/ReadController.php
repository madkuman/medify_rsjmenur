<?php

namespace App\Http\Controllers\ThirdParty\SatuSehat\Organization;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ThirdPartySatuSehat\Organization;

class ReadController extends Controller
{
    public function getOrganization()
    {
        $id = config('medify.third-party.satusehat.organization_id');
        $org = Organization::where('satusehat_id', $id)->first();
        if (!empty($org)) {
            return $org->response;
        }

        $ss_org = (new \App\Http\Controllers\ThirdParty\SatuSehat\Organization\PostController)->getById(new Request());
        return $ss_org;
    }
}
