<?php

namespace App\Http\Controllers\Admin\PengaturanFitur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataController extends Controller
{
    public function mutu()
    {
        #define your feature
        $data = [];
        // $data['laporan_rawat_jalan_persentase_ketepatan_waktu_pelayanan_rawat_jalan'] = [
        //     'judul' => 'Laporan Rawat Jalan - Persentase Ketepatan Waktu Pelayanan Rawat Jalan',
        //     'deskripsi' => 'Laporan mutu',
        //     'input' => [
        //         'on' => [ #key unique dibuat attribute id
        //             'col' => 12, #optional default 4 
        //             'type' => 'toggle', #nama file di view admin.pengaturan-fitur.components.form
        //             'judul' => 'Pengaturan On / Off',
        //             'name' => 'on', #samakan dengan yang ada diconfig
        //             'deskripsi' => 'pengaturan on / off fitur ini',
        //             'preview' => url('pasien'), #optional default null, input type url eg: "www.google.com"
        //             'preview_size' => 'medium', #optional default 'small', currently available small,medium
        //             'attributes' => [], #assosiative array eg : ['min' => '100'] , list registered attribute type, name, id, value (default value set di config);
        //         ],
        //         'jangka-waktu' => [ #key unique dibuat attribute id
        //             'col' => 4, #optional default 4 
        //             'type' => 'input', #nama file di view admin.pengaturan-fitur.components.form
        //             'judul' => 'Jangka Waktu',
        //             'name' => 'jangka_waktu', #samakan dengan yang ada diconfig
        //             'deskripsi' =>  'jangka waktu dalam satuan detik',
        //             'attributes' => [], #assosiative array eg : ['min' => '100'] , list registered attribute type, name, id, value (default value set di config);
        //         ],
        //     ]
        // ];


        $data['laporan_rawat_jalan_persentase_ketepatan_waktu_pelayanan_rawat_jalan'] = [
            'judul' => 'Laporan Rawat Jalan - Persentase Ketepatan Waktu Pelayanan Rawat Jalan',
            'input' => [
                'jangka-waktu' => [
                    'col' => 4,
                    'type' => 'input',
                    'judul' => 'Jangka Waktu',
                    'name' => 'jangka_waktu',
                    'deskripsi' =>  'jangka waktu dalam satuan detik',
                ],
            ]
        ];
        $data['laporan_igd_ketepatan_waktu_pelayanan_igd'] = [
            'judul' => 'Laporan IGD - Ketepatan Waktu Pelayanan IGD',
            'input' => [
                'jangka-waktu' => [
                    'type' => 'input',
                    'judul' => 'Jangka Waktu',
                    'name' => 'jangka_waktu',
                    'deskripsi' =>  'jangka waktu dalam satuan detik',
                ],
            ]
        ];
        return $data;
    }

