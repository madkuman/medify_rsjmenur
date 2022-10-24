<?php

namespace App\Console\Commands\ThirdParty\SIRS;

use App\Models\IGD\Ruangan as RuanganIGD;
use App\Models\IGD\Transaksi;
use Illuminate\Console\Command;
use App\Models\RawatInap\Ruangan;
use App\Models\RawatInap\TempatTidur;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use Carbon\Carbon;

class DataTempatTidurUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'third-party-sirs:data-tempat-tidur-update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update data tempat tidur untuk covid19';

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
        if(!config('app.sirs_enable') || empty(config('app.sirs_id')) || empty(config('app.sirs_pass')))
        {
            return 0;
        }

        $headers['X-rs-id'] = config('app.sirs_id');
        $headers['X-pass'] = config('app.sirs_pass');
        $headers['X-Timestamp'] = Carbon::now()->timestamp;
        $headers['Accept'] ='application/json';
        $url = config('app.sirs_url').'/fo/index.php/Fasyankes';

        try
        {
            $client = new Client();
            $res = $client->get($url,  [
                    'headers' => $headers
                ]);
            $content = json_decode($res->getBody()->getContents());

            foreach($content->fasyankes as $item)
            {
                echo "\n\n".$item->id_tt." START \n";
                $ruangans = Ruangan::where('sirs_covid_19_tt_id', $item->id_tt)->get();
                $ruangan_ids = $ruangans->pluck('id')->toArray();
                $bed_jumlah = TempatTidur::whereIn('ruangan_id', $ruangan_ids)->count();
                $bed_terpakai = TempatTidur::whereIn('ruangan_id', $ruangan_ids)
                                    ->where(function($q){
                                        $q->whereNotNull('transaksi_id')
                                            ->orWhereNotNull('booking_id');
                                    })
                                    ->count();

                $bed_igd_terpakai = Transaksi::select('id', 'ruangan_id')
                    ->whereNull('waktu_keluar')
                    ->whereHas('ruangan', function ($q) use ($item) {
                        $q->where('sirs_covid_19_tt_id', $item->id_tt);
                    })
                    ->count();

                $ruangan_igd_query = RuanganIGD::where('sirs_covid_19_tt_id', $item->id_tt);
                $ruangan_igd_count = with(clone $ruangan_igd_query)->count();
                $bed_jumlah_igd = with(clone $ruangan_igd_query)->sum('kapasitas') ?? 0;

                $all_ruangan = count($ruangans) + $ruangan_igd_count;
                $all_tt = $bed_jumlah + $bed_jumlah_igd;
                $all_bed_terpakai = $bed_terpakai + $bed_igd_terpakai;
                
                $data['id_tt'] = $item->id_tt;
                $data['jumlah_ruang'] = $all_ruangan;
                $data['jumlah'] = $all_tt;
                $data['terpakai'] = $all_bed_terpakai;

                echo " Updating data...... \n";
                $this->updateTempatTidur($data);
                echo " Done...... \n";
            }

            return 1;
        } catch (RequestException $e) {
            $response = Psr7\str($e->getResponse());
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        } catch (\Exception $e){
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }

    private function updateTempatTidur($data)
    {
        $headers['X-rs-id'] = config('app.sirs_id');
        $headers['X-pass'] = config('app.sirs_pass');
        $headers['X-Timestamp'] = Carbon::now()->timestamp;
        $headers['Accept'] ='application/x-www-form-urlencoded';
        $url = config('app.sirs_url').'/fo/index.php/Fasyankes';

        try
        {
            $client = new Client();
            $res = $client->request('PUT', $url, [
                    'headers' => $headers,
                    'json' => $data,
                ]);

            $content = json_decode($res->getBody()->getContents());
            echo $content->fasyankes[0]->message."\n";
        } catch (RequestException $e) {
            $response = Psr7\str($e->getResponse());
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }catch (\Exception $e){
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }
}
