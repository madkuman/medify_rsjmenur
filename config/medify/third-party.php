<?php
if (file_exists(base_path('/settings/medify/third-party.json'))) {
    $data_string = file_get_contents(base_path('/settings/medify/third-party.json'));
    if (isJson($data_string))
        $data = json_decode($data_string);
    else
        $data = new stdClass();
} else
    $data = new stdClass();

return [
    'sirs_v3' => [
        'on' => $data->sirs_v3->on ?? 0,
        'on_second_acc' => $data->sirs_v3->on_second_acc ?? 0,
        'url' => $data->sirs_v3->url ?? null,
        'id' => $data->sirs_v3->id ?? null,
        'password' => $data->sirs_v3->password ?? null,
        'second_acc_id' => $data->sirs_v3->second_acc_id ?? null,
        'second_acc_password' => $data->sirs_v3->second_acc_password ?? null,
        'second_acc_lokasi' => $data->sirs_v3->second_acc_lokasi ?? [],
    ],
    'jkn_online' => [
        'on' => $data->jkn_online->on ?? null,
        'url' => $data->jkn_online->url ?? null,
        'cons_id' => $data->jkn_online->cons_id ?? null,
        'cons_pwd' => $data->jkn_online->cons_pwd ?? null,
        'user_key' => $data->jkn_online->user_key ?? null,
        'pengali_waktu_tunggu_auto_taskid_5' => $data->jkn_online->pengali_waktu_tunggu_auto_taskid_5 ?? null,
    ],
    'vclaim' => [
        'on_v2' => $data->vclaim->on_v2 ?? null,
        'on_auto_finger' => $data->vclaim->on_auto_finger ?? null,
    ],
    'rs_online' => [
        'on' => $data->rs_online->on ?? null,
    ],
    'satusehat' => [
        'on' => $data->satusehat->on ?? 0,
        'stage' => $data->satusehat->stage ?? "development",
        'auth_url' => $data->satusehat->auth_url ?? "",
        'base_url' => $data->satusehat->base_url ?? "",
        'consent_url' => $data->satusehat->consent_url ?? "",
        'client_id' => $data->satusehat->client_id ?? null,
        'client_secret' => $data->satusehat->client_secret ?? null,
        'organization_id' => $data->satusehat->organization_id ?? null,
        'sumber_nik_user' => $data->satusehat->sumber_nik_user ?? 'kepegawaian',
    ],
];
