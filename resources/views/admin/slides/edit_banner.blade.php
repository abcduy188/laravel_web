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

            <form role="form" method="POST" action="{{ URL :: to ('/admin/update-banner/'.$slide->id) }}"
                enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="input-1">Tên Banner </label>
                    <input type="text" class="form-control" name="slide_name" value="{{ $slide->slide_name }}">
                </div>
                <div class="form-group">
                    <label for="input-1">Mô tả: </label>
                    <input type="text" class="form-control" name="slide_desc" value="{{ $slide->slide_desc }}">
                </div>
                <div class="form-group">
                    <label for="input-1">Hình ảnh: </label>
                    <input type="file" class="form-control" name="file">
                    <img src="{{ $slide->slide_image }}" height="50px" alt="">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-light px-5" name="add_category_product"><i
                            class="icon-lock"></i> chỉnh sửa slide</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection