@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User
                    <small>Thêm</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            @if(count($errors)>0)
                <div class="alert alert-danger">
                    @foreach( $errors->all() as $err)
                        {{$err}}
                    @endforeach
                </div>
            @endif
            @if(session('thongbao'))
                <div class="alert alert-success">
                    {{session('thongbao')}}
                </div>
            @endif
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="admin/user/them" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Họ Tên</label>
                        <input class="form-control" name="name" placeholder="Nhập Tên Người dùng" />
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Nhập địa chỉ email" />
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu" />
                    </div>
                    <div class="form-group">
                        <label>Password Again</label>
                        <input type="password" class="form-control" name="passwordAgain" placeholder="Nhập lại mật khẩu" />
                    </div>
                    
                    <div class="form-group">
                        <label>Quyền người dùng</label>
                        <label class="radio-inline">
                            <input name="quyen" value="0" checked="" type="radio">Admin
                        </label>
                        <label class="radio-inline">
                            <input name="quyen" value="1" type="radio">Thường
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