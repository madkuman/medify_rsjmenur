<?php


if(file_exists(base_path('/settings/settings.json'))){
    $hospital_data_string = file_get_contents(base_path('/settings/settings.json'));
    if(isJson($hospital_data_string))
        $hospital_data = json_decode($hospital_data_string);
    else
        $hospital_data = new stdClass;
}
else
    $hospital_data = new stdClass;

if(file_exists(base_path('/settings/medify/kepegawaian.json'))){
    $kepegawaian_data_string = file_get_contents(base_path('/settings/medify/kepegawaian.json'));
    if(isJson($kepegawaian_data_string))
        $kepegawaian_data = json_decode($kepegawaian_data_string);
    else
        $kepegawaian_data = new stdClass;
}
else
    $kepegawaian_data = new stdClass;

$config = [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => ($hospital_data->name ?? "MEDIFY-APP"),
    'project' => 'MEDIFY v2.0',
    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services your application utilizes. Set this in your ".env" file.
    |
    */

    'env' => ($hospital_data->env ?? "sirsak-production"),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => ($hospital_data->debug ?? false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => ($hospital_data->url ?? "http://localhost"),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'Asia/Jakarta',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'id',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Logging Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log settings for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Settings: "single", "daily", "syslog", "errorlog"
    |
    */

    'log' => env('APP_LOG', 'single'),

    'log_level' => env('APP_LOG_LEVEL', 'debug'),

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,

        /*
         * Package Service Providers...
         */
        Intervention\Image\ImageServiceProvider::class,
        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        Barryvdh\DomPDF\ServiceProvider::class,
        Laravel\Scout\ScoutServiceProvider::class,
        Barryvdh\Cors\ServiceProvider::class,
        niklasravnsborg\LaravelPdf\PdfServiceProvider::class,
        Milon\Barcode\BarcodeServiceProvider::class,
        Yajra\DataTables\DataTablesServiceProvider::class,
        // the driver for Elasticsearch
        ScoutElastic\ScoutElasticServiceProvider::class,
        //Spatie\Permission\PermissionServiceProvider::class,
        Bugsnag\BugsnagLaravel\BugsnagServiceProvider::class,
        UxWeb\SweetAlert\SweetAlertServiceProvider::class,
        Jenssegers\Date\DateServiceProvider::class,
        App\Providers\DuskServiceProvider::class,
       // LynX39\LaraPdfMerger\PdfMergerServiceProvider::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => [
        'App' => Illuminate\Support\Facades\App::class,
        'Artisan' => Illuminate\Support\Facades\Artisan::class,
        'Auth' => Illuminate\Support\Facades\Auth::class,
        'Blade' => Illuminate\Support\Facades\Blade::class,
        'Broadcast' => Illuminate\Support\Facades\Broadcast::class,
        'Bus' => Illuminate\Support\Facades\Bus::class,
        'Cache' => Illuminate\Support\Facades\Cache::class,
        'Config' => Illuminate\Support\Facades\Config::class,
        'Cookie' => Illuminate\Support\Facades\Cookie::class,
        'Crypt' => Illuminate\Support\Facades\Crypt::class,
        'DB' => Illuminate\Support\Facades\DB::class,
        'DataTables' => Yajra\DataTables\Facades\DataTables::class,
        'Eloquent' => Illuminate\Database\Eloquent\Model::class,
        'Event' => Illuminate\Support\Facades\Event::class,
        'File' => Illuminate\Support\Facades\File::class,
        'Form' => 'Collective\Html\FormFacade',
        'Image' => Intervention\Image\Facades\Image::class,
        'Gate' => Illuminate\Support\Facades\Gate::class,
        'Hash' => Illuminate\Support\Facades\Hash::class,
        'Html' => 'Collective\Html\HtmlFacade',
        'Image' => Intervention\Image\Facades\Image::class,
        'Lang' => Illuminate\Support\Facades\Lang::class,
        'Log' => Illuminate\Support\Facades\Log::class,
        'Mail' => Illuminate\Support\Facades\Mail::class,
        'Notification' => Illuminate\Support\Facades\Notification::class,
        'Password' => Illuminate\Support\Facades\Password::class,
        //'PdfMerger' => LynX39\LaraPdfMerger\Facades\PdfMerger::class,
        'Queue' => Illuminate\Support\Facades\Queue::class,
        'Redirect' => Illuminate\Support\Facades\Redirect::class,
        'Redis' => Illuminate\Support\Facades\Redis::class,
        'Request' => Illuminate\Support\Facades\Request::class,
        'Response' => Illuminate\Support\Facades\Response::class,
        'Route' => Illuminate\Support\Facades\Route::class,
        'Schema' => Illuminate\Support\Facades\Schema::class,
        'Session' => Illuminate\Support\Facades\Session::class,
        'Storage' => Illuminate\Support\Facades\Storage::class,
        'URL' => Illuminate\Support\Facades\URL::class,
        'Validator' => Illuminate\Support\Facades\Validator::class,
        'View' => Illuminate\Support\Facades\View::class,
        'DOMPDF' => Barryvdh\DomPDF\Facade::class,
        'MPDF' => niklasravnsborg\LaravelPdf\Facades\Pdf::class,
        'DNS1D' => Milon\Barcode\Facades\DNS1DFacade::class,
        'DNS2D' => Milon\Barcode\Facades\DNS2DFacade::class,
        'Bugsnag' => Bugsnag\BugsnagLaravel\Facades\Bugsnag::class,
        'Alert' => UxWeb\SweetAlert\SweetAlert::class,
        'Date' => Jenssegers\Date\Date::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Additional Application Environment
    |--------------------------------------------------------------------------
    |
    | Add new configuration from your own environment here.
    |
    */

    'check_module' => ($hospital_data->check_module ?? false),
    'notification' => ($hospital_data->notification ?? false),
    'db_host' => ($hospital_data->db_host ?? "localhost"),
    'db_user' => ($hospital_data->db_user ?? "root"),
    'db_password' => ($hospital_data->db_password ?? ""),
    'db_name' => ($hospital_data->db_name ?? "medify_hospital"),
    'db_port' => ($hospital_data->db_port ?? "3306"),
    'elastic_host' => ($hospital_data->elastic_host ?? "localhost:9200"),
    'is_military' => ($hospital_data->is_military ?? 0),
    'favicon_url' => ($hospital_data->favicon_url ?? "/assets/img/favicon.png"),
    'logo_url' => ($hospital_data->logo_url ?? "/assets/img/favicon.png"),
    'kop_lg' => ($hospital_data->kop_lg ?? "/assets/img/favicon.png"),
    'kop_sm' => ($hospital_data->kop_sm ?? "/assets/img/favicon.png"),
    'url_sismadak' => ($hospital_data->url_sismadak ?? "http://sismadak.kars.or.id/"),
    'logo_header_rsonline' => ($hospital_data->logo_header_rsonline ?? "/assets/img/favicon.png"),

    'bpjs_app_url' => ($hospital_data->bpjs_app_url ?? 'https://bpjs.medifyapp.com'),
    'bpjs_vclaim_url_prod' => 'https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest',
    'bpjs_vclaim_url_dev' => 'https://dvlp.bpjs-kesehatan.go.id/VClaim-rest',
    'bpjs_applicares_url_prod' => 'https://new-api.bpjs-kesehatan.go.id/aplicaresws/rest',
    'bpjs_ppk' => ($hospital_data->bpjs_ppk ?? ''),
    'bpjs_ppk_nama' => ($hospital_data->bpjs_ppk_nama ?? ''),
    'bpjs_cons_id' => ($hospital_data->bpjs_cons_id ?? ''),
    'bpjs_secret' => ($hospital_data->bpjs_secret ?? ''),
    'bpjs_decrypt' => ($hospital_data->bpjs_decrypt ?? false),
    'bpjs_user_key' => ($hospital_data->bpjs_user_key ?? null),

    'applicare_ppk' => ($hospital_data->applicare_ppk ?? ''),
    'applicare_cons_id' => ($hospital_data->applicare_cons_id ?? ''),
    'applicare_secret' => ($hospital_data->applicare_secret ?? ''),

    'bpjs_enable' => ($hospital_data->bpjs_enable ?? false),
    'bpjs_stage' => ($hospital_data->bpjs_stage ?? 'development'),
    'inacbg_url' => ($hospital_data->inacbg_url ?? 'http://belajarkoding-inacbg.com/E-Klaim/ws.php?mode=debug'),
    'inacbg_kode_tarif' => ($hospital_data->inacbg_kode_tarif ?? 'AP'),
    'inacbg_key' => ($hospital_data->inacbg_key ?? null),
    'inacbg_coder_nik' => ($hospital_data->coder_nik ?? ''),
    'sirs_enable' => ($hospital_data->sirs_enable ?? false),
    'sirs_url' => ($hospital_data->sirs_url ?? 'http://sirs.kemkes.go.id'),
    'sirs_id' => ($hospital_data->sirs_id ?? ''),
    'sirs_pass' => ($hospital_data->sirs_pass ?? ''),
    'opentok_api_key' => ($hospital_data->opentok_api_key ?? ''),
    'opentok_api_secret' => ($hospital_data->opentok_api_secret ?? ''),
    'check_online_access' => ($hospital_data->check_online_access ?? false),
    'url_online_access' => ($hospital_data->url_online_access ?? ''),

    'kepegawaian_cuti_min_pengajuan_hari' => ($kepegawaian_data->cuti_min_pengajuan_hari ?? 30),
    'kepegawaian_cuti_max_pengajuan_hari' => ($kepegawaian_data->cuti_max_pengajuan_hari ?? 90),
];

if(($hospital_data->debug ?? false))
    array_push($config['providers'], Barryvdh\Debugbar\ServiceProvider::class);
return $config;