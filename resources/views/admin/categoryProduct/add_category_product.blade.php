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
            <form role="form" method="POST" action="{{ URL :: to ('/admin/save-category-product') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="input-1">Tên danh mục: </label>
                    <input type="text" class="form-control" name="category_product_name"
                        placeholder="Nhập tên sản phẩm">
                </div>
                <div class="form-group">
                    <label for="input-2">Hiển thị: </label>
                    <select name="category_product_status" class="form-control input-sm m-bot15">
                        <option value="0">Ẩn</option>
                        <option value="1">Hiện</option>

                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-light px-5" name="add_category_product"><i
                            class="icon-lock"></i> Thêm danh mục</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection