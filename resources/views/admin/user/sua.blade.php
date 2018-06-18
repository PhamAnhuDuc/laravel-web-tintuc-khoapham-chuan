@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User
                    <small>{{$user->name}}</small>
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
                <form action="admin/user/sua/{{$user->id}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Họ Tên</label>
                        <input class="form-control" name="name" placeholder="Nhập Tên Người dùng" value="{{$user->name}}"/>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Nhập địa chỉ email" value="{{$user->email}}" readonly="" />
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="changePassword" id="changePassword">
                        <label>Đổi Mật khẩu</label>
                        <input type="password" class="form-control password1" name="password" placeholder="Nhập mật khẩu" disabled="" />
                    </div>
                    <div class="form-group">
                        <label>Nhập lại mật khẩu</label>
                        <input type="password" class="form-control password1" name="passwordAgain" placeholder="Nhập lại mật khẩu" disabled=""/>
                    </div>
                    
                    <div class="form-group">
                        <label>Quyền người dùng</label>
                        <label class="radio-inline">
                            <input name="quyen" value="0" 
                                @if($user->quyen == 1)
                                    {{"checked"}}
                                @endif
                             type="radio">Admin
                        </label>
                        <label class="radio-inline">
                            <input name="quyen" value="1"
                                 @if($user->quyen == 0)
                                    {{"checked"}}
                                @endifs
                             type="radio">Thường
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default">sửa</button>
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
        $(document).ready(function() {
            $("#changePassword").change(function() {
                if($(this).is(":checked")){
                     $(".password1").removeAttr('disabled');
                }else{
                     $(".password1").attr('disabled','');
                }
            });
        });
    </script>
@endsection