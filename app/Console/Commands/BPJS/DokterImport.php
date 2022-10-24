<?php

namespace App\Console\Commands\BPJS;

use Illuminate\Console\Command;
use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7;
use App\Models\RawatJalan\Dokter;

class DokterImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bpjs:dokter-import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $today = Carbon::now()->format('Y-m-d');
        $header = app('App\Http\Controllers\BPJS\API\Request\RequestController')->getHeader('vclaim');
        $url = app('App\Http\Controllers\BPJS\API\Request\RequestController')->getUrl();
        $url.='/referensi/dokter/pelayanan/1/tglPelayanan/'.$today.'/Spesialis/ORT';

        try
        {
            $client = new GuzzleClient(['headers' => $header]);


            $res = $client->request('GET', $url,  
                [
                    'headers' => ['Content-Type' => 'application/json'], 
                    'Accept' => 'application/json',
                    \GuzzleHttp\RequestOptions::JSON => [],
                ]);


            $content = $res->getBody()->getContents();
            $content = json_decode($content);
            echo "found :".count($content->response->list);
            $dokters = [];
            foreach($content->response->list as $item)
            {
                $dokter = Dokter::where('bpjs_kode_dpjp',$item->kode)->first();
                if(empty($dokter->id)) $dokter = new Dokter;
                
                $dokter->name = $item->nama;
                $dokter->bpjs_kode_dpjp = $item->kode;
                $dokter->bpjs_kode_dpjp_text = $item->nama;
                $dokter->save();
            }

            echo " -- done";

        } catch (RequestException $e) {
            echo 'Error Request--';
            return null;
        }catch (\Exception $e){
            dd($e);
            return null;
        }
    }
}
