<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Comment;
use App\TinTuc;
class CommentController extends Controller
{
    //
    public function getXoa($id,$idTinTuc){
    	$comment = Comment::find($id);
    	$comment ->delete();
    	return redirect('admin/tintuc/sua/'.$idTinTuc)->with('thongbao','Xoa Comment Thanh công');
    }

    //id cho biết là bài viết nào đó
    public function postComment($id, Request $request){
        $idTintuc = $id;
        $tintuc = TinTuc::find($id);
        $comment = new Comment; //tạo đối tượng để lưu vào comment
        $comment -> idTinTuc = $idTintuc;
        $comment -> idUser  = Auth::user()->id;
        $comment -> NoiDung = $request -> NoiDung;
        $comment -> save();
        return redirect("tintuc/$id/".$tintuc->TieuDeKhongDau.".html")->with('thongbao','viet binh luan thanh cong');
    }
}
