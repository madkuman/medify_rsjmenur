<?php
if (file_exists(base_path('/settings/medify/pasien.json'))) {
    $data_string = file_get_contents(base_path('/settings/medify/pasien.json'));
    if (isJson($data_string))
        $data = json_decode($data_string);
    else
        $data = new stdClass;
} else
    $data = new stdClass;

return [
    'dkk_34_laporan_bulanan_diare' => [
        'zinc' => $data->dkk_34_laporan_bulanan_diare->zinc ?? [],
        'oralit' => $data->dkk_34_laporan_bulanan_diare->oralit ?? [],
        'rl' => $data->dkk_34_laporan_bulanan_diare->rl ?? [],
    ],
];
