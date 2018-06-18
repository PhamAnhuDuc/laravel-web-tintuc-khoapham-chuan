<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
class TheLoaiController extends Controller
{
    //
    public function getDanhSach(){
    	$theloai = TheLoai::All(); // lấy tất cả các thể loại
        //echo $theloai ;
    	return view('admin.theloai.danhsach',['theloai'=>$theloai]);
    }

    public function getThem(){
    	return view('admin.theloai.them');
    }
        
    public function getSua($id){ // nhận id 
    	$theloai = TheLoai::find($id);
        return view('admin.theloai.sua',['theloai' => $theloai]);
    }
    public function postSua(Request $request, $id){
        $theloai = TheLoai::find($id);
        $this->validate($request,
            [           //người dùng có nhập ko, có bị trùng ở bảng TheLoai, cột Tên hay k
            'Ten' => 'required|unique:TheLoai,Ten|min:3|max:100'
        ],
        [
            'Ten.required' => 'Bạn chưa nhập tên thể loại',
            'Ten.unique' => 'Tên Thể Loại đã tồn tại',
            'Ten.min' => 'Tên Thể loại phải có độ dài từ 3 đến 100 kí tự',
            'Ten.max' => 'Tên Thể loại phải có độ dài từ 3 đến 100 kí tự'
        ]
        );

        $theloai->Ten = $request-> Ten;
        $theloai->TenKhongDau = changeTitle($request ->Ten);
        $theloai->save();

        return redirect('admin/theloai/sua/'.$id) -> with('thongbao','Sua thanh cong');
    }

    //hàm nhận dữ liệu từ form gửi vào và lưu vào cơ sở dữ liệu
    public function postThem(Request $request){
        //echo $request->Ten;
        //check điều kiện : sử dụng validate : chú ý bản thân nó đã có cái $errors
        $this->validate($request, 
            [
                'Ten' => 'required|min:3|max:100'   //điều kiện
            ],
            [
                'Ten.required' => 'Bạn chưa nhập tên thể loại',   // thông báo lỗi
                'Ten.min' => 'Tên Thể loại phải có độ dài từ 3 đến 100 kí tự',
                'Ten.max' => 'Tên Thể loại phải có độ dài từ 3 đến 100 kí tự'
            ]);

        $theloai = new TheLoai; //tạo đối tượng
        $theloai -> Ten = $request ->Ten;
        $theloai -> TenKhongDau  = changeTitle($request -> Ten); //đổi tên
        echo changeTitle($request -> Ten);
       $theloai -> save(); //lưu lại

        return redirect('admin/theloai/them')->with('thongbao','Thêm Thành Công'); //chuyển về trang này và thêm cho nó 1 cái thông báo và nó sẽ tự động lưu vào section
    }


    public function postXoa($id){
        $theloai = TheLoai::find($id);
        $theloai->delete();
        return redirect('admin/theloai/danhsach')->with('thongbao','Bạn đã xóa thành công');
    }
}
