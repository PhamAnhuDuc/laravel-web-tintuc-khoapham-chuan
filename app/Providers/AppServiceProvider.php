<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use App\TheLoai;
use App\Slide;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        $theloai = Theloai::all();
        $slide   = Slide::orderBy('id','desc')->take(3)->get()->toArray();

        view()->share('theloai',$theloai);
        view()->share('slide',$slide);

//        if(Auth::check()){ //kiểm tra nếu có đang nhập thì truyền cái user về cho toàn bộ
//            view()-> share('nguoidung',Auth::user());
//        }

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
