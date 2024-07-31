<?php

namespace App\Http\Controllers\ThirdParty\SatuSehat\Location;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ThirdPartySatuSehat\Location;

class CreateController extends Controller
{
    public function getCreateParam(Request $request)
    {
        $get_org = app(\App\Http\Controllers\ThirdParty\SatuSehat\Organization\PostController::class)->getById($request);
        $get_org = json_decode($get_org, true);

        $params["resourceType"] = "Location";
        $params["identifier"] = [
            [
                "system" => "http://sys-ids.kemkes.go.id/location/1000001",
                "value" => ($request->identifier_value ?? "")
            ]
        ];
        $params["status"] = "active";
        $params["name"] = $request->name;
        $params["description"] = $request->description;
        $params["mode"] = "instance";
        $params["physicalType"] = [
            "coding" => [
                [
                    "system" => "http://terminology.hl7.org/CodeSystem/location-physical-type",
                    "code" => "ro",
                    "display" => "Room",
                ]
            ]
        ];
        $params["telecom"] = $get_org["contact"][0]["telecom"] ?? [];
        $params["address"] = $get_org["address"][0] ?? "";
        $params["position"] = [
            "longitude" => (float) config('app.longitude', ''),
            "latitude" => (float) config('app.latitude', ''),
            "altitude" => 0
        ];
        $params["managingOrganization"] = [
            "reference" => "Organization/".($get_org['id'] ?? "")
        ];

        return $params;
    }

    public function save($lokasi, $response_data)
    {
        $ss_location = Location::where('hospital_lokasi_id', $lokasi->id)->where('satusehat_id', $response_data->id)->first();
        if (empty($ss_location)) {
            $ss_location = new Location();
            $ss_location->hospital_lokasi_id = $lokasi->id;
            $ss_location->satusehat_id = $response_data->id ?? null;
            $ss_location->name = $response_data->name ?? null;
            $ss_location->description = $response_data->description ?? null;
            $ss_location->save();

            return $ss_location;
        }
        return $ss_location;
    }
}
