<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoaiTin extends Model
{
    //
    protected $table = "LoaiTin";


    //muốn biết loại tin này thuộc thể loại nào
    public function theloai(){
    	return $this->belongsTo('App\TheLoai','idTheLoai','id');
    }

    //muốn biết loại tin này có bao nhiêu tin

    public function tintuc(){
    	return $this->hasMany('App\TinTuc','idLoaiTin','id');
    }

    // public static function a()
    // {
    //     return self::with('theloai')->get();
    // }
}
