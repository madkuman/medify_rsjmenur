<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\RawatInap\Ruangan;
use App\User;
use Auth;
use Carbon\Carbon;
use Bugsnag;

class ApplicareUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bpjs:applicare-update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto update applicare di BPJS';

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
    public function handle(){
        try
        {
            Auth::loginUsingId(1);
            $ruang = Ruangan::with(['nama_applicare', 'kode_applicare', 'count_empty', 'count_bed'])->get();
            $data_ruang = [];
            foreach ($ruang as $index => $ruangan) {
                $kelas_applicare = $ruangan->kelas_applicare;
                $name_ruang = $ruangan->nama_applicare;
                $kode_ruang = $ruangan->kode_applicare;
                $tersedia =  empty($ruangan->count_empty) ? 0 : $ruangan->count_empty;
                $kapasitas = $ruangan->count_bed;
                if(!empty($kelas_applicare) && !empty($kode_ruang) && config("app.bpjs_enable")){
                    $data['kodekelas'] = $kelas_applicare;
                    $data['koderuang'] = $kode_ruang;
                    $data['namaruang'] = $name_ruang;
                    $data['kapasitas'] = $kapasitas;
                    $data['tersedia'] = $tersedia;
                    $data['tersediapria'] = 0;
                    $data['tersediapria'] = 0;
                    $data['tersediapriawanita'] = $tersedia;
                    // $res_applicare = app('App\Http\Controllers\BPJS\API\Applicare\EditController')->editRuangan($data);
                }elseif(empty($kode_ruang) && config("app.bpjs_enable")){
                    $data['kodekelas'] = $kelas_applicare;
                    $data['koderuang'] = $kode_ruang;
                    $data['namaruang'] = $name_ruang;
                    $data['kapasitas'] = $kapasitas;
                    $data['tersedia'] = $tersedia;
                    $data['tersediapria'] = 0;
                    $data['tersediapria'] = 0;
                    $data['tersediapriawanita'] = $tersedia;
                    $ruangan->kode_ruang = $kode_ruang;
                    $ruangan->save();
                    // $res_applicare = app('App\Http\Controllers\BPJS\API\Applicare\CreateController')->createRuangan($data);
                }
                array_push($data_ruang, $data);
            }

            $res_applicare = app('App\Http\Controllers\BPJS\API\Applicare\EditController')->batchUpdate($data_ruang);
        }
        catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }

    }
}
