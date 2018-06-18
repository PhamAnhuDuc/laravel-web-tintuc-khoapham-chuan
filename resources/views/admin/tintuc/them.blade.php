@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin Tức
                    <small>Thêm</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @if(count($errors) >0)
                    <div class="alert alert-danger">
                        @foreach($errors-> all() as $err)
                            {{$err}}<br>
                        @endforeach
                    </div>
                @endif
                
                @if(session('thongbao'))
                <div class="alert alert-success">
                    {{session('thongbao')}}
                </div>
                @endif
                <form action="admin/tintuc/them" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Thể Loại</label>
                        <select class="form-control" id="TheLoai" name="TheLoai">
                            @foreach($theloai as $tl)
                                <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                            @endforeach
                            
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Loại Tin</label>
                        <select class="form-control" name="LoaiTin" id="LoaiTin">
                            @foreach($loaitin as $lt)
                                <option value="{{$lt->id}}">{{$lt->Ten}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <label>Tiêu Đề</label>
                        <input class="form-control" name="TieuDe" placeholder="Nhập Tiêu ĐỀ" />
                    </div>
                   
                    <div class="form-group">
                        <label>Tóm Tắt</label>
                        <textarea name="TomTat" id="demo"  class="form-control ckeditor " rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Nội Dung</label>
                        <textarea name="NoiDung" id="demo"  class="form-control ckeditor " rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Hình Ảnh</label>
                        <input type="file" name="Hinh" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Nổi Bật</label>
                        <label class="radio-inline">
                            <input name="NoiBat" value="0" checked="" type="radio">Không
                        </label>
                        <label class="radio-inline">
                            <input name="NoiBat" value="1" type="radio">Có
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default">Thêm</button>
                    <button type="reset" class="btn btn-default">Làm Mới</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>

@endsection
<!-- /#page-wrapper -->


@section('script')
    <script>
        $(document).ready(function(){
            $("#TheLoai").change(function(event) {
                var idTheloai = $(this).val();
                //alert(idTheloai);  //tạo trang 
                $.get("admin/ajax/loaitin/" + idTheloai,function(data){
                        $("#LoaiTin").html(data);
                });
            });
        });
    </script>
@endsection