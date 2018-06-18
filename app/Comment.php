<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table = "Comment";

    //muốn biết commnet này thuộc tin tức nào

    public function tintuc(){
    	return $this->belongsTo('App\TinTuc','idTinTuc','id');
    }

    //muốn biết comment này thuộc người dùng nào

    public function user(){
    	return $this->belongsTo('App\User','idUser','id');
    }
}
