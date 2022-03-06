@extends('admin_layout')
@section('admin_content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <?php
        $message = session()->get('message');
        if ($message)
        {
            echo '<div id="alertM" class="alert alert-success">
                    <strong>'.$message.'</strong>;
                   
                </div>';
                session()->put('message', null);
        }
   ?>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tên danh mục</th>
                            <th>Hiển thị</th>
                            <th>Ngày thêm</th>
                            <th>Người thêm</th>
                            <th></th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Tên danh mục</th>
                            <th>Hiển thị</th>
                            <th>Ngày thêm</th>
                            <th>Người thêm</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($all_category_product as $item => $cate_pro)
                        <tr>

                            <td>{{ $cate_pro -> CategoryName }}</td>
                            <td>
                                @if ($cate_pro -> Status == 0)
                                <a href="{{URL::to ('/admin/active-category-product/'.$cate_pro -> ID ) }}"><span
                                        class="fa-toggle-styling fa fa-solid fa-toggle-off"></span></a>
                                @else
                                <a href="{{URL::to ('/admin/unactive-category-product/'.$cate_pro -> ID ) }}"><span
                                        class="fa-toggle-styling fa fa-solid fa-toggle-on"></span></a>
                                @endif

                            </td>
                            <td><?php
                                if ($cate_pro -> ModifiedDate == null)
                                {
                                    echo $cate_pro -> CreateDate;

                                }
                                     
                                else {
                                    echo $cate_pro -> ModifiedDate;
                                }
                            ?>

                               
                            <td><?php
                                if ($cate_pro -> ModifiedBy == null)
                                {
                                    echo $cate_pro -> CreateBy;

                                }
                                else {
                                    echo $cate_pro -> ModifiedBy;
                                }
                            ?></td>
                            <td>
                                <a href="{{URL::to ('/admin/edit-category-product/'.$cate_pro -> ID ) }}">Edit</a>
                                ||


                                @if ($cate_pro -> IsDelete == 1)

                                <a id="deleteUser" class="deleteUser" data-target="#basic" data-toggle="modal"
                                    data-path="{{URL::to ('/admin/delete-category-product/'.$cate_pro -> ID ) }}">Khôi
                                    phục</a>

                                @else
                                <a id="deleteUser" class="deleteUser" data-target="#basic" data-toggle="modal"
                                    data-path="{{URL::to ('/admin/delete-category-product/'.$cate_pro -> ID ) }}">Delete</a>

                                @endif
                            </td>

                        </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Delete Confirmation</h4>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this item?
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" type="button" class="btn btn-default">Cancel</button>
                <button id="btnContinueDelete" type="button" class="btn btn-primary">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- /.container-fluid -->

<!-- End of Main Content -->
@endsection

@section('script')
<script>
    var path_to_delete;

        $(".deleteUser").click(function (e) {
            path_to_delete = $(this).data('path');
        });
        
        $('#btnContinueDelete').click(function () {
            window.location = path_to_delete;
        });
</script>
@endsection