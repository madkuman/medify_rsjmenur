<?php
if (file_exists(base_path('/settings/medify/mutu.json'))) {
    $data_string = file_get_contents(base_path('/settings/medify/mutu.json'));
    if (isJson($data_string))
        $data = json_decode($data_string);
    else
        $data = new stdClass;
} else
    $data = new stdClass;

return [
    'laporan_rawat_jalan_persentase_ketepatan_waktu_pelayanan_rawat_jalan' => [
        'jangka_waktu' => $data->laporan_rawat_jalan_persentase_ketepatan_waktu_pelayanan_rawat_jalan->jangka_waktu ?? 30000,
    ],
    'laporan_igd_ketepatan_waktu_pelayanan_igd' => [
        'jangka_waktu' => $data->laporan_igd_ketepatan_waktu_pelayanan_igd->jangka_waktu ?? 30000,
    ],
];
