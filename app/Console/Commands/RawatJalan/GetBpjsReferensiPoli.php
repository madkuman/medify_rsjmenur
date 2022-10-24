<?php

namespace App\Console\Commands\RawatJalan;

use Illuminate\Console\Command;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7;
use App\Models\RawatJalan\PoliklinikBpjs;

class GetBpjsReferensiPoli extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rawatjalan:get-bpjs-referensi-poli {start_index=0}';

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
        $arguments = $this->arguments();
        $start_index = $arguments['start_index'];

        $client = new GuzzleClient();

        $combinations = [];
        $chars = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
        $total_letters = count($chars);

        for($i = 0;$i<$total_letters;$i++){
            for($j = 0;$j<$total_letters;$j++){
                for($k = 0;$k<$total_letters;$k++){
                    $val = $chars[$i].$chars[$j].$chars[$k];
                    array_push($combinations,$val);
                }
            }
        }

        foreach ($combinations as $index => $keyword) {
            if($index < $start_index) continue;
            echo $index.'---'.$keyword;
            $content = $this->callBPJSAPI($keyword);
            $code = $content->metaData->code ?? null;
            if($code == 200)
            {
                echo count($content->response->poli).' Found';
                foreach($content->response->poli as $poli)
                {
                    $poli_old = PoliklinikBpjs::where('kode',$poli->kode)->first();
                    if(!empty($poli_old->id)) continue;

                    $new_poli = new PoliklinikBpjs;
                    $new_poli->kode = $poli->kode;
                    $new_poli->nama = $poli->nama;
                    $new_poli->save();
                }
            }
            else echo "0 Found";

            echo "\n";

        }
    }

    private function callBPJSAPI($keyword)
    {
        $header = app('App\Http\Controllers\BPJS\API\Request\RequestController')->getHeader('vclaim');
        $url = app('App\Http\Controllers\BPJS\API\Request\RequestController')->getUrl();
        $url.='/referensi/poli';

        echo '--Make Request--';

        try
        {
            $client = new GuzzleClient(['headers' => $header]);


            $res = $client->request('GET', $url.'/'.$keyword,  
            [
                'headers' => ['Content-Type' => 'application/json'], 
                'Accept' => 'application/json',
                \GuzzleHttp\RequestOptions::JSON => [],
            ]);


            $content = $res->getBody()->getContents();
            $content = json_decode($content);
            return $content;
        } catch (RequestException $e) {
            echo 'Error Request--';
            return null;
        }catch (\Exception $e){
            echo 'Error Exception--';
            return null;
        }
    }

}
