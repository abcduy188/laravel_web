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
            @foreach ($edit_category_product as $key => $edit_value)
                
            @endforeach
            <form role="form" method="POST" action="{{ URL :: to ('/admin/update-category-product/'.$edit_value->ID) }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="input-1">Tên danh mục: </label>
                    <input type="text" class="form-control" name="category_product_name"
                         value="{{$edit_value->CategoryName}}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-light px-5" name="add_category_product"><i
                            class="icon-lock"></i> Cập nhật danh mục </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection