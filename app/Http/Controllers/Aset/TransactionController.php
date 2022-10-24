<?php

namespace App\Http\Controllers\Aset;

use App\Models\Aset\ItemsTemplate;
use Illuminate\Http\Request;
use Auth;
use Session;
use Carbon\Carbon;
use Storage;
use File;
use DataTables;
use DB;
use Excel;
use DOMPDF;

use App\Models\Aset\Transaction;
use App\Models\Aset\Supplier;
use App\Models\Aset\Items;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $supplier = Supplier::get();
        $itemstemplate = ItemsTemplate::get();
        $sidebar_active = 'pengadaan';
//        return view('admin.transaction',compact('transaction'));
        $po_available = app('App\Http\Controllers\Keuangan\PO\ReadController')->getActivePO('Umum');
        return view('aset.pengadaan.index',compact('sidebar_active','supplier','itemstemplate', 'po_available'));
    }

    public function getJsonTransaction(Request $request)
    {
        $transaction = Transaction::with('supplier')->with('user')->orderBy('transaction.date','desc');

        return DataTables::of($transaction)
            ->filter(function ($query) use ($request) {
                if($request->input('search')['value']){
                    $query->orWhere('kode', 'LIKE', "%".$request->input('search')['value']."%");
                    $query->orWhere('supplier.name_perusahaan', 'LIKE', "%".$request->input('search')['value']."%");
                    $query->orWhere('date', 'LIKE', "%".$request->input('search')['value']."%");
                    $query->orWhere('transaction.description', 'LIKE', "%".$request->input('search')['value']."%");
                    $query->orWhere('users.name', 'LIKE', "%".$request->input('search')['value']."%");
                    $query->orWhere('total_price', 'LIKE', "%".$request->input('search')['value']."%");
                }
                if ($request->input('total_minimal')) {
                    $query->where('total_price', '>=', $request->input('total_minimal'));
                }
                if ($request->input('total_maksimal')) {
                    $query->where('total_price', '<=', $request->input('total_maksimal'));
                }
                if ($request->input('cari_peyedia') && $request->input('cari_peyedia')!=0) {
                    $query->where('supplier_id', $request->input('cari_peyedia'));
                }

                if ($request->input('tanggal_awal')) {
                    $query->whereDate('date', '>=', $request->input('tanggal_awal'));
                }
                if ($request->input('tanggal_akhir')) {
                    $query->whereDate('date', '<=', $request->input('tanggal_akhir'));
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
        $itemstemplate = ItemsTemplate::get();
        $supplier = Supplier::get();
        return view('admin.transaction_create',compact('itemstemplate','supplier'));
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
        // dd($request->all())
        if(!$request->input('itemtemplate')){
            Session::flash('danger', "Transaction Table Kosong");
            return redirect()->back();
        }else{
            $now = Carbon::now();

            $transaction = New Transaction();
            $transaction->kode = str_replace(array('-',' ',':'),'',$now->toDateTimeString());
            $transaction->date = $request->input('date');
            $transaction->total_price = $request->input('total_transaction');
            $transaction->description = $request->input('description');
            $transaction->users_id = Auth::user()->id;

            if ($request->input('supplier') && $supplier = Supplier::find($request->input('supplier'))) {
                $transaction->supplier_id = $supplier->id;
            }

            $transaction->save();

            $id_template = $request->input('itemtemplate');
            $jumlah = $request->input('jumlah');
            $subtotal = $request->input('subtotal');
            $price = $request->input('total_price');
            $data_transactions = [];

            foreach ($id_template as $index=>$list_id) {
                $mini_transaction = array(
                    'id_template' => $id_template[$index],
                    'nama_template' => ItemsTemplate::find($id_template[$index])->name,
                    'subtotal' => $subtotal[$index],
                    'jumlah' => $jumlah[$index],
                    'harga_satuan' => $price[$index],
                );
                array_push($data_transactions,$mini_transaction);


                for ($i = 0; $i < $jumlah[$index]; $i++) {
                    $items = New Items();
                    $items->items_template_id = $id_template[$index];
                    $items->transaction_id = $transaction->id;
                    $items->price =  $price[$index];
                    $items->users_id = Auth::user()->id;
                    $items->save();
                    $items = Items::find($items->id);
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
                        'keterangan' => "New Items",
                    ];
                    Storage::append($namafile, json_encode($data));
                }
            }

            if($request->file('link_gambar')){
                $source_img = $request->file('link_gambar');
                $data_gambar = $source_img;

                $nama_file = str_replace(' ', '-', $transaction->kode);
                $path = "attachment/DataTransaction/original/";

                $image = \Image::make($data_gambar);
                File::put( public_path($path.$nama_file . "." . $source_img->clientExtension()), (string) $image->encode());

                $transaction->image_ori = $path.$nama_file . "." . $source_img->clientExtension();
            }

            $transaction->json = json_encode($data_transactions);
            $transaction->save();

            Session::flash('success', "Transaction Success");
            return redirect()->route('transaction.index');
        }

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
        //
        if($transaction = Transaction::where('kode',$id)->first()) {
            $supplier = Supplier::get();
            $itemstemplate = ItemsTemplate::get();

            $sidebar_active = 'pengadaan';

            return view('aset.pengadaan.detail',compact('supplier','itemstemplate','sidebar_active','transaction'));
        }else{
            Session::flash('danger', "Item Template Tidak Ada");
            return redirect()->back();
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
        //
        $itemstemplate = ItemsTemplate::get();
        $transaction = Transaction::find($id);
        return view('admin.transaction_edit',compact('itemstemplate','supplier','transaction'));

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
        //
        if(!$request->input('itemtemplate')){
            Session::flash('danger', "Table Transaksi Kosong");
            return redirect()->back();
        }else{
            if(!$transaction = Transaction::find($id)){
                Session::flash('danger', "Transaksi Tidak Ada");
                return redirect()->back();
            }
            $now = Carbon::now();

            $transaction->date = $request->input('date');
            $transaction->total_price = $request->input('total_transaction');
            $transaction->description = $request->input('description');

            if ($request->input('supplier') && $supplier = Supplier::find($request->input('supplier'))) {
                $transaction->supplier_id = $supplier->id;
            }

            $id_template = $request->input('itemtemplate');
            $jumlah = $request->input('jumlah');
            $subtotal = $request->input('subtotal');
            $price = $request->input('total_price');
            $before = $request->input('before');
            $data_transactions = [];

            $transactions = json_decode($transaction->json,true);
            $checklist = [];
            foreach ($id_template as $index=>$list_id) {
                $mini_transaction = array(
                    'id_template' => $id_template[$index],
                    'nama_template' => ItemsTemplate::find($id_template[$index])->name,
                    'subtotal' => $subtotal[$index],
                    'jumlah' => $jumlah[$index],
                    'harga_satuan' => $price[$index],
                );
                array_push($data_transactions,$mini_transaction);

                if (isset($before[$index])) {
                    $checklist[$before[$index]] = 1;
                    $transaksi = $transactions[$before[$index]];
                    if($transaksi['id_template']==$id_template[$index]){
                        if ($transaksi['harga_satuan'] != $price[$index]) {
                            Items::where('items_template_id',$id_template[$index])->where('transaction_id',$transaction->id)->update(['price' => $price[$index]]);
                        }
                        if ($transaksi['jumlah'] < $jumlah[$index]) {
                            $jumlah_tambahan = $jumlah[$index]-$transaksi['jumlah'];
                            for ($i = 0; $i < $jumlah_tambahan; $i++) {
                                $items = New Items();
                                $items->items_template_id = $id_template[$index];
                                $items->transaction_id = $transaction->id;
                                $items->price =  $price[$index];
                                $items->users_id = Auth::user()->id;
                                $items->save();
                                $items = Items::find($items->id);
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
                                    'keterangan' => "New Items",
                                ];
                                Storage::append($namafile, json_encode($data));
                            }
                        }elseif($transaksi['jumlah'] > $jumlah[$index]){
                            $jumlah_pengurangan = $transaksi['jumlah']-$jumlah[$index];
                            $total = Items::where('items_template_id',$id_template[$index])->where('transaction_id',$transaction->id)->count();
                            if ($total + $jumlah_pengurangan > $jumlah[$index]) {
                                Items::where('items_template_id', $id_template[$index])->where('transaction_id', $transaction->id)->orderBy('updated_at', 'desc')->take($jumlah_pengurangan)->delete();
                            }
                        }
                    }else{
                        Items::where('items_template_id',$transaksi['id_template'])->where('transaction_id', $transaction->id)->orderBy('updated_at', 'desc')->take($transaksi['jumlah'])->delete();
                        for ($i = 0; $i < $jumlah[$index]; $i++) {
                            $items = New Items();
                            $items->items_template_id = $id_template[$index];
                            $items->transaction_id = $transaction->id;
                            $items->price =  $price[$index];
                            $items->users_id = Auth::user()->id;
                            $items->save();
                            $items = Items::find($items->id);
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
                                'keterangan' => "New Items",
                            ];
                            Storage::append($namafile, json_encode($data));
                        }
                    }
                }else{
                    for ($i = 0; $i < $jumlah[$index]; $i++) {
                        $items = New Items();
                        $items->items_template_id = $id_template[$index];
                        $items->transaction_id = $transaction->id;
                        $items->price =  $price[$index];
                        $items->users_id = Auth::user()->id;
                        $items->save();
                        $items = Items::find($items->id);
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
                            'keterangan' => "New Items",
                        ];
                        Storage::append($namafile, json_encode($data));
                    }
                }
            }

            foreach ($transactions as $key=>$list_transaction){
                if(!isset($checklist[$key])){
                    Items::where('items_template_id', $list_transaction['id_template'])->where('transaction_id', $transaction->id)->orderBy('updated_at', 'desc')->take($list_transaction['jumlah'])->delete();
                }
            }

            if($request->file('link_gambar')){
                $source_img = $request->file('link_gambar');
                $data_gambar = $source_img;

                $nama_file = str_replace(' ', '-', $transaction->kode);
                $path = "attachment/DataTransaction/original/";

                $image = \Image::make($data_gambar);
                File::put( public_path($path.$nama_file . "." . $source_img->clientExtension()), (string) $image->encode());

                $transaction->image_ori = $path.$nama_file . "." . $source_img->clientExtension();
            }

            $transaction->json = json_encode($data_transactions);

                $transaction->save();

            Session::flash('success', "Transaction Success");
            return redirect()->route('transaction.index');
        }
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
//
        if($transaction = Transaction::find($id)) {

            if (File::exists($transaction->image_ori)) {
                File::delete($transaction->image_ori);
            }

            Items::where('transaction_id', $transaction->id)->delete();
            $transaction->delete();
            Session::flash('success', "Delete Transaction Success");
        }else{
            Session::flash('danger', "Delete Transaction Failed");
        }

        return redirect()->route('transaction.index');
    }

    public function addItems()
    {
        $itemstemplate = ItemsTemplate::get();
        return view('aset.pengadaan.components.add-items',compact('itemstemplate'));
    }

    public function addItemsPO($po_id)
    {
        $po = json_decode(app('App\Http\Controllers\Keuangan\PO\ReadController')->getSingle($po_id));
        return view('aset.pengadaan.components.add-items-by-po',compact('po'));
    }

    public function transactionPrint($id){
        if($transaction = Transaction::where('kode',$id)->first()) {
            $pdf = DOMPDF::loadView('aset.pengadaan.download',[
                'transaction' => $transaction,
            ]);
            return $pdf->download("PENGADAAN-$transaction->kode.pdf");

        }else{
            Session::flash('danger', "Item Template Tidak Ada");
            return redirect()->back();
        }
    }



}
