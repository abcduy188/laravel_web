@extends('admin_layout')
@section('admin_content')


<div class="col-lg-9">
    <div class="card">
        <div class="card-body">
            <div class="card-title">Thêm sản phẩm</div>
            <?php
            $message = session()->get('message');
            if ($message)
            {
                echo  '<span class="text-alert">'.$message.'</span>';
                session()->put('message', null);
            }
                 ?>
            <hr>
            <form role="form" method="POST" action="{{ URL :: to ('/admin/save-banner') }}"  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="input-1">Tên Banner </label>
                    <input type="text" class="form-control" name="slide_name"
                        placeholder="Nhập tên slide" >
                </div>
                <div class="form-group">
                    <label for="input-1">Mô tả: </label>
                    <input type="text" class="form-control" name="slide_desc"
                        placeholder="Nhập tên sản phẩm" >
                </div>
                <div class="form-group">
                    <label for="input-1">Hình ảnh: </label>
                    <input type="file" class="form-control" name="file"
                        placeholder="Hình ảnh sản phẩm" required>
                </div>
                <div class="form-group">
                    <label for="input-2">Hiển thị: </label>
                    <select name="status" class="form-control input-sm m-bot15">
                        <option value="0">Ẩn</option>
                        <option value="1">Hiện</option>

                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-light px-5" name="add_category_product"><i
                            class="icon-lock"></i> Thêm slide</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

