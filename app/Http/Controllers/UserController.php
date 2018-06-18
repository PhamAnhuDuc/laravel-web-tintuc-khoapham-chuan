<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth; 

class UserController extends Controller
{
    //
    public function getDanhSach(){
      $user = User::all();
    	 return view('admin.user.danhsach',['user'=>$user]);
    }


        
    public function getSua($id){ // nhận id 
    	$user = User::find($id);
        return view('admin.user.sua',['user'=>$user]);

    }
    public function postSua(Request $request, $id){
      	$this->validate($request,
          [
            'name'=>'required|min:3',
           
          ],
          [
            'name.required' => 'Ban chua nhập tên người dùng',
            'name.min' => 'Tên người dùng phải có ít nhất 3 kí tự',
          ]);
        $user =  User::find($id);
        $user->name = $request->name;
        $user->quyen = $request->quyen;
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
        return redirect('admin/user/sua/'.$id) ->with('thongbao','sua thanh cong');
    }
    public function getThem(){
      return view('admin.user.them');
    }
    //hàm nhận dữ liệu từ form gửi vào và lưu vào cơ sở dữ liệu
    public function postThem(Request $request){
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
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->quyen = $request->quyen;
        $user->save();
        return redirect('admin/user/them') ->with('thongbao','them thanh cong');
    }


    public function getXoa($id){
     	$user = User::find($id);
        $user->delete();
        return redirect('admin/user/danhsach')->with('thongbao','Ban xoa thanh cong');
    }

    public function getDangnhapAdmin(){
        return view('admin.login');
    }
    public function postDangnhapAdmin(Request $request){
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
            return redirect('admin/theloai/danhsach');
        }else {
            return redirect('admin/dangnhap')->with('thongbao', 'dang nhap k thanh cong');
        }
    }

    public function getDangXuatAdmin(){
        Auth::logout();
        return view('admin.login');
    }
}
