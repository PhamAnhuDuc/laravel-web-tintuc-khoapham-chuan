<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
//use App\TheLoai;
//use App\Slide;
use App\LoaiTin;
use App\TinTuc;
//use Carbon\Carbon;
use App\User;
class PagesController extends Controller
{

    function trangchu(){

    	return view('pages.trangchu');
    }

    function lienhe(){
    	return view('pages.lienhe');
    }

    function loaitin($id){
        $loaitin = LoaiTin::find($id); //lấy loại tin
        $tintuc = TinTuc::where('idLoaiTin',$id)->paginate(5);//lấy cái tin tức óc idLoaiTin = $id truyền vào và để 5 tin 1 trang
        return view('pages.loaitin',['loaitin'=>$loaitin,'tintuc'=>$tintuc]);
    }

    function tintuc($id){
        
        $tintuc = TinTuc::find($id); //lấy tin tức ra 
        $tinnoibat = TinTuc::where('NoiBat',1)->take(4)->get();
        $tinlienquan = Tintuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();
        return view('pages.tintuc',['tintuc' => $tintuc,'tinnoibat'=> $tinnoibat,'tinlienquan'=>$tinlienquan]);

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function getDangnhap(){
        return view('pages.dangnhap');
    }
    function postDangnhap(Request $request){
        //echo $request->email;
        $this->validate($request,
            [
                'email'=>'required',
                'password'=>'required|min:3|max:32'
            ],
            [
                'email.required'=> 'Ban chua nhap email',
                'email.required'=> 'Ban chua nhap pass',
                'email.min'=> 'pass phai Lon hon 3 ki tu va nho hon 32 ki tu',
                'email.max'=> 'pass phai Lon hon 3 ki tu va nho hon 32 ki tu'
            ]);
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect('trangchu');
        }else {
            return redirect('dangnhap')->with('thongbao', 'dang nhap k thanh cong');
        }
    }

    function getDangXuat(){
        Auth::logout();
        return redirect('trangchu');
    }

    function getNguoidung(){
        $user = Auth::user(); //vì người dùng đang đăng nhập dựa vào lớp Auth thì lấy ra người dùng = method Auth
        return view('pages.nguoidung',['nguoidung'=>$user]);
    }

    function postNguoidung(Request $request){
        $this->validate($request,
            [
                'name'=>'required|min:3',

            ],
            [
                'name.required' => 'Ban chua nhập tên người dùng',
                'name.min' => 'Tên người dùng phải có ít nhất 3 kí tự',
            ]);
        $user = Auth::user();
        $user->name = $request->name;
        //nếu người dùng check thì gán mk = mk mới
        if($request->changePassword == "on"){
            $this->validate($request,
                [
                    'password'=>'required|min:3|max:32',
                    'passwordAgain'=>'required|same:password'
                ],
                [
                    'password.required' => 'Bạn chưa nhập password',
                    'password.min' => 'Password phải có độ dài từ 3 đến 32 kí tự',
                    'password.max' => 'Password phỉa có độ dài từ 3 đến 32 kí tự',
                    'passwordAgain.required'=>'Bạn chưa nhập lại mật khẩu',
                    'passwordAgain.same' => 'Password nhập lại chưa chính xác'
                ]);
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect('nguoidung')->with('thongbao', 'ban da sua thanh cong');
    }


    function getDangki(){
        return view('pages.dangki');
    }

    function postDangki(Request $request){
        $this->validate($request,
            [
                'name'=>'required|min:3',
                'email'=>'required|email|unique:users,email', //trường emial phải nhập tên-là email-k được trùng với bảng users cột email
                'password'=>'required|min:3|max:32',
                'passwordAgain'=>'required|same:password'
            ],
            [
                'name.required' => 'Ban chua nhập tên người dùng',
                'name.min' => 'Tên người dùng phải có ít nhất 3 kí tự',
                'email.required' => 'Bạn chưa nhập tên email',
                'email.email' => 'Bạn chưa nhập đúng định dạng email',
                'email.unique' => 'Email đã tồn tại',
                'password.required' => 'Bạn chưa nhập password',
                'password.min' => 'Password phải có độ dài từ 3 đến 32 kí tự',
                'password.max' => 'Password phỉa có độ dài từ 3 đến 32 kí tự',
                'passwordAgain.required'=>'Bạn chưa nhập lại mật khẩu',
                'passwordAgain.same' => 'Password nhập lại chưa chính xác'
            ]);
        $user = new User;
        $user-> name = $request->name;
        $user-> email = $request->email;
        $user-> password = bcrypt($request->password);
        $user-> quyen = 0;
        $user->save();
        return redirect('dangki')->with('thongbao','chuc mung ban da dang ki thanh cong');
    }

    function postTimkiem(Request $request){
        $tukhoa = $request -> tukhoa;
        $tintuc = TinTuc::where('TieuDe','like',"%$tukhoa%")->orWhere('TomTat','like',"%$tukhoa%")
            ->orWhere('NoiDung','like',"%$tukhoa%")->take(30)->paginate(5) ;
        return view('pages.timkiem',['tintuc'=>$tintuc,'tukhoa'=>$tukhoa]);
    }
}

