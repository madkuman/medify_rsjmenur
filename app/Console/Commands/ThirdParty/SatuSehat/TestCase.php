<?php

namespace App\Console\Commands\ThirdParty\SatuSehat;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TestCase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     * ? Params delimiter & like url
     */
    protected $signature = 'satu-sehat:test-case {modul} {function} {--params=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command untuk testcase endpoint satusehat';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Auth::loginUsingId(1);
        $modul = $this->argument('modul');
        $function = $this->argument('function');
        $params = $this->option('params');
        $request = new Request();

        // ? check class path
        $modul_path = str_replace("-", "", ucwords($modul, "-"));
        $class_instance = "\App\Http\Controllers\ThirdParty\SatuSehat\\" . $modul_path . "\\PostController";
        if (!class_exists($class_instance)) {
            echo ("File Controller " . $class_instance . " Tidak Ditemukan\n");
            return;
        }

        // ? check function
        if (!method_exists($class_instance, $function)) {
            echo ("Function " . $function . " Tidak Ditemukan\n");
            return;
        }

        if (!empty($params)) {
            $params_array = [];
            $params = explode('&', $params);
            foreach ($params as $item) {
                $item_arr = explode('=', $item);
                $params_array[$item_arr[0]] = $item_arr[1] ?? null;
            }

            $request->merge($params_array);
        }

        try {
            $running = app($class_instance)->{$function}($request);
            dd($running);
            if (is_array($running)) {
                foreach ($running as $result) {
                    if (!is_string($result)) continue;
                    echo "\n" . $result;
                }
            }
            return;
        } catch (\Exception $e) {
            echo "\n\033[31m Error: \033[0m" . $e->getMessage();
        }
    }
}
