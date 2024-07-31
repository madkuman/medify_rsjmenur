<?php
if (file_exists(base_path('/settings/medify/rawatjalan.json'))) {
    $data_string = file_get_contents(base_path('/settings/medify/rawatjalan.json'));
    if (isJson($data_string))
        $data = json_decode($data_string);
    else
        $data = new stdClass;
} else
    $data = new stdClass;

return [
    'nomor_antrian' => [
        'per_dokter' => $data->nomor_antrian->per_dokter ?? 0,
    ],
    'auto_krs_dan_checkout' => [
        'auto_checkout' => $data->auto_krs_dan_checkout->auto_checkout ?? 0,
    ],
];
