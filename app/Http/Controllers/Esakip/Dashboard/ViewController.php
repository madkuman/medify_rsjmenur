<?php

namespace App\Http\Controllers\Esakip\Dashboard;

use App\Models\Esakip\Kategori;
use App\Models\Hospital\Grup;
use App\Models\Hospital\UserGroup;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class ViewController extends Controller
{
    public function index()
    {
        $data['sidebar_active'] = 'dashboard';
        $data['kategori'] = Kategori::all();
        $user_group = UserGroup::where('group_id',Grup::where('slug','e-sakip')->first()->id)->where('show',1)->get()->pluck('users_id')->toArray();
        $user = User::whereIn('id',$user_group)->where('fake_account',0)->get();
        $data['users'] = $user;
        $data['admin'] = app('App\Http\Controllers\Group\Members\ReadController')->checkIfUserAdminInGroup(Grup::where('slug','e-sakip')->first()->id,Auth::user()->id);
        return view('esakip.dashboard.index',$data);
    }
}
