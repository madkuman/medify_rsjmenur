<?php

namespace App\Http\Controllers\Aset;

use App\Models\Aset\CategoryItemsTemplate;
use Illuminate\Http\Request;
use Auth;
use Session;
use DataTables;

use App\Models\Aset\Category;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sidebar_active = 'kategori';
//        return view('admin.category',compact('category'));
        return view('aset.category.index',compact('sidebar_active'));

    }

    public function getJsonCategory()
    {
        $category = Category::with('user')->get();
        return DataTables::of($category)->make();
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
        if(Category::where('name',trim($request->input('name')))->first()){
            Session::flash('danger', "Add Category Failed, Nama pernah digunakan");
        }else{
            $category = New Category();
            $category->name = $request->input('name');
            $category->description = $request->input('description');
            $category->slug = str_slug($category->name);
            $category->users_id = Auth::user()->id;
            $category->save();
        }

        Session::flash('success', "Add Category Success");
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
        if($kategori = Category::where('slug',$id)->first()){
            $kategoritemplate = CategoryItemsTemplate::where('category_id', $kategori->id)->get();
            $sidebar_active = 'kategori';
            return view('aset.category.detail',compact('kategori','sidebar_active','kategoritemplate'));
        }else{
            Session::flash('danger', "Slug Error");
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
        if($category = Category::find($id)){
            if($category->name!=$request->input('name') && Category::where('name',trim($request->input('name')))->first()){
                Session::flash('danger', "Edit Category Failed, Nama pernah digunakan");
                return redirect()->back();
            }
            $category->name = $request->input('name');
            $category->description = $request->input('description');
            $category->slug = str_slug($category->name);
            $category->save();
            Session::flash('success', "Edit Category Success");
        }else{
            Session::flash('danger', "Edit Category Failed");
        }

        return redirect()->route('category.show',$category->slug);
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
        if($category = Category::find($id)) {
            CategoryItemsTemplate::where('category_id', $category->id)->delete();
            $category->delete();
            Session::flash('success', "Delete Category Success");
        }else{
            Session::flash('danger', "Delete Category Failed");
        }

        return redirect()->route('category.index');
    }
}
