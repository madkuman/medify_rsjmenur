<?php

namespace App\Console\Commands\Medify;

use Illuminate\Console\Command;
use Artisan;

class MigrateRecursive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "medify:migrate  
        {--path=database".DIRECTORY_SEPARATOR."migrations".DIRECTORY_SEPARATOR."features : Path recursive dimulai}
        {--debug}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'migrate semua file migration dalam folder dan lanjut apabila error';

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
        $this->getAppVersion();
        Artisan::call('config:cache');
        sleep(1);
        $path = str_replace('\\',  DIRECTORY_SEPARATOR, $this->option('path'));
        $path = str_replace('/',  DIRECTORY_SEPARATOR, $path);
        $this->migrateRecursive($path);
    }

    private function getAppVersion()
    {
        $rgx = "~-[^/-]+(?![^-]*-)~";
        $version = exec('git describe --tags');
        $version = preg_replace($rgx, '', $version, 1);

        if (file_exists(base_path("/settings/settings.json"))) {
            $data_string = file_get_contents(base_path("/settings/settings.json"));
            $settings = json_decode($data_string, true);
            $settings['version'] = $version;
            $json_settings = json_encode($settings, JSON_PRETTY_PRINT);
            file_put_contents(base_path("/settings/settings.json"), stripslashes($json_settings));
        }
    }

    public function migrateRecursive($path)
    {
        
        try{
            Artisan::call('migrate', ['--path' => $path]);    
            echo "\033[32m success folder $path\033[0m\n";  
        }catch(\Exception $e){
            echo "\033[31m error folder $path\033[0m\n";
            if($this->option('debug'))
                echo $e->getMessage()."\n";
        }

        $subdirectory = glob($path.DIRECTORY_SEPARATOR.'*', GLOB_ONLYDIR);
        if(empty($subdirectory)){
            return;
        }
        foreach($subdirectory as $dir) {
            $dirname = basename($dir);
            $this->migrateRecursive($dir);
        }
    }
}
