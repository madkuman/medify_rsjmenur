<?php

namespace App\Http\Controllers\Aset;

use Illuminate\Http\Request;
use Auth;
use Session;
use File;
use DataTables;

use App\Models\Aset\Supplier;
use App\Models\Aset\Transaction;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sidebar_active = 'supplier';
//        return view('admin.supplier',compact('supplier'));
        return view('aset.supplier.index',compact('sidebar_active'));

    }

    public function getJsonSupplier()
    {
        $supplier = Supplier::get(['id','name_perusahaan','phone_perusahaan','address_perusahaan','name_perwakilan','phone_perwakilan']);
        return DataTables::of($supplier)->make();
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
        $supplier = New Supplier();
        $supplier->name_perusahaan = $request->input('name_perusahaan');
        $supplier->address_perusahaan = $request->input('address_perusahaan');
        $supplier->phone_perusahaan = $request->input('phone_perusahaan');
        $supplier->npwp = $request->input('npwp');

        $supplier->name_perwakilan = $request->input('name_perwakilan');
        $supplier->phone_perwakilan = $request->input('phone_perwakilan');
        $supplier->description = $request->input('description');

        $supplier->users_id = Auth::user()->id;

        $supplier->save();

        if($request->file('link_gambar') && $request->input('input_gambar')){
            $source_img = $request->file('link_gambar');
            $data_gambar = $request->input('input_gambar');

            list($type, $data_gambar) = explode(';', $data_gambar);
            list(, $data_gambar)      = explode(',', $data_gambar);

            $nama_file = str_replace(' ', '-', $supplier->id.$supplier->name);
            $path = "uploads/attachment/DataItemsTemplate/original/";
            $pathThumbnail = "uploads/attachment/DataItemsTemplate/thumbnail/";
            if (!file_exists($path) && !is_dir($path)) {
                mkdir($path);         
            }
            if (!file_exists($pathThumbnail) && !is_dir($pathThumbnail)) {
                mkdir($pathThumbnail);         
            }

            $image = \Image::make($data_gambar);
            $width = $image->width();
            $height = $image->height();
            if($height<600){
                File::put( public_path($path.$nama_file . "." . $source_img->clientExtension()), (string) $image->encode());
//                $image->save(public_path().$path, $nama_file . "." . $source_img->clientExtension());
            }else{
                $pembagi = $height/600;
                $image = \Image::make($data_gambar);
                $image->resize($width/$pembagi,$height/$pembagi);
                File::put( public_path($path.$nama_file . "." . $source_img->clientExtension()), (string) $image->encode());
//                $image->save(public_path().$path, $nama_file . "." . $source_img->clientExtension());
            }

            if($height<300){
                File::put( public_path($pathThumbnail.$nama_file . "." . $source_img->clientExtension()), (string) $image->encode());
//                $image->save(public_path($pathThumbnail), $nama_file . "." . $source_img->clientExtension());
            }else{
                $pembagi = $height/300;
                $image = \Image::make($data_gambar);
                $image->resize($width/$pembagi,$height/$pembagi);
                File::put( public_path($pathThumbnail.$nama_file . "." . $source_img->clientExtension()), (string) $image->encode());
//                $image->save(public_path().$path, $nama_file . "." . $source_img->clientExtension());
            }
            $supplier->foto = $path.$nama_file . "." . $source_img->clientExtension();
            $supplier->save();
        }

        Session::flash('success', "Add Supplier Success");

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
        if($supplier = Supplier::where('id',$id)->first()){
            $sidebar_active = 'supplier';
            $items = [];
            return view('aset.supplier.detail',compact('supplier','sidebar_active','kategoritemplate','items'));
        }else{
            Session::flash('danger', "Slug Error");
        }

    }

    public function getJsonSupplierHistory($id)
    {
        if($supplier = Supplier::where('id',$id)->first()){
            $transaction = Transaction::where('supplier_id',$id)->with('user')->get();
            return DataTables::of($transaction)->make();
        }else{
            $transaction = [];
            return DataTables::of($transaction)->make();
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
        //
        if($supplier = Supplier::find($id)){
            $supplier->name_perusahaan = $request->input('name_perusahaan');
            $supplier->address_perusahaan = $request->input('address_perusahaan');
            $supplier->phone_perusahaan = $request->input('phone_perusahaan');
            $supplier->npwp = $request->input('npwp');

            $supplier->name_perwakilan = $request->input('name_perwakilan');
            $supplier->phone_perwakilan = $request->input('phone_perwakilan');
            $supplier->description = $request->input('description');

            if($request->file('link_gambar') && $request->input('input_gambar')){
                $source_img = $request->file('link_gambar');
                $data_gambar = $request->input('input_gambar');

                list($type, $data_gambar) = explode(';', $data_gambar);
                list(, $data_gambar)      = explode(',', $data_gambar);

                $nama_file = str_replace(' ', '-', $supplier->id.$supplier->name);
                $path = "attachment/DataSupplier/original/";
                $pathThumbnail = "attachment/DataSupplier/thumbnail/";

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
                $supplier->foto = $path.$nama_file . "." . $source_img->clientExtension();
            }

            $supplier->save();


            Session::flash('success', "Edit Supplier Success");
        }else{
            Session::flash('danger', "Edit Supplier Failed");
        }

        return redirect()->back();
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
        if($supplier = Supplier::find($id)) {
            if (File::exists($supplier->foto)) {
                File::delete($supplier->foto);
            }
            if (File::exists(str_replace("original","thumbnail",$supplier->foto))) {
                File::delete(str_replace("original","thumbnail",$supplier->foto));
            }
            $supplier->delete();
            Session::flash('success', "Delete Supplier Success");
        }else{
            Session::flash('danger', "Delete Supplier Failed");
        }

        return redirect()->route('supplier.index');
    }
}
