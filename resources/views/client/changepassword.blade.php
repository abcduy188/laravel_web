@extends('layout')
@section('content')
<div class="container">
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
    <div class="main-body">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">User Profile</a></li>
                <li class="breadcrumb-item active" aria-current="page">Change Password</li>
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
        <div class="col-md-8" style="align-content: center">
            <div class="card mb-3">
                <div class="card-body">
                    <form method="POST" action="{{ URL :: to('/doChangePass') }}">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Mật khẩu cũ</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input class="abc" type="password" name="old" placeholder="Nhập mật khẩu cũ">
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Mật khẩu mới</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input class="abc" type="password" name="new" placeholder="Nhập mật khẩu mới"
                                    id="register_password" required onkeyup='check();' onchange="check2();">
                            </div>
                            <span id='messagecheck1'></span>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Nhập lại mật khẩu</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input class="abc" type="password" name="reNew" placeholder="Nhập lại mật khẩu"
                                    id="register_confirm" required onkeyup='check();'>
                            </div>
                            <span id='messagecheck'></span>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="submit" id="btn" class="btn btn-primary btn-user btn-block"
                                    value="Đổi mật khẩu" disabled="disabled" />
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>


    </div>
</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    var check = function() {
        if (document.getElementById('register_password').value == document
                .getElementById('register_confirm').value) {
            document.getElementById('messagecheck').style.color = 'green';
            document.getElementById('messagecheck').innerHTML = 'matching';
            document.getElementById('btn').disabled =false;
        } else {
            document.getElementById('messagecheck').style.color = 'red';
            document.getElementById('messagecheck').innerHTML = 'not matching';
        }
        
    }
    var check2 = function(){
       
        if ((document.getElementById('register_password').value).length <6) {
            document.getElementById('messagecheck1').style.color = 'red';
            document.getElementById('messagecheck1').innerHTML = 'Mật khẩu phải hơn 6 kí tự';
        }
    }
    
</script>
@endsection