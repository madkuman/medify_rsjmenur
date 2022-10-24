<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Hospital\Grup;
use App\Models\Hospital\UserGroup;
use App\User;
use Auth;

class CheckModule
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        if(config('app.check_module')){
            $members = UserGroup::where('users_id', Auth::user()->id)->where('invitation', 1)->has('grup')->pluck('group_id');
            $modules_url = [];

            //RESTRICT BPJS
            if (strpos($request->path(), 'bpjs') !== false ) {
                if (strpos($request->path(), 'bpjs/approve') !== false ) {
                    $grup_bpjs = Grup::where('slug', 'bpjs')->first();
                    $as_admin = UserGroup::where('users_id', Auth::user()->id)->where('admin', 1)->has('grup')->pluck('group_id')->toArray();
                    if (in_array($grup_bpjs->id, $as_admin))
                        return $next($request);
                    else abort(401);
                }
                else{
                    return $next($request);
                }
            }

            if (!empty($members)) {
                foreach ($members as $key => $value) {
                    $modules_url[$key] = Grup::where('id', $value)->select('url', 'slug')->first();
                }
                foreach ($modules_url as $url) {
                    if (!empty($url['url']) && !empty($url['slug'])) {
                        if (strpos($request->path(), $url['url']) !== false || strpos($request->path(), $url['slug']) !== false) {
                            return $next($request);
                        }
                    }
                }
            }

            //BYPASS KEPEGAWAIAN
            if (strpos($request->path(), 'kepegawaian/pegawai') !== false ) {
                if ($request->has('edit')) {
                    if ($request->get('edit') == Auth::user()->employee_id)
                        return $next($request);
                }
                else{
                    $explode_url = explode('/', $request->path());
                    if ($explode_url[3] == Auth::user()->employee_id)
                        return $next($request);
                    else if(isset($explode_url[4])){
                        if ($explode_url[4] == Auth::user()->employee_id) {
                            return $next($request);
                        }
                    }
                    else if(isset($explode_url[5])){
                        if ($explode_url[5] == Auth::user()->employee_id) {
                            return $next($request);
                        }
                    }
                }
            }
            abort(401);

        }else{
            return $next($request);            
        }
        
    }
}
