<?php

namespace App\Http\Controllers\Aset;

use Illuminate\Http\Request;
use App\Models\Aset\Category;
use App\Models\Aset\ItemsLocation;
use App\Models\Aset\ItemsTemplate;

class APIController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function findCategory($query){
        $category = Category::where('name','like','%'.$query.'%')
            ->select('id','name')
            ->get();
        return json_encode($category);
    }

    public function getItems(Request $request)
    {
        $search = preg_replace("/[^[:alnum:][:space:]]/u", '', $request->get('keyword'));
                
        if(!empty($search)) {
            $item = ItemsTemplate::where('name', 'LIKE', "%".$search."%")->paginate(20);
        }
        else
            $item = ItemsTemplate::latest()->paginate(20);

        return $item;
    }

}
