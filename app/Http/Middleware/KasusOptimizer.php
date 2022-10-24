<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Kasus\Kasus;

class KasusOptimizer
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
        $nomor = $request->route()->parameter('nomor_kasus');
        $kasus = Kasus::where('nomor_kasus', $nomor)->first();
        if(is_null($kasus))
        {
            abort(404);
        }
        if(is_null(session('my_role_'.$nomor))){
            session(['my_role_'.$nomor => $kasus->my_role,
                     'my_invitation_'.$nomor => $kasus->myInvitation,
                     'update_'.$nomor => $kasus->last_update_kolaborator]);
        } else {
            if(session(['update_'.$nomor]) != $kasus->last_update_kolaborator)  //COMPARE LAST UPDATE KOLABORATOR
                session(['my_role_'.$nomor => $kasus->my_role,
                     'my_invitation_'.$nomor => $kasus->myInvitation,
                     'update_'.$nomor => $kasus->last_update_kolaborator]);        
        }
        $request->request->add([
            'kasus'  => $kasus
        ]);
        return $next($request);
    }
}
