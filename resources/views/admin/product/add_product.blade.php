




@extends('admin_layout')
@section('admin_content')


<div class="col-lg-9">
    <div class="card">
        <div class="card-body">
            <div class="card-title">Thêm danh mục sản phẩm</div>
            <?php
            $message = session()->get('message');
            if ($message)
            {
                echo  '<span class="text-alert">'.$message.'</span>';
                session()->put('message', null);
            }
                 ?>
            <hr>
            <form role="form" method="POST" action="{{ URL :: to ('/admin/save-category-product') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="input-1">Tên sản phẩm: </label>
                    <input type="text" class="form-control" name="product_name"
                        placeholder="Nhập tên sản phẩm" id = "title", onkeyup = "ChangeToSlug();">
                </div>
                <div class="form-group">
                    <label for="input-1">Tên SEO: </label>
                    <input type="text" class="form-control" name="seotitle_name"
                        placeholder="Tên seo tự động" id = "slug">
                </div>
                <div class="form-group">
                    <label for="input-1">Hình ảnh: </label>
                    <input type="file" class="form-control" name="image"
                        placeholder="Hình ảnh sản phẩm">
                </div>
                <div class="form-group">
                    <label for="input-1">Giá sản phẩm: </label>
                    <input type="text" class="form-control" name="price"
                        placeholder="Tên seo tự động">
                </div>
                <div class="form-group">
                    <label for="input-1">Giá khuyến mãi: </label>
                    <input type="text" class="form-control" name="PromotionPrice"
                        placeholder="Tên seo tự động">
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

@section('script')
<script>


    function ChangeToSlug() {
                var title, slug;
    
                //Lấy text từ thẻ input title
                title = document.getElementById("title").value;
    
                //Đổi chữ hoa thành chữ thường
                slug = title.toLowerCase();
    
                //Đổi ký tự có dấu thành không dấu
                slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                slug = slug.replace(/đ/gi, 'd');
                //Xóa các ký tự đặt biệt
                slug = slug.replace(/\`|\~|\!|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\”|\:|\;|_/gi, '');
                //Đổi khoảng trắng thành ký tự gạch ngang
                slug = slug.replace(/ /gi, "-");
                //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                slug = slug.replace(/\-\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-/gi, '-');
                slug = slug.replace(/\-\-/gi, '-');
                //In slug ra textbox có id “slug”
                document.getElementById('slug').value = slug;
            }
    
    </script>
@endsection

