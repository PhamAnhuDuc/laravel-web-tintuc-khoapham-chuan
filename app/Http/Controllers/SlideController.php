<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;

class SlideController extends Controller
{
    //
    public function getDanhSach(){
    	$slide = Slide::All();
    	return view('admin.slide.danhsach',['slide'=> $slide]);
    }

    public function getThem(){
    	return view('admin.slide.them');
    }
        
    public function getSua($id){ // nhận id 
    	$slide = Slide::find($id);
    	return view('admin.slide.sua',['slide'=>$slide]);

    }
    public function postSua(Request $request, $id){
      	$this->validate($request,
       		[
       			'Ten'=>'required',
       			'NoiDung'=>'required'	
       		],
       		[
       			'Ten.required'=>'Bạn chưa nhập tên',
       			'NoiDung.required'=>'Bạn Chưa nhập nội dung'
       		]

       	);
       	$slide = Slide::find($id);
       	$slide-> Ten = $request->Ten;
       	$slide->NoiDung = $request->NoiDung;
       	if($request->has('link'))  
       		$slide->link = $request->link;

       	//kiem tra nguoi dung co truyen hinh anh len ko neu co se luu truong hinh anh vao neu k thi dat no la rong~
        if($request ->hasFile('Hinh')){
            $file = $request->file('Hinh');
            $duoi = $file -> getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi !='png' && $duoi !='jpeg'){
                return redirect('admin/slide/them')-> with('loi','Ban chi duoc chon anh co duoi jpg,png,jpeg');
            }
            $name = $file -> getClientOriginalName();//lay ten ban dau cua cai hinh
            $Hinh = str_random(4)."_".$name; //tranh ten trung nhau
            while (file_exists("upload/slide/".$Hinh)) {
                $Hinh = str_random(4)."_".$name; //tranh ten trung nhau
            }
            unlink("upload/slide/".$slide->Hinh);// xóa cái hình cũ rồi thêm 
            $file->move("upload/slide",$Hinh); // thuc hien luu hinh vao thu muc
            $slide->Hinh = $Hinh;
        }else {
           
        }
        $slide->save();
        return redirect('admin/slide/sua/'.$id)->with('thongbao','Ban da sửa slide thanh cong');
    }

    //hàm nhận dữ liệu từ form gửi vào và lưu vào cơ sở dữ liệu
    public function postThem(Request $request){
       	$this->validate($request,
       		[
       			'Ten'=>'required',
       			'NoiDung'=>'required'	
       		],
       		[
       			'Ten.required'=>'Bạn chưa nhập tên',
       			'NoiDung.required'=>'Bạn Chưa nhập nội dung'
       		]

       	);
       	$slide = new Slide;
       	$slide-> Ten = $request->Ten;
       	$slide->NoiDung = $request->NoiDung;
       	if($request->has('link'))  
       		$slide->link = $request->link;

       	//kiem tra nguoi dung co truyen hinh anh len ko neu co se luu truong hinh anh vao neu k thi dat no la rong~
        if($request ->hasFile('Hinh')){
            $file = $request->file('Hinh');
            $duoi = $file -> getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi !='png' && $duoi !='jpeg'){
                return redirect('admin/slide/them')-> with('loi','Ban chi duoc chon anh co duoi jpg,png,jpeg');
            }
            $name = $file -> getClientOriginalName();//lay ten ban dau cua cai hinh
            $Hinh = str_random(4)."_".$name; //tranh ten trung nhau
            while (file_exists("upload/slide/".$Hinh)) {
                $Hinh = str_random(4)."_".$name; //tranh ten trung nhau
            }
            $file->move("upload/slide",$Hinh); // thuc hien luu hinh vao thu muc
            $slide->Hinh = $Hinh;
        }else {
            $slide->Hinh = "";
        }
        $slide->save();
        return redirect('admin/slide/them')->with('thongbao','Ban da them slide thanh cong');
    }


    public function getXoa($id){
     	$slide = Slide::find($id);
     	$slide->delete();
     	return redirect('admin/slide/danhsach')->with('thongbao','Bạn đã xóa Thành công');

    }
}