    public function pasien()
    {
        $data = [];
        $data['dkk_34_laporan_bulanan_diare'] = [
            'judul' => 'DKK 34 Laporan Bulanan Diare',
            'input' => [
                'zinc' => [
                    'type' => 'select2multiple',
                    'judul' => 'Obat Zinc',
                    'name' => 'zinc',
                    'deskripsi' =>  'Daftar Obat yang termasuk',
                    'placeholder' => "Pilih Obat",
                    'source_url' => url('admin/select2/farmasi/item-template'),
                    'selected_option' => app(\App\Http\Controllers\Farmasi\ItemTemplate\ReadController::class)->select2GetSelected(config('medify.pasien.dkk_34_laporan_bulanan_diare.zinc', [])),
                ],
                'oralit' => [
                    'type' => 'select2multiple',
                    'judul' => 'Obat Oralit',
                    'name' => 'oralit',
                    'deskripsi' =>  'Daftar Obat yang termasuk',
                    'placeholder' => "Pilih Obat",
                    'source_url' => url('admin/select2/farmasi/item-template'),
                    'selected_option' => app(\App\Http\Controllers\Farmasi\ItemTemplate\ReadController::class)->select2GetSelected(config('medify.pasien.dkk_34_laporan_bulanan_diare.oralit', [])),
                ],
                'rl' => [
                    'type' => 'select2multiple',
                    'judul' => 'Obat RL',
                    'name' => 'rl',
                    'deskripsi' =>  'Daftar Obat yang termasuk',
                    'placeholder' => "Pilih Obat",
                    'source_url' => url('admin/select2/farmasi/item-template'),
                    'selected_option' => app(\App\Http\Controllers\Farmasi\ItemTemplate\ReadController::class)->select2GetSelected(config('medify.pasien.dkk_34_laporan_bulanan_diare.rl', [])),
                ],
            ]
        ];
        $data['pasien_baru'] = [
            'judul' => 'Pasien Baru',
            'deskripsi' => 'pengaturan yang terdapat di menu Pasien Baru',
            'input' => [
                'enable_pasien_laborat' => [
                    'col' => 4,
                    'type' => 'toggle',
                    'judul' => 'Pasien Laborat',
                    'name' => 'enable_pasien_laborat',
                    'deskripsi' => 'Mengaktifkan Pilihan Pasien Laborat',
                ],
            ]
        ];
        return $data;
    }

