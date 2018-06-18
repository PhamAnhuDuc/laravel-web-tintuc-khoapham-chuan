<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TinTuc extends Model
{
    //
    protected $table = "TinTuc";
    public function loaitin(){
    	return $this->belongsTo('App\LoaiTin','idLoaiTin','id');
    }

    //trong tin tức có thể lấy ra comment

    public function comment(){
    	return $this->hasMany('App\Comment','idTinTuc','id');
    }

}
