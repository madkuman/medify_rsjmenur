<?php

namespace App\Http\Controllers\Aset;

use App\Models\Aset\Category;
use App\Models\Aset\Transaction;
use Illuminate\Http\Request;
use Auth;
use Session;
use File;
use Storage;
use Carbon\Carbon;
use DataTables;
use DB;

use App\Models\Aset\ItemsTemplate;
use App\Models\Aset\ItemsCondition;
use App\Models\Aset\ItemsStatus;
use App\Models\Aset\ItemsLocation;
use App\Models\Aset\Items;
use App\Models\Aset\CategoryItemsTemplate;

class ItemsTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
//        $itemtemplate = ItemsTemplate::get();
        $category = Category::get();
        $sidebar_active = 'item';
//        return view('admin.itemtemplate',compact('itemtemplate'));
        return view('aset.item.index',compact('sidebar_active','category'));
        //
    }

    public function getJsonItemsTemplate(Request $request)
    {
        $itemtemplate = ItemsTemplate::with('items')->with('category');
        return DataTables::of($itemtemplate)
        ->filter(function ($query) use ($request) {
            if($request->input('search')['value']){
                $query->orWhere('name', 'LIKE', "%".$request->input('search')['value']."%");
                $query->orWhere('merk', 'LIKE', "%".$request->input('search')['value']."%");
                $query->orWhere('model', 'LIKE', "%".$request->input('search')['value']."%");
                $query->orWhere('satuan', 'LIKE', "%".$request->input('search')['value']."%");
                $query->orWhere('price', 'LIKE', "%".$request->input('search')['value']."%");
            }
            if ($request->input('nama')) {
                $query->where('name', 'like', "%{$request->input('nama')}%");
            }
            if ($request->input('merk')) {
                $query->where('merk', 'like', "%{$request->input('merk')}%");
            }
            if ($request->input('model')) {
                $query->where('model', 'like', "%{$request->input('model')}%");
            }
            if ($request->input('satuan')) {
                $query->where('satuan', 'like', "%{$request->input('satuan')}%");
            }
            if ($request->input('harga_minimal')) {
                $query->where('price', '>=', $request->input('harga_minimal'));
            }
            if ($request->input('harga_maksimal')) {
                $query->where('price', '<=', $request->input('harga_maksimal'));
            }
            if ($request->input('kategori') && $request->input('kategori')!=0) {
                $query->whereHas('category', function($q)use($request){
                    $q->where('category.id', $request->input('kategori'));
                })->get();
            }
            if ($request->input('stok_minimal')) {
                $query->has('items', '>=', $request->input('stok_minimal'));
            }
            if ($request->input('stok_maksimal')) {
                $query->has('items', '<=', $request->input('stok_maksimal'));
            }

        })
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//
        $price = (int)str_replace(".", "", str_replace("Rp. ", "", $request->input('price')));

        $itemtemplate = New ItemsTemplate();
        $itemtemplate->name = $request->input('name');
        $itemtemplate->slug = str_slug($itemtemplate->name.'-'.$itemtemplate->merk.'-'.$itemtemplate->model);
        $itemtemplate->merk = $request->input('merk');
        $itemtemplate->model = $request->input('model');
        $itemtemplate->price = $price;
        $itemtemplate->satuan = $request->input('satuan');
        $itemtemplate->description = $request->input('description');
        $itemtemplate->users_id = Auth::user()->id;

        $itemtemplate->save();

        if ($request->input('kategori')) {
            foreach ($request->input('kategori') as $list_category){
                if(!$category = Category::where('name',$list_category)->first()){
                    $category = New Category();
                    $category->name = $list_category;
                    $category->description = $request->input('description');
                    $category->slug = str_slug($category->name);
                    $category->users_id = Auth::user()->id;
                    $category->save();
                }
                if(!CategoryItemsTemplate::where('category_id',$category->id)->where('items_template_id',$itemtemplate->id)->first()){
                    $categoryitemstemplate = New CategoryItemsTemplate();
                    $categoryitemstemplate->category_id = $category->id;
                    $categoryitemstemplate->items_template_id = $itemtemplate->id;
                    $categoryitemstemplate->users_id = Auth::user()->id;
                    $categoryitemstemplate->save();
                }
            }
        }

        if($request->file('link_gambar')){
            $source_img = $request->file('link_gambar');

            $nama_file = str_replace(' ', '-', $itemtemplate->id.$itemtemplate->name);
            $path = "uploads/aset/original/";
            $pathThumbnail = "uploads/aset/thumbnail/";
            if (!file_exists($path) && !is_dir($path)) {
                mkdir($path);         
            }
            if (!file_exists($pathThumbnail) && !is_dir($pathThumbnail)) {
                mkdir($pathThumbnail);         
            }

            $image = \Image::make($source_img);
            $width = $image->width();
            $height = $image->height();
            if($height<1000){
                File::put( public_path($path.$nama_file . "." . $source_img->clientExtension()), (string) $image->encode());
//                $image->save(public_path().$path, $nama_file . "." . $source_img->clientExtension());
            }else{
                $pembagi = $height/1000;
                $image = \Image::make($source_img);
                $image->resize($width/$pembagi,$height/$pembagi);
                File::put( public_path($path.$nama_file . "." . $source_img->clientExtension()), (string) $image->encode());
//                $image->save(public_path().$path, $nama_file . "." . $source_img->clientExtension());
            }

            if($height<300){
                File::put( public_path($pathThumbnail.$nama_file . "." . $source_img->clientExtension()), (string) $image->encode());
//                $image->save(public_path($pathThumbnail), $nama_file . "." . $source_img->clientExtension());
            }else{
                $pembagi = $height/300;
                $image = \Image::make($source_img);
                $image->resize($width/$pembagi,$height/$pembagi);
                File::put( public_path($pathThumbnail.$nama_file . "." . $source_img->clientExtension()), (string) $image->encode());
//                $image->save(public_path().$path, $nama_file . "." . $source_img->clientExtension());
            }
            $itemtemplate->image_ori = $path.$nama_file . "." . $source_img->clientExtension();
            $itemtemplate->image_thumb = $path.$nama_file . "." . $source_img->clientExtension();
            $itemtemplate->save();
        }

        Session::flash('success', "Add Item Template Success");

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $category = Category::get();
        if($itemtemplate = ItemsTemplate::where('slug',$id)->first()) {
            $sidebar_active = 'item';
            $items = Items::where('items_template_id', $itemtemplate->id)->get();
            return view('aset.item.detail',compact('items','sidebar_active','itemtemplate','category'));
        }else{
            Session::flash('danger', "Item Template Tidak Ada");
            return redirect()->back();
        }
    }

    public function getJsonItems($id)
    {
        if($itemtemplate = ItemsTemplate::where('slug',$id)->first()){
            $items = Items::where('items_template_id', $itemtemplate->id)->with('itemstemplate')->with('itemscondition')->with('itemsstatus')->with('user')->get();
            return DataTables::of($items)->make();
        }else{
            $items = [];
            return DataTables::of($items)->make();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $price = (int)str_replace(".", "", str_replace("Rp. ", "", $request->input('price')));

        if($itemtemplate = ItemsTemplate::find($id)){
            $itemtemplate->name = $request->input('name');
            $itemtemplate->slug = str_slug($itemtemplate->name.'-'.$itemtemplate->merk.'-'.$itemtemplate->model);
            $itemtemplate->merk = $request->input('merk');
            $itemtemplate->model = $request->input('model');
            $itemtemplate->price = $price;
            $itemtemplate->satuan = $request->input('satuan');
            $itemtemplate->description = $request->input('description');

            if($request->file('link_gambar')){
                $source_img = $request->file('link_gambar');
                $data_gambar= $source_img;
                $nama_file = str_replace(' ', '-', $itemtemplate->id.$itemtemplate->name);
                $path = "uploads/aset/original/";
                $pathThumbnail = "uploads/aset/thumbnail/";

                $image = \Image::make($data_gambar);
                $width = $image->width();
                $height = $image->height();
                if($height<1000){
                    File::put( public_path($path.$nama_file . "." . $source_img->clientExtension()), (string) $image->encode());
                }else{
                    $pembagi = $height/1000;
                    $image = \Image::make($data_gambar);
                    $image->resize($width/$pembagi,$height/$pembagi);
                    File::put( public_path($path.$nama_file . "." . $source_img->clientExtension()), (string) $image->encode());
                }

                if($height<300){
                    File::put( public_path($pathThumbnail.$nama_file . "." . $source_img->clientExtension()), (string) $image->encode());
                }else{
                    $pembagi = $height/300;
                    $image = \Image::make($data_gambar);
                    $image->resize($width/$pembagi,$height/$pembagi);
                    File::put( public_path($pathThumbnail.$nama_file . "." . $source_img->clientExtension()), (string) $image->encode());
                }
                $itemtemplate->image_ori = $path.$nama_file . "." . $source_img->clientExtension();
                $itemtemplate->image_thumb = $path.$nama_file . "." . $source_img->clientExtension();
            }

            if ($request->input('kategori')) {
                CategoryItemsTemplate::where('items_template_id', $itemtemplate->id)->delete();
                foreach ($request->input('kategori') as $list_category){
                    if(!$category = Category::where('name',$list_category)->first()){
                        $category = New Category();
                        $category->name = $list_category;
                        $category->description = $request->input('description');
                        $category->slug = str_slug($category->name);
                        $category->users_id = Auth::user()->id;
                        $category->save();
                    }
                    if(!CategoryItemsTemplate::where('category_id',$category->id)->where('items_template_id',$itemtemplate->id)->first()){
                        $categoryitemstemplate = New CategoryItemsTemplate();
                        $categoryitemstemplate->category_id = $category->id;
                        $categoryitemstemplate->items_template_id = $itemtemplate->id;
                        $categoryitemstemplate->users_id = Auth::user()->id;
                        $categoryitemstemplate->save();
                    }
                }
            }

            $itemtemplate->save();


            Session::flash('success', "Edit Item Template Success");
        }else{
            Session::flash('danger', "Edit Item Template Failed");
        }

        return redirect()->route('items_template.show',$itemtemplate->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if($itemtemplate = ItemsTemplate::find($id)) {
            CategoryItemsTemplate::where('items_template_id', $itemtemplate->id)->delete();

            if (File::exists($itemtemplate->image_ori)) {
                File::delete($itemtemplate->image_ori);
            }
            if (File::exists($itemtemplate->image_thumb)) {
                File::delete($itemtemplate->image_thumb);
            }
            $itemtemplate->delete();
            Session::flash('success', "Delete Item Template Success");
        }else{
            Session::flash('danger', "Delete Item Template Failed");
        }

        return redirect()->route('items_template.index');
    }

    public function itemsCreate(Request $request, $id_items)
    {
        $price = (int)str_replace(".", "", str_replace("Rp. ", "", $request->input('price')));
        if ($items = Items::find($id_items)) {
            for ($i = 0; $i < $request->input('jumlah'); $i++) {
                $items = New Items();
                $items->items_template_id = $id_items;
                $items->price =  $price;
                $items->users_id = Auth::user()->id;
                $items->save();
            }
            Session::flash('success', "Add Items Success");
        }
        return redirect()->back();
    }

    public function itemsUpdate(Request $request,$id_items){
        $now = Carbon::now();
        $items = Items::find($id_items);
        if($items){
            $price = (int)str_replace(".", "", str_replace("Rp. ", "", $request->input('price')));

            $items->description = $request->input('description');
            $items->condition = $request->input('condition');
            $items->status = $request->input('status');
            $items->location = $request->input('location');
            $items->price = $price;

            if(!$itemslocation = ItemsLocation::where('name', $items->location)->first()){
                $itemslocation = New ItemsLocation();
                $itemslocation->name = $items->location;
                $itemslocation->save();
            }

            if($request->file('link_gambar')){
                $source_img = $request->file('link_gambar');
                $data_gambar = $source_img;

                $nama_file = str_replace(' ', '-', $items->itemstemplate->name.$items->id);
                $path = "attachment/DataItems/original/";
                $pathThumbnail = "attachment/DataItems/thumbnail/";

                $image = \Image::make($data_gambar);
                $width = $image->width();
                $height = $image->height();
                if($height<1000){
                    File::put( public_path($path.$nama_file . "." . $source_img->clientExtension()), (string) $image->encode());
                }else{
                    $pembagi = $height/1000;
                    $image = \Image::make($data_gambar);
                    $image->resize($width/$pembagi,$height/$pembagi);
                    File::put( public_path($path.$nama_file . "." . $source_img->clientExtension()), (string) $image->encode());
                }

                if($height<300){
                    File::put( public_path($pathThumbnail.$nama_file . "." . $source_img->clientExtension()), (string) $image->encode());
                }else{
                    $pembagi = $height/300;
                    $image = \Image::make($data_gambar);
                    $image->resize($width/$pembagi,$height/$pembagi);
                    File::put( public_path($pathThumbnail.$nama_file . "." . $source_img->clientExtension()), (string) $image->encode());
                }
                $items->image_ori = $path.$nama_file . "." . $source_img->clientExtension();
                $items->image_thumb = $path.$nama_file . "." . $source_img->clientExtension();
            }

            $items->save();

            $namafile="/LogItems/$items->id.txt";
            $data = [
                'kode' => str_replace(array('-',' ',':'),'',$now->toDateTimeString()).$items->id,
                'items_id' => $items->id,
                'items_template_id' => $items->items_template_id,
                'transaction_id' => $items->transaction_id,
                'tanggal' =>$now->toDateTimeString(),
                'status' => $items->itemsstatus->name,
                'condition' => $items->itemscondition->name,
                'price' => $items->price,
                'location' => $items->location,
                'description' => $items->description,
                'email' =>Auth::user()->email,
                'keterangan' => "Edit Items",
            ];
            Storage::append($namafile, json_encode($data));

            Session::flash('success', "Update Items Success");

        }else{
            Session::flash('danger', "Update Items Failed");
        }

        return redirect()->back();
    }

    public function itemsDelete(Request $request, $id_items){
        if( $items = Items::find($id_items)){
            $now = Carbon::now();
            $itemtemplate = ItemsTemplate::find($items->items_template_id);
            $namafile="/LogItems/$items->id.txt";
            $data = [
                'kode' => str_replace(array('-',' ',':'),'',$now->toDateTimeString()).$items->id,
                'items_id' => $items->id,
                'items_template_id' => $items->items_template_id,
                'transaction_id' => $items->transaction_id,
                'tanggal' =>$now->toDateTimeString(),
                'status' => $items->itemsstatus->name,
                'condition' => $items->itemscondition->name,
                'price' => $items->price,
                'location' => $items->location,
                'description' => $items->description,
                'email' =>Auth::user()->email,
                'keterangan' => "Delete Items",
            ];
            Storage::append($namafile, json_encode($data));

            if (File::exists($items->image_ori)) {
                File::delete($items->image_ori);
            }
            if (File::exists($items->image_thumb)) {
                File::delete($items->image_thumb);
            }

            $items->delete();

            Session::flash('success', "Delete Items Success");
            return redirect()->route('items_template.show',$itemtemplate->slug);
        }else{
            Session::flash('danger', "Delete Items Failed");
        }
        return redirect()->back();
    }

    public function itemsHistory($id_items){
        if($items = Items::find($id_items)){
            $sidebar_active = 'item';
            $itemslocation = ItemsLocation::get();
            $itemsstatus = ItemsStatus::get();
            $itemscondition = ItemsCondition::get();
            $itemtemplate = ItemsTemplate::find($items->items_template_id);
            $namafile="/LogItems/$items->id.txt";
            $history = [];

            if(Storage::exists($namafile)){
                $history = explode("\n", Storage::get($namafile));
            }
            $history = array_reverse($history);
            return view('aset.item.log',compact('history','sidebar_active','itemslocation','itemscondition','itemsstatus','items','itemtemplate'));
        }
    }

    public function getJsonHistoryItems($id_items)
    {
        if($items = Items::find($id_items)){
            $namafile="/LogItems/$items->id.txt";
            $history = [];
            $logs = [];

            if(Storage::exists($namafile)){
                $history = explode("\n", Storage::get($namafile));
            }
            $history = array_reverse($history);
            foreach ($history as $list){
                array_push($logs,json_decode($list));
            }
            return DataTables::of($logs)->make();
        }else{
            $items = [];
            return DataTables::of($items)->make();
        }
    }

    public function itemsTransaction($id_transaction)
    {
        if(Transaction::find($id_transaction)){
            $items = Items::where('transaction_id', $id_transaction)->get();
            $itemslocation = ItemsLocation::get();
            $itemsstatus = ItemsStatus::get();
            $itemscondition = ItemsCondition::get();
            return view('admin.items',compact('items','itemscondition','itemslocation','itemsstatus'));
        }else{
            Session::flash('danger', "No Item Transaction");
            return redirect()->back();
        }
    }

}
