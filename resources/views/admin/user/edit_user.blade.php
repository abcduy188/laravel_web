@extends('admin_layout')
@section('admin_content')


<div class="col-lg-9">
    <div class="card">
        <div class="card-body">
            <div class="card-title">Cập nhật danh mục sản phẩm</div>
            <?php
            $message = session()->get('message');
            if ($message)
            {
                echo  '<span class="text-alert">'.$message.'</span>';
                session()->put('message', null);
            }
                 ?>
            <hr>
            <form role="form" method="POST" action="{{ URL :: to ('/admin/update-user/'.$editUser->id) }}">
                {{ csrf_field() }}
               
                <div class="form-group">
                    <label for="input-1">Email </label>
                    <input type="text" class="form-control" name="email"
                        value="{{$editUser-> email}}">
                </div>
                <div class="form-group">
                    <label for="input-1">Name </label>
                    <input type="text" class="form-control" name="name"
                     value="{{$editUser-> Name}}">
                </div>
                <div class="form-group">
                    <label for="input-1">Phone </label>
                    <input type="text" class="form-control" name="phone"
                     value="{{$editUser-> Phone}}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-light px-5"><i
                            class="icon-lock"></i> Cập nhật user </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection