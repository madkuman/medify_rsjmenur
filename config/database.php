<?php

$db_host = config('app.db_host');
$db_user = config('app.db_user');
$db_password = config('app.db_password');
$db_name = config('app.db_name');
$db_port = config('app.db_port');

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your rootlication.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [
        'mysql' => [
            'driver' => 'mysql',
            'host' => $db_host,
            'port' => $db_port,
            'database' => $db_name,
            'username' => $db_user,
            'password' => $db_password,
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => "InnoDB",
        ],
        'farmasi' => [
            'driver' => 'mysql',
            'host' => $db_host,
            'port' => $db_port,
            'database' => $db_name.'_farmasi',
            'username' => $db_user,
            'password' => $db_password,
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => "InnoDB",
        ],

        'kepegawaian' => [
            'driver' => 'mysql',
            'host' => $db_host,
            'port' => $db_port,
            'database' => $db_name.'_kepegawaian',
            'username' => $db_user,
            'password' => $db_password,
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => "InnoDB",
        ],

        'lab_pk' => [
            'driver' => 'mysql',
            'host' => $db_host,
            'port' => $db_port,
            'database' => $db_name.'_lab_pk',
            'username' => $db_user,
            'password' => $db_password,
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => "InnoDB",
        ],

        'lab_pa' => [
            'driver' => 'mysql',
            'host' => $db_host,
            'port' => $db_port,
            'database' => $db_name.'_lab_pa',
            'username' => $db_user,
            'password' => $db_password,
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => "InnoDB",
        ],

        'radiology' => [
            'driver' => 'mysql',
            'host' => $db_host,
            'port' => $db_port,
            'database' => $db_name.'_radiology',
            'username' => $db_user,
            'password' => $db_password,
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => "InnoDB",
        ],

        'patients' => [
            'driver' => 'mysql',
            'host' => $db_host,
            'port' => $db_port,
            'database' => $db_name.'_patients',
            'username' => $db_user,
            'password' => $db_password,
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => "InnoDB",
        ],

        'rawatjalan' => [
            'driver' => 'mysql',
            'host' => $db_host,
            'port' => $db_port,
            'database' => $db_name.'_rawat_jalan',
            'username' => $db_user,
            'password' => $db_password,
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => "InnoDB",
        ],

        'rawatinap' => [
            'driver' => 'mysql',
            'host' => $db_host,
            'port' => $db_port,
            'database' => $db_name.'_rawat_inap',
            'username' => $db_user,
            'password' => $db_password,
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => "InnoDB",
        ],

        'kasus' => [
            'driver' => 'mysql',
            'host' => $db_host,
            'port' => $db_port,
            'database' => $db_name.'_kasus',
            'username' => $db_user,
            'password' => $db_password,
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => "InnoDB",
        ],

        'aset' => [
            'driver' => 'mysql',
            'host' => $db_host,
            'port' => $db_port,
            'database' => $db_name.'_aset',
            'username' => $db_user,
            'password' => $db_password,
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => "InnoDB",
        ],

        'alat_medis' => [
            'driver' => 'mysql',
            'host' => $db_host,
            'port' => $db_port,
            'database' => $db_name.'_alat_medis',
            'username' => $db_user,
            'password' => $db_password,
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => "InnoDB",
        ],

        'kasir' => [
            'driver' => 'mysql',
            'host' => $db_host,
            'port' => $db_port,
            'database' => $db_name.'_kasir',
            'username' => $db_user,
            'password' => $db_password,
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => "InnoDB",
        ],

        'keuangan' => [
            'driver' => 'mysql',
            'host' => $db_host,
            'port' => $db_port,
            'database' => $db_name.'_keuangan',
            'username' => $db_user,
            'password' => $db_password,
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => "InnoDB",
        ],

        'igd' => [
            'driver' => 'mysql',
            'host' => $db_host,
            'port' => $db_port,
            'database' => $db_name.'_igd',
            'username' => $db_user,
            'password' => $db_password,
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => "InnoDB",
        ],

        'kamaroperasi' => [
            'driver' => 'mysql',
            'host' => $db_host,
            'port' => $db_port,
            'database' => $db_name.'_kamar_operasi',
            'username' => $db_user,
            'password' => $db_password,
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => "InnoDB",
        ],

        'cssd' => [
            'driver' => 'mysql',
            'host' => $db_host,
            'port' => $db_port,
            'database' => $db_name.'_cssd',
            'username' => $db_user,
            'password' => $db_password,
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => "InnoDB",
        ],
        
        'kamarjenazah' => [
            'driver' => 'mysql',
            'host' => $db_host,
            'port' => $db_port,
            'database' => $db_name.'_kamar_jenazah',
            'username' => $db_user,
            'password' => $db_password,
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => "InnoDB",
        ],

        'laundry' => [
            'driver' => 'mysql',
            'host' => $db_host,
            'port' => $db_port,
            'database' => $db_name.'_laundry',
            'username' => $db_user,
            'password' => $db_password,
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => "InnoDB",
        ],

        'rekammedis' => [
            'driver' => 'mysql',
            'host' => $db_host,
            'port' => $db_port,
            'database' => $db_name.'_rekam_medis',
            'username' => $db_user,
            'password' => $db_password,
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => "InnoDB",
        ],

        'keperawatan' => [
            'driver' => 'mysql',
            'host' => $db_host,
            'port' => $db_port,
            'database' => $db_name.'_keperawatan',
            'username' => $db_user,
            'password' => $db_password,
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => "InnoDB",
        ],

        'gizi' => [
            'driver' => 'mysql',
            'host' => $db_host,
            'port' => $db_port,
            'database' => $db_name.'_gizi',
            'username' => $db_user,
            'password' => $db_password,
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => "InnoDB",
        ],


        'urikkes' => [
            'driver' => 'mysql',
            'host' => $db_host,
            'port' => $db_port,
            'database' => $db_name.'_urikkes',
            'username' => $db_user,
            'password' => $db_password,
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

        'clinical_pathway' => [
            'driver' => 'mysql',
            'host' => $db_host,
            'port' => $db_port,
            'database' => $db_name.'_clinical_pathway',
            'username' => $db_user,
            'password' => $db_password,
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

        'online' => [
            'driver' => 'mysql',
            'host' => $db_host,
            'port' => $db_port,
            'database' => $db_name.'_online',
            'username' => $db_user,
            'password' => $db_password,
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

        'unit_tindakan' => [
            'driver' => 'mysql',
            'host' => $db_host,
            'port' => $db_port,
            'database' => $db_name.'_unit_tindakan',
            'username' => $db_user,
            'password' => $db_password,
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],
        'harmat' => [
            'driver' => 'mysql',
            'host' => $db_host,
            'port' => $db_port,
            'database' => $db_name.'_harmat',
            'username' => $db_user,
            'password' => $db_password,
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => "InnoDB",
        ],
        'humas' => [
            'driver' => 'mysql',
            'host' => $db_host,
            'port' => $db_port,
            'database' => $db_name.'_humas',
            'username' => $db_user,
            'password' => $db_password,
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => "InnoDB",
        ],
        'k3' => [
            'driver' => 'mysql',
            'host' => $db_host,
            'port' => $db_port,
            'database' => $db_name.'_k3',
            'username' => $db_user,
            'password' => $db_password,
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => "InnoDB",
        ],
        'it' => [
            'driver' => 'mysql',
            'host' => $db_host,
            'port' => $db_port,
            'database' => $db_name.'_it',
            'username' => $db_user,
            'password' => $db_password,
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => "InnoDB",
        ],
        'remunerasi' => [
            'driver' => 'mysql',
            'host' => $db_host,
            'port' => $db_port,
            'database' => $db_name.'_remunerasi',
            'username' => $db_user,
            'password' => $db_password,
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => "InnoDB",
            'options' => [
                PDO::ATTR_EMULATE_PREPARES => true,
            ],
        ],
        'thirdp' => [
            'driver' => 'mysql',
            'host' => $db_host,
            'port' => $db_port,
            'database' => $db_name . '_third_party',
            'username' => $db_user,
            'password' => $db_password,
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => "InnoDB",
        ],

        'esakip' => [
            'driver' => 'mysql',
            'host' => $db_host,
            'port' => $db_port,
            'database' => $db_name . '_esakip',
            'username' => $db_user,
            'password' => $db_password,
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => "InnoDB",
        ],

        'eusulan' => [
            'driver' => 'mysql',
            'host' => $db_host,
            'port' => $db_port,
            'database' => $db_name . '_eusulan',
            'username' => $db_user,
            'password' => $db_password,
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => "InnoDB",
        ],
        'sirs' => [
            'driver' => 'mysql',
            'host' => $db_host,
            'port' => $db_port,
            'database' => $db_name . '_sirs',
            'username' => $db_user,
            'password' => $db_password,
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => "InnoDB",
        ],
        'satusehat' => [
            'driver' => 'mysql',
            'host' => $db_host,
            'port' => $db_port,
            'database' => $db_name . '_third_party_satusehat',
            'username' => $db_user,
            'password' => $db_password,
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => "InnoDB",
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your rootlication. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer set of commands than a typical key-value systems
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => 'predis',

        'default' => [
            'host' => 'localhost',
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => 0,
        ],

    ],

];
