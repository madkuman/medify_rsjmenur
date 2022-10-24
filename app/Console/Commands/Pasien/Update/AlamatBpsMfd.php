<?php

namespace App\Console\Commands\Pasien\Update;

use Illuminate\Console\Command;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7;
use Goutte\Client as GouetteClient;
use Symfony\Component\DomCrawler\Crawler;
use DB;

class AlamatBpsMfd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pasien:update-wilayah-bpjs-mfd {keyword}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update data alamat berdasarkan data BPS';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    protected $row = 1;
    protected $total_row = 0;
    protected $array_insert = [];
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
        try
        {
            $arguments = $this->arguments();
            $keyword = $arguments['keyword'];

            $url = 'https://mfdonline.bps.go.id/index.php?link=hasil_pencarian';
            $data['kata_kunci'] = $keyword;
            $data['pilihcari'] = 'desa';
            $client = new GuzzleClient();

            $res = $client->request('POST', $url, 
                [
                    \GuzzleHttp\RequestOptions::FORM_PARAMS => $data,
                ]
            );
            $html_string = $res->getBody()->getContents();

            
            $client_gou = new GouetteClient();
            $crawler = $client_gou->request('POST', $url, $data);

            $this->total_row = $crawler->filter('tr[class="table_content"]')->count();

            $crawler->filter('tr[class="table_content"]')->each(function ($node){
                $text = $node->text();
                $text = explode("\n", $text);

                $data = [];
                foreach($text as $item)
                {
                    $item_temp = preg_replace("/[^A-Za-z0-9 ]/", '', $item);
                    $item_temp = ltrim($item_temp);
                    $item_temp = str_replace("  ", "", $item_temp);
                    $item_temp = rtrim($item_temp);
                    $data[] = $item_temp;
                }

                $this->array_insert[] = array(
                        'kode_provinsi' => $data[2],
                        'provinsi' => $data[3],
                        'kode_kota' => $data[4],
                        'kota' => $data[5],
                        'kode_kecamatan' => $data[6],
                        'kecamatan' => $data[7],
                        'kode_kelurahan' => $data[8],
                        'kelurahan' => $data[9],
                        'kode_all' => $data[2].'-'.$data[4].'-'.$data[6].'-'.$data[8]
                    );

                $chunk = 5000;

                //echo "Done ".$this->row." / ".$this->total_row."\n";

                if($this->row < $this->total_row && $this->row % $chunk == 0)
                {
                    DB::connection('patients')->table('alamat_temp')->insert($this->array_insert);
                    $this->array_insert = [];

                    echo "INSERTING ".$this->row." / ".$this->total_row."================ \n";
                }
                elseif($this->row == $this->total_row)
                {
                    DB::connection('patients')->table('alamat_temp')->insert($this->array_insert);
                    $this->array_insert = [];

                    echo "INSERTING ".$this->row." / ".$this->total_row."================ \n";
                }

                $this->row++;
            });

            return 1;
        } catch (RequestException $e) {
            echo "ERROR ".$this->row." / ".$this->total_row."================ \n";
            //app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }catch (\Exception $e){
            echo "ERROR ".$this->row." / ".$this->total_row."================ \n";
            //app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }
}
