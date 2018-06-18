@extends('layout.index')

@section('content')
    <!-- Page Content -->
    <div class="container">

        <!-- slider -->
        <div class="row carousel-holder">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Thông tin tài khoản</div>
                    <div class="panel-body">
                        @if(session('thongbao'))
                            <div class="alert alert-info">
                                {{ session('thongbao') }}
                            </div>

                        @endif
                        <form action="nguoidung" method="post">
                            @csrf
                            <div>
                                <label>Họ tên</label>
                                <input type="text" class="form-control"
                                       value="{{$nguoidung-> name}}"
                                       placeholder="Username" name="name" aria-describedby="basic-addon1">
                            </div>
                            <br>
                            <div>
                                <label>Email</label>
                                <input type="email" class="form-control" placeholder="Email" name="email" aria-describedby="basic-addon1"
                                       disabled readonly value="{{$nguoidung->email}}"

                                >
                            </div>
                            <br>
                            <div>
                                <input type="checkbox" class="" name="changePassword" id="changePassword">
                                <label>Đổi mật khẩu</label>
                                <input type="password" class="form-control password111" name="password" aria-describedby="basic-addon1" disabled>
                            </div>
                            <br>
                            <div>
                                <label>Nhập lại mật khẩu</label>
                                <input type="password" class="form-control password111" name="passwordAgain" aria-describedby="basic-addon1" disabled>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-default">Sửa
                            </button>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
            </div>
        </div>
        <!-- end slide -->
    </div>
    <!-- end Page Content -->
@endsection


@section('script')
    <script>
        $(document).ready(function() {
            $("#changePassword").change(function() {
                if($(this).is(":checked")){
                    $(".password111").removeAttr('disabled');
                }else{
                    $(".password111").attr('disabled','');
                }
            });
        });
    </script>
@endsection