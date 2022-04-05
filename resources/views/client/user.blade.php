@extends('layout')
@section('content')
<style>
    .abc {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        box-sizing: border-box;
        border: none;
        background-color: #3CBC8D;
        color: white;
    }
</style>
<div class="container">
    <div class="main-body">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
                <li class="breadcrumb-item active" aria-current="page">User Profile</li>
            </ol>
        </nav>
        <?php
        $message = session()->get('message');
        if ($message)
        {
            echo  '<div class="alert alert-danger">'.$message.'</div>';
            session()->put('message', null);
        }
             ?>
        <!-- /Breadcrumb -->
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="https://codewebdao.com/upload/users/1/img/hinhminhhoa/php/2014/12/lay-anh-truc-tiep-tren-url-bang-php/lay-anh-truc-tiep-tren-url-bang-php.jpg"
                                alt="Admin" class="rounded-circle" width="150">
                            <div class="mt-3">
                                <h4>{{$user -> Name}}</h4>
                               
                                <p class="text-muted font-size-sm">{{ $user->Address }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <form method="POST" action="{{ URL :: to('/update-user/'.$user->id) }}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $user->email }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Họ tên</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input class="abc" type="text" name="name" value="{{ $user->Name }}">
                                </div>
                            </div>


                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Số điện thoại</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input class="abc" type="text" name="phone" value="{{ $user->Phone }}">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Địa chỉ</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input class="abc" type="text" name="address" value="{{ $user->Address }}">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="submit" style="width: 100%" class="btn btn-default" value="Cập nhật">
                                </div>
                            </div>
                        </form>


                    </div>
                    <a href="{{URL::to ('/doi-mat-khau') }}" class="btn btn-default">Đổi mật khẩu</a>
                </div>
            </div>

            <div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Tình trạng đơn hàng</th>
                            <th>Ngày đặt</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order as $item)
                        <tr>

                            <td>{{ $item -> order_code }}</td>
                            <td>

                                @if ($item -> order_status == 1)
                                <span style="color: green">Đơn hàng mới</span>
                                @else
                                <span style="color: crimson">Đã xử lí</span>
                                @endif

                            </td>
                            <td><?php
                              
                                    echo $item -> CreateDate;
                                
                            ?>
                            <td>
                                <a href="{{URL::to ('/detail-order/'.$item -> order_id ) }}">Chi tiết</a>
                            </td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection