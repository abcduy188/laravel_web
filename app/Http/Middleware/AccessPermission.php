<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Support\Facades\Route;
class AccessPermission
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

        // $id = Auth::id();
        // $user = User::find($id);
        // if($user->hasRole('admin'))
        // {
        //     return $next($request);
        // }
        $admin_id = Auth::id();
        if($admin_id == null)
        {
            return redirect('/admin/login')->with('message','Bạn phải đăng nhập trước');
        }
        if(Auth::user()->hasAnyRoles(['ADMIN','mod']))
        {
            return $next($request);
        }else{
            return redirect('/admin/login')->with('message','You do not have permission');
        }
        
    }
}

