<?php

namespace App\Console\Commands\DataGenerator;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Farmasi\ItemsTemplate;
use App\Models\Farmasi\Farmasi;
use App\Models\Farmasi\Items;
use App\Models\Farmasi\Kategori;
use App\Models\Farmasi\ItemsKategori;
use App\Models\Farmasi\ItemsFarmasi;



class FarmasiStokGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data-generator:farmasi-stok-generator';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'import item stok farmasi';

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
        echo "start\n";
        $farmasi_ids = Farmasi::whereIn('id',array(1,2))->get(); //gudang farmasi dan instalasi farmasi
        $itemsTemplates = ItemsTemplate::get();
        $i=0;
        $kadaluarsa = Carbon::now()->addYears(2);
        foreach ($itemsTemplates as $key => $itemsTemplate)
        {

            $this->createItemsFarmasi($itemsTemplate->id, 0, $itemsTemplate->slug, $farmasi_ids, $kadaluarsa->toDateTimeString());
            echo "done data ke-".++$i." \n";
        }
        echo "done \n";
    }

    public function createItemsFarmasi($item_template_id, $harga, $slug, $farmasi_ids, $kadaluarsa)
    {
        foreach ($farmasi_ids as $farmasi_id) {
            $item_farmasi = ItemsFarmasi::where('farmasi_id', $farmasi_id)->where('item_template_id', $item_template_id)->first();
            if(!$item_farmasi)
                $item_farmasi = new ItemsFarmasi;

            $item_farmasi->farmasi_id = $farmasi_id->id;
            $item_farmasi->item_template_id = $item_template_id;
            $item_farmasi->min_kadaluarsa = 30;
            $item_farmasi->min_stok = 50;
            $item_farmasi->slug =  $slug."-".$farmasi_id->id;
            $item_farmasi->save();

            $items = new Items;
            $items->item_farmasi_id = $item_farmasi->id;
            $items->farmasi_id = $farmasi_id->id;
            $items->kadaluarsa = $kadaluarsa;
            $items->status = 1;
            $items->jumlah = 1000;
            $items->save();
        }
    }

    public function createKategori($string_kategori, $array_kategori, $item_template_id)
    {
        $kategories = explode(';', $string_kategori);
        foreach ($kategories as $kategori) {
            if(!isset($array_kategori[$kategori])){
                $kategori_baru = new Kategori;
                $kategori_baru->nama = $kategori;
                $kategori_baru->created_by = 1;

                $slug = $this->generateSlug($kategori, 'kategori');

                $kategori_baru->slug = $slug;
                $kategori_baru->save();

                $array_kategori[$kategori] = $kategori_baru->id;
            }
            $item_kategori = new ItemsKategori;
            $item_kategori->kategori_id = $array_kategori[$kategori];
            $item_kategori->item_template_id = $item_template_id;
            $item_kategori->save();
        }
        $res['array_kategori'] = $array_kategori;
        return $res;
    }

    public function generateSlug($string, $type)
    {
        $slug = preg_replace('~[^\pL\d]+~u', '-', $string);
        $slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);// transliterate
        $slug = preg_replace('~[^-\w]+~', '', $slug); // remove unwanted characters
        $slug = trim($slug, '-'); // trim
        $slug = str_replace('%', '', $slug);
        $slug = preg_replace('~-+~', '-', $slug); // remove duplicate -
        $slug = strtolower($slug); // lowercase
        $i = 1;
        if($type = 'kategori'){
            while(!is_null(Kategori::where("slug",$slug)->first())){
                $i++;
                $slug = $slug."_".$i;
            }
        }else{
            while(!is_null(ItemsTemplate::where("slug",$slug)->first())){
                $i++;
                $slug = $slug."_".$i;
            }
        }
        return $slug;
    }
}
