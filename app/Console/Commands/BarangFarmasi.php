<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Farmasi\Farmasi;
use App\Models\Farmasi\ItemsFarmasi;
use App\Models\Gudang\ItemsTemplate;
use App\Models\Hospital\Grup;
use App\Models\Hospital\UserGroup;
use App\User;
use Auth;
use DB;
use Carbon\Carbon;
use Bugsnag;

class BarangFarmasi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'farmasi:barang';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Barang Expired dan Low Stok Tiap Hari';

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
        /*
        $user = User::find(10);
        $user->avatar_big = Carbon::now();
        $user->save();
        
        $detail = new TagihanDetail;
        $detail->kasus_tagihan_id = 141;
        $detail->save();
        */
        try
        {
            $func = function($value) {
                return $value->id;
            };

            //Gudang
            $group_members = UserGroup::where('group_id', 7)->where('invitation', 1)->pluck('users_id');
            //dd($group_members);

            $query = DB::connection('gudang')->select('SELECT * FROM item_template WHERE id IN 
                        (SELECT item.id FROM 
                        (SELECT item_template.id, item_template.min_stok, SUM(items.jumlah_sedia) AS stok FROM items, item_template WHERE items.kadaluarsa > CURRENT_TIMESTAMP() AND items.deleted_at IS NULL AND items.item_template_id = item_template.id GROUP BY item_template.id) AS item WHERE item.stok < item.min_stok)');
            $id = array_map($func, $query);            
            $stok = ItemsTemplate::whereIn('id',$id)->get();
            //dd($stok);

            foreach ($stok as $row) {
                $desc = 'Barang '.$row->nama.' milik Gudang akan habis';
                $url = 'gudang/item/'.$row->slug;
                foreach ($group_members as $member) {
                    $notify = app('App\Http\Controllers\Users\Notification\CreateController')->create($member, 1, $desc, $url);
                }   
            }

            $query = DB::connection('gudang')->select('SELECT * FROM item_template WHERE id IN
            (SELECT item.id FROM
            (SELECT item_template.id, item_template.min_kadaluarsa, DATEDIFF(MIN(items.kadaluarsa),CURDATE()) AS expired FROM items,item_template WHERE items.jumlah_sedia > 0 AND items.kadaluarsa > CURDATE() AND items.deleted_at IS NULL AND items.item_template_id = item_template.id GROUP BY item_template.id) AS item WHERE item.min_kadaluarsa > item.expired)');
            $id = array_map($func, $query);
            $expired = ItemsTemplate::whereIn('id',$id)->get();

            foreach ($expired as $row) {
                $desc = 'Barang '.$row->nama.' milik Gudang akan kadaluarsa';
                $url = 'gudang/item/'.$row->slug;
                foreach ($group_members as $member) {
                    $notify = app('App\Http\Controllers\Users\Notification\CreateController')->create($member, 1, $desc, $url);
                }   
            }

            //Farmasi
            $farmasi = Farmasi::where('jenis', '<', 3)->get();
            foreach ($farmasi as $farm) {
                $group_members = UserGroup::where('group_id', $farm->group_id)->where('invitation', 1)->pluck('users_id');

                $query = DB::connection('farmasi')->select('SELECT * FROM items_farmasi WHERE id IN 
                            (SELECT item.id FROM 
                            (SELECT items_farmasi.id, items_farmasi.min_stok, SUM(items.jumlah_sedia) AS stok FROM items, items_farmasi WHERE items.kadaluarsa > CURRENT_TIMESTAMP() AND items.deleted_at IS NULL AND items.item_farmasi_id = items_farmasi.id GROUP BY items_farmasi.id) AS item WHERE item.stok < item.min_stok)');
                $id = array_map($func, $query);
                $stok = ItemsFarmasi::whereIn('id',$id)->where('farmasi_id',$farm->id)->get();

                foreach ($stok as $row) {
                    $desc = 'Barang '.$row->item_detail->nama.' milik '.$farm->nama.' akan habis';
                    $url = 'farmasi/'.$farm->slug.'/item/'.$row->slug;
                    foreach ($group_members as $member) {
                        $notify = app('App\Http\Controllers\Users\Notification\CreateController')->create($member, 1, $desc, $url);
                    }   
                }

                $query = DB::connection('farmasi')->select('SELECT * FROM items_farmasi WHERE id IN
                (SELECT item.id FROM
                (SELECT items_farmasi.id, items_farmasi.min_kadaluarsa, DATEDIFF(MIN(items.kadaluarsa),CURDATE()) AS expired FROM items,items_farmasi WHERE items.jumlah_sedia > 0 AND items.kadaluarsa > CURDATE() AND items.deleted_at IS NULL AND items.item_farmasi_id = items_farmasi.id GROUP BY items_farmasi.id) AS item WHERE item.min_kadaluarsa > item.expired)');
                $id = array_map($func, $query);
                $expired = ItemsFarmasi::whereIn('id',$id)->where('farmasi_id',$farm->id)->get();
                
                foreach ($expired as $row) {
                    $desc = 'Barang '.$row->item_detail->nama.' milik '.$farm->nama.' akan kadaluarsa';
                    $url = 'farmasi/'.$farm->slug.'/item/'.$row->slug;
                    foreach ($group_members as $member) {
                        $notify = app('App\Http\Controllers\Users\Notification\CreateController')->create($member, 1, $desc, $url);
                    }   
                }                
            }
            


        }
        catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }

    }
}
