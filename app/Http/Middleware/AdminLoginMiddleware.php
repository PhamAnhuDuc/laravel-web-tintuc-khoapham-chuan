<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class AdminLoginMiddleware
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
        //kiem tra nguoi dung co dang nhap hay ko
        if(Auth::check()){
            $user = Auth::user();
            if($user->quyen == 1){ //quyen == 1 moi dc
                return $next($request); //nee co thi cho sang
            }else {
                return redirect('admin/dangnhap');     
            }
            
        }else {
            return redirect('admin/dangnhap');
        }
        return $next($request);
    }
}