    public function thirdparty()
    {
        $lokasi = \App\Models\Hospital\Lokasi::pluck('nama', 'id');
        $data = [];

        $data['sirs_v3'] = [
            'judul' => 'SIRS V3',
            'deskripsi' => 'Pengaturan fitur bridging SIRS V3',
            'input' => [
                'on' => [ #key unique dibuat attribute id
                    'col' => 4, #optional default 4
                    'type' => 'toggle', #nama file di view admin.pengaturan-fitur.components.form
                    'judul' => 'Pengaturan On / Off',
                    'name' => 'on', #samakan dengan yang ada diconfig
                    'deskripsi' => 'pengaturan on / off fitur ini',
                ],
                'on_second_acc' => [ #key unique dibuat attribute id
                    'col' => 4, #optional default 4
                    'type' => 'toggle', #nama file di view admin.pengaturan-fitur.components.form
                    'judul' => 'Pengaturan On / Off Dual Bridging Akun',
                    'name' => 'on_second_acc', #samakan dengan yang ada diconfig
                    'deskripsi' => 'pengaturan on / off fitur dual bridging akun berdasarkan lokasi',
                ],
                'spacer-0' => [
                    'type' => 'spacer',
                    'col' => 12,
                ],
                'url' => [ #key unique dibuat attribute id
                    'col' => 4, #optional default 4
                    'type' => 'input', #nama file di view admin.pengaturan-fitur.components.form
                    'judul' => 'SIRS V3 URL',
                    'name' => 'url', #samakan dengan yang ada diconfig
                    'deskripsi' =>  '',
                    'attributes' => [], #assosiative array eg : ['min' => '100'] , list registered attribute type, name, id, value (default value set di config);
                ],
                'spacer-1' => [
                    'type' => 'spacer',
                    'col' => 12,
                ],
                'id' => [ #key unique dibuat attribute id
                    'col' => 4, #optional default 4
                    'type' => 'input', #nama file di view admin.pengaturan-fitur.components.form
                    'judul' => 'SIRS V3 Default Auth ID',
                    'name' => 'id', #samakan dengan yang ada diconfig
                    'deskripsi' =>  '',
                    'attributes' => [], #assosiative array eg : ['min' => '100'] , list registered attribute type, name, id, value (default value set di config);
                ],
                'password' => [ #key unique dibuat attribute id
                    'col' => 4, #optional default 4
                    'type' => 'password', #nama file di view admin.pengaturan-fitur.components.form
                    'judul' => 'SIRS V3 Default Auth Password',
                    'name' => 'password', #samakan dengan yang ada diconfig
                    'deskripsi' =>  '',
                    'attributes' => [], #assosiative array eg : ['min' => '100'] , list registered attribute type, name, id, value (default value set di config);
                ],
                'spacer-2' => [
                    'type' => 'spacer',
                    'col' => 12,
                ],
                'second_acc_id' => [ #key unique dibuat attribute id
                    'col' => 4, #optional default 4
                    'type' => 'input', #nama file di view admin.pengaturan-fitur.components.form
                    'judul' => 'SIRS V3 Second Auth ID',
                    'name' => 'second_acc_id', #samakan dengan yang ada diconfig
                    'deskripsi' =>  '',
                    'attributes' => [], #assosiative array eg : ['min' => '100'] , list registered attribute type, name, id, value (default value set di config);
                ],
                'second_acc_password' => [ #key unique dibuat attribute id
                    'col' => 4, #optional default 4
                    'type' => 'password', #nama file di view admin.pengaturan-fitur.components.form
                    'judul' => 'SIRS V3 Second Auth Password',
                    'name' => 'second_acc_password', #samakan dengan yang ada diconfig
                    'deskripsi' =>  '',
                    'attributes' => [], #assosiative array eg : ['min' => '100'] , list registered attribute type, name, id, value (default value set di config);
                ],
                'second_acc_lokasi' => [
                    'type' => 'select2multiple',
                    'judul' => 'Lokasi Kasus',
                    'name' => 'second_acc_lokasi',
                    'deskripsi' =>  'Pilihan lokasi untuk filter data kasus yang dikirimkan di Akun Kedua',
                    'placeholder' => "--Pilih--",
                    'options' => $lokasi,
                ],
            ],
        ];

        $data['jkn_online'] = [
            'judul' => 'JKN Online',
            'deskripsi' => 'JKN Online Update',
            'input' => [
                'on' => [ #key unique dibuat attribute id
                    'col' => 12, #optional default 4
                    'type' => 'toggle', #nama file di view admin.pengaturan-fitur.components.form
                    'judul' => 'Pengaturan On / Off',
                    'name' => 'on', #samakan dengan yang ada diconfig
                    'deskripsi' => 'pengaturan on / off fitur ini',
                    'preview' => url('pasien'), #optional default null, input type url eg: "www.google.com"
                    'preview_size' => 'medium', #optional default 'small', currently available small,medium
                    'attributes' => [], #assosiative array eg : ['min' => '100'] , list registered attribute type, name, id, value (default value set di config);
                ],
                'url' => [ #key unique dibuat attribute id
                    'col' => 4, #optional default 4
                    'type' => 'input', #nama file di view admin.pengaturan-fitur.components.form
                    'judul' => 'JKN URL',
                    'name' => 'url', #samakan dengan yang ada diconfig
                    'deskripsi' =>  '',
                    'attributes' => [], #assosiative array eg : ['min' => '100'] , list registered attribute type, name, id, value (default value set di config);
                ],
                'cons-id' => [ #key unique dibuat attribute id
                    'col' => 4, #optional default 4
                    'type' => 'input', #nama file di view admin.pengaturan-fitur.components.form
                    'judul' => 'CONS ID',
                    'name' => 'cons_id', #samakan dengan yang ada diconfig
                    'deskripsi' =>  '',
                    'attributes' => [], #assosiative array eg : ['min' => '100'] , list registered attribute type, name, id, value (default value set di config);
                ],
                'cons-pwd' => [ #key unique dibuat attribute id
                    'col' => 4, #optional default 4
                    'type' => 'input', #nama file di view admin.pengaturan-fitur.components.form
                    'judul' => 'CONS PASSWORD',
                    'name' => 'cons_pwd', #samakan dengan yang ada diconfig
                    'deskripsi' =>  '',
                    'attributes' => [], #assosiative array eg : ['min' => '100'] , list registered attribute type, name, id, value (default value set di config);
                ],
                'user-key' => [ #key unique dibuat attribute id
                    'col' => 4, #optional default 4
                    'type' => 'input', #nama file di view admin.pengaturan-fitur.components.form
                    'judul' => 'USER KEY',
                    'name' => 'user_key', #samakan dengan yang ada diconfig
                    'deskripsi' =>  '',
                    'attributes' => [], #assosiative array eg : ['min' => '100'] , list registered attribute type, name, id, value (default value set di config);
                ],
                'pengali_waktu_tunggu_auto_taskid_5' => [
                    'col' => 4,
                    'type' => 'number',
                    'judul' => 'Batas Max Random Waktu Tunggu Auto taskID 5',
                    'name' => 'pengali_waktu_tunggu_auto_taskid_5',
                    'attributes' => [
                        'step' => 'any',
                    ],
                ],
            ]
        ];
        $data['vclaim'] = [
            'judul' => 'VCLAIM',
            'deskripsi' => 'SEP V2',
            'input' => [
                'on_v2' => [ #key unique dibuat attribute id
                    'col' => 4, #optional default 4 
                    'type' => 'toggle', #nama file di view admin.pengaturan-fitur.components.form
                    'judul' => 'On / Off SEP V2',
                    'name' => 'on_v2', #samakan dengan yang ada diconfig
                    'deskripsi' => 'pengaturan on / off fitur ini',
                ],
                'on_auto_finger' => [ #key unique dibuat attribute id
                    'col' => 4, #optional default 4 
                    'type' => 'toggle', #nama file di view admin.pengaturan-fitur.components.form
                    'judul' => 'On / Off Auto SEP - Finger Print',
                    'name' => 'on_auto_finger', #samakan dengan yang ada diconfig
                    'deskripsi' => 'pengaturan on / off fitur ini',
                    // 'preview' => url('pasien'), #optional default null, input type url eg: "www.google.com"
                    // 'preview_size' => 'medium', #optional default 'small', currently available small,medium
                    // 'attributes' => [], #assosiative array eg : ['min' => '100'] , list registered attribute type, name, id, value (default value set di config);
                ],
            ]
        ];

        $data['rs_online'] = [
            'judul' => 'RS Online Web View',
            'deskripsi' => 'Pengaturan RS Online Web View',
            'input' => [
                'on' => [
                    'type' => 'toggle-v2',
                    'judul' => 'On / Off',
                    'name' => 'on',
                    'deskripsi' => 'On Features Ini',
                ],
                'cms_guide' => [
                    'col' => 12,
                    'type' => 'textarea',
                    'attributes' => [
                        'class' => 'wysiwyg',
                    ],
                    'judul' => 'CMS Panduan',
                    'name' => 'halaman_panduan',
                    'deskripsi' => 'CMS Halaman Panduan',
                    'value' => app('App\Http\Controllers\Admin\ThirdParty\RsOnline\ReadController')->getBySlug('halaman-panduan')->content ?? null,
                ],
                'cms_privacy_policy' => [
                    'col' => 12,
                    'type' => 'textarea',
                    'attributes' => [
                        'class' => 'wysiwyg',
                    ],
                    'judul' => 'CMS Kebijakan Privasi',
                    'name' => 'halaman_kebijakan_privasi',
                    'deskripsi' => 'CMS Halaman Kebijakan Privasi',
                    'value' => app('App\Http\Controllers\Admin\ThirdParty\RsOnline\ReadController')->getBySlug('halaman-kebijakan-privasi')->content ?? null,
                ],
                'cms_about_app' => [
                    'col' => 12,
                    'type' => 'textarea',
                    'attributes' => [
                        'class' => 'wysiwyg',
                    ],
                    'judul' => 'CMS Tentang Aplikasi',
                    'name' => 'halaman_tentang_aplikasi',
                    'deskripsi' => 'CMS Halaman Tentang Aplikasi',
                    'value' => app('App\Http\Controllers\Admin\ThirdParty\RsOnline\ReadController')->getBySlug('halaman-tentang-aplikasi')->content ?? null,
                ],
                'cms_call_center' => [
                    'col' => 12,
                    'type' => 'textarea',
                    'attributes' => [
                        'class' => 'wysiwyg',
                    ],
                    'judul' => 'CMS Call Center',
                    'name' => 'halaman_call_center',
                    'deskripsi' => 'CMS Halaman Call Center',
                    'value' => app('App\Http\Controllers\Admin\ThirdParty\RsOnline\ReadController')->getBySlug('halaman-call-center')->content ?? null,
                ],
            ]
        ];

        $data['satusehat'] = [
            'judul' => 'Bridging Satu Sehat',
            'deskripsi' => 'Pengaturan Bridging Satu Sehat',
            'input' => [
                'on' => [
                    'type' => 'toggle-v2',
                    'judul' => 'On / Off',
                    'name' => 'on',
                    'deskripsi' => 'jika on maka on maka bridging satusehat aktif',
                ],
                'stage' => [
                    'col' => 4,
                    'type' => 'select2',
                    'judul' => 'Pilihan Stage',
                    'name' => 'stage',
                    'deskripsi' => 'Pilih Stage Bridging',
                    'options' => [
                        'development' => "Development",
                        'production' => "Production",
                    ]
                ],
                'auth_url' => [
                    'col' => 4,
                    'type' => 'input',
                    'judul' => 'Auth URL',
                    'name' => 'auth_url',
                    'deskripsi' => 'Setting auth url satu sehat',
                ],
                'base_url' => [
                    'col' => 4,
                    'type' => 'input',
                    'judul' => 'Base URL',
                    'name' => 'base_url',
                    'deskripsi' => 'Setting base url satu sehat',
                ],
                'consent_url' => [
                    'col' => 4,
                    'type' => 'input',
                    'judul' => 'Consent URL',
                    'name' => 'consent_url',
                    'deskripsi' => 'Setting Consent url satu sehat',
                ],
                'client_id' => [
                    'col' => 4,
                    'type' => 'input',
                    'judul' => 'Client ID',
                    'name' => 'client_id',
                    'deskripsi' => 'Setting Client ID satu sehat',
                ],
                'client_secret' => [
                    'col' => 4,
                    'type' => 'input',
                    'judul' => 'Client Secret',
                    'name' => 'client_secret',
                    'deskripsi' => 'Setting Client Secret satu sehat',
                ],
                'organization_id' => [
                    'col' => 4,
                    'type' => 'input',
                    'judul' => 'Organization ID',
                    'name' => 'organization_id',
                    'deskripsi' => 'Setting Organization ID satu sehat',
                ],
                'sumber_nik_user' => [
                    'col' => 4,
                    'type' => 'select2',
                    'judul' => 'Sumber NIK user',
                    'name' => 'sumber_nik_user',
                    'deskripsi' => 'Pilih Sumber NIK User',
                    'options' => [
                        'kepegawaian' => "Kepegawaian (Default)",
                        'user' => "Pengaturan User",
                    ]
                ],
            ],
        ];

        $data['whatsapp'] = [
            'judul' => 'Whatsapp Gateway',
            'deskripsi' => 'Pengaturan WhatsApp Gateway menggunakan Fonnte',
            'input' => [
                'on' => [ #key unique dibuat attribute id
                    'col' => 12, #optional default 4
                    'type' => 'toggle', #nama file di view admin.pengaturan-fitur.components.form
                    'judul' => 'Pengaturan On / Off',
                    'name' => 'on', #samakan dengan yang ada diconfig
                    'deskripsi' => 'pengaturan on / off fitur ini',
                    'preview' => url('pasien'), #optional default null, input type url eg: "www.google.com"
                    'preview_size' => 'medium', #optional default 'small', currently available small,medium
                    'attributes' => [], #assosiative array eg : ['min' => '100'] , list registered attribute type, name, id, value (default value set di config);
                ],
                'token' => [ #token diambil dari situsnya Fonnte
                    'col' => 4, #optional default 4
                    'type' => 'input', #nama file di view admin.pengaturan-fitur.components.form
                    'judul' => 'Token device yang terdaftar di Fonnte',
                    'name' => 'token', #samakan dengan yang ada diconfig
                    'deskripsi' =>  '',
                    'attributes' => [], #assosiative array eg : ['min' => '100'] , list registered attribute type, name, id, value (default value set di config);
                ],
            ]
        ];

        $data['apotek_online'] = [
            'judul' => 'Apotek Online',
            'deskripsi' => 'Apotek Online Update',
            'input' => [
                'on' => [ #key unique dibuat attribute id
                    'col' => 12, #optional default 4
                    'type' => 'toggle', #nama file di view admin.pengaturan-fitur.components.form
                    'judul' => 'Pengaturan On / Off',
                    'name' => 'on', #samakan dengan yang ada diconfig
                    'deskripsi' => 'pengaturan on / off fitur ini',
                    'preview' => url('pasien'), #optional default null, input type url eg: "www.google.com"
                    'preview_size' => 'medium', #optional default 'small', currently available small,medium
                    'attributes' => [], #assosiative array eg : ['min' => '100'] , list registered attribute type, name, id, value (default value set di config);
                ],
                'url' => [ #key unique dibuat attribute id
                    'col' => 4, #optional default 4
                    'type' => 'input', #nama file di view admin.pengaturan-fitur.components.form
                    'judul' => 'URL Apotek Online',
                    'name' => 'url', #samakan dengan yang ada diconfig
                    'deskripsi' =>  '',
                    'attributes' => [], #assosiative array eg : ['min' => '100'] , list registered attribute type, name, id, value (default value set di config);
                ],
                'cons-id' => [ #key unique dibuat attribute id
                    'col' => 4, #optional default 4
                    'type' => 'input', #nama file di view admin.pengaturan-fitur.components.form
                    'judul' => 'CONS ID',
                    'name' => 'cons_id', #samakan dengan yang ada diconfig
                    'deskripsi' =>  '',
                    'attributes' => [], #assosiative array eg : ['min' => '100'] , list registered attribute type, name, id, value (default value set di config);
                ],
                'cons-pwd' => [ #key unique dibuat attribute id
                    'col' => 4, #optional default 4
                    'type' => 'input', #nama file di view admin.pengaturan-fitur.components.form
                    'judul' => 'CONS PASSWORD',
                    'name' => 'cons_pwd', #samakan dengan yang ada diconfig
                    'deskripsi' =>  '',
                    'attributes' => [], #assosiative array eg : ['min' => '100'] , list registered attribute type, name, id, value (default value set di config);
                ],
                'user-key' => [ #key unique dibuat attribute id
                    'col' => 4, #optional default 4
                    'type' => 'input', #nama file di view admin.pengaturan-fitur.components.form
                    'judul' => 'USER KEY',
                    'name' => 'user_key', #samakan dengan yang ada diconfig
                    'deskripsi' =>  '',
                    'attributes' => [], #assosiative array eg : ['min' => '100'] , list registered attribute type, name, id, value (default value set di config);
                ],
            ]
        ];

        return $data;
    }

    public function rawatjalan()
    {
        $data = [];
        $data['nomor_antrian'] = [
            'judul' => 'Nomor Antrian',
            'deskripsi' => 'Daftar Pengaturan yang mempengaruhi nomor antrian',
            'input' => [
                'per_dokter' => [
                    'col' => 4,
                    'type' => 'toggle',
                    'judul' => 'Per Dokter',
                    'name' => 'per_dokter',
                    'deskripsi' => 'Nomor antrian per dokter',
                ],
            ]
        ];
        $data['auto_krs_dan_checkout'] = [
            'judul' => 'Auto KRS dan Checkout',
            'deskripsi' => 'Daftar Pengaturan yang mempengaruhi auto KRS dan Checkout Rajal',
            'input' => [
                'auto_checkout' => [
                    'col' => 4,
                    'type' => 'toggle',
                    'judul' => 'Auto Checkout',
                    'name' => 'auto_checkout',
                    'deskripsi' => 'Fitur untuk menyalakan auto checkout pada command auto krs dan checkout',
                ],
            ]
        ];
        return $data;
    }
}
