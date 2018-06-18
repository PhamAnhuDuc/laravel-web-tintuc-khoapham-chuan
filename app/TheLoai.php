<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
    //connect toi cac bang
    protected $table = "TheLoai";
    //tao lien ket cac bang voi nhau
   	public function loaitin()
   	{
   		//1 the loai co nhieu loai tin -> 1-nhieu -> hasmany
   		return $this->hasMany('App\LoaiTin','idTheLoai','id'); // model - khoa phụ - khóa chính
   	}
   	//ham lay tat ca cac tin tuc ra thi no lien ket thông qua bảng loại tin rồi bảng thể loại
   	public function tintuc()
   	{								//model chính - model trung gian - khóa phu loại tin - khóa phụ tin tuc - khóa chính tin
   		return $this->hasManyThrough('App\TinTuc','App\LoaiTin','idTheLoai','idLoaiTin','id'); 
   	}
}
