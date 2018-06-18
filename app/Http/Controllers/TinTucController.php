<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TinTuc;
use App\TheLoai;
use App\LoaiTin;
use App\Comment;
class TinTucController extends Controller
{
      //
	public function getDanhSach(){
    	$tintuc = TinTuc::orderBy('id','DESC')->get();  //muốn lấy hết các tin từ dưới lên
    	return view('admin.tintuc.danhsach',['tintuc'=>$tintuc]);
    }

    public function getThem(){
    	$theloai = TheLoai::all();
    	$loaitin = LoaiTin::all();
    	return view('admin.tintuc.them',['theloai'=>$theloai,'loaitin'=>$loaitin]);
    }
    	//giúp đưa thông tin sang trang sửa loại tin
    public function getSua($id){ // nhận id 
    	$tintuc = TinTuc::find($id);
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        return view('admin.tintuc.sua',['tintuc' =>$tintuc,'theloai'=>$theloai,'loaitin'=>$loaitin]);
    }
    public function postSua(Request $request, $id){
    	$tintuc = TinTuc::find($id);
        $this->validate($request,
        [
            'LoaiTin'   =>'required',
            'TieuDe'    =>'required|min:3|unique:TinTuc,TieuDe',
            'TomTat'    => 'required',
            'NoiDung'   => 'required'

        ],
        [
            'LoaiTin.required' => 'Bạn chưa chọn loại tin',
            'TieuDe.required' => 'Bạn chưa nhập tiêu đề',
            'TieuDe.min'  => 'Tiêu đề phải có ít nhất 3 kí tự',
            'TieiDe.unique' => 'Tiêu Đề đã tồn tại',
            'TomTat.required' => 'Bạn chưa nhập tóm tắt',
            'NoiDung.required' => 'Bạn chưa nhập nội dung'

        ]);
        $tintuc ->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request -> TieuDe);
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
       
        //kiem tra nguoi dung co truyen hinh anh len ko neu co se luu truong hinh anh vao neu k thi dat no la rong~
        if($request ->hasFile('Hinh')){
            $file = $request->file('Hinh');
            $duoi = $file -> getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi !='png' && $duoi !='jpeg'){
                return redirect('admin/tintuc/them')-> with('loi','Ban chi duoc chon anh co duoi jpg,png,jpeg');
            }
            $name = $file -> getClientOriginalName();//lay ten ban dau cua cai hinh
             $Hinh = str_random(4)."_".$name; //tranh ten trung nhau
            while (file_exists("upload/tintuc/".$Hinh)) {
                $Hinh = str_random(4)."_".$name; //tranh ten trung nhau
            }
            $file->move("upload/tintuc",$Hinh); // thuc hien luu hinh vao thu muc
            unlink("upload/tintuc/".$tintuc->Hinh);//xóa hình cũ
            $tintuc->Hinh = $Hinh;
        }
        $tintuc->save();
        return redirect('admin/tintuc/sua/'.$id)->with('thongbao','Ban da sua tin thanh cong');

    }

    //hàm nhận dữ liệu từ form gửi vào và lưu vào cơ sở dữ liệu
    public function postThem(Request $request){
        //echo $request;
    	$this->validate($request,
        [
            'LoaiTin'   =>'required',
            'TieuDe'    =>'required|min:3|unique:TinTuc,TieuDe',
            'TomTat'    => 'required',
            'NoiDung'   => 'required'

        ],
        [
            'LoaiTin.required' => 'Bạn chưa chọn loại tin',
            'TieuDe.required' => 'Bạn chưa nhập tiêu đề',
            'TieuDe.min'  => 'Tiêu đề phải có ít nhất 3 kí tự',
            'TieiDe.unique' => 'Tiêu Đề đã tồn tại',
            'TomTat.required' => 'Bạn chưa nhập tóm tắt',
            'NoiDung.required' => 'Bạn chưa nhập nội dung'

        ]);

        $tintuc = new TinTuc;
        $tintuc ->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request -> TieuDe);
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->SoLuotXem = 0 ;
        //kiem tra nguoi dung co truyen hinh anh len ko neu co se luu truong hinh anh vao neu k thi dat no la rong~
        if($request ->hasFile('Hinh')){
            $file = $request->file('Hinh');
            $duoi = $file -> getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi !='png' && $duoi !='jpeg'){
                return redirect('admin/tintuc/them')-> with('loi','Ban chi duoc chon anh co duoi jpg,png,jpeg');
            }
            $name = $file -> getClientOriginalName();//lay ten ban dau cua cai hinh
             $Hinh = str_random(4)."_".$name; //tranh ten trung nhau
            while (file_exists("upload/tintuc/".$Hinh)) {
                $Hinh = str_random(4)."_".$name; //tranh ten trung nhau
            }
            $file->move("upload/tintuc",$Hinh); // thuc hien luu hinh vao thu muc
            $tintuc->Hinh = $Hinh;
        }else {
            $tintuc->Hinh = "";
        }
        $tintuc->save();
        return redirect('admin/tintuc/them')->with('thongbao','Ban da them tin thanh cong');
    }


    public function getXoa($id){
    	$tintuc = TinTuc::find($id);
        $tintuc ->delete();
        return redirect('admin/tintuc/danhsach')->with('thongbao','Xóa Thành công');
    }
}
