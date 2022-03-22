@extends('admin_layout')
@section('admin_content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Sản phẩm</h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
       
        <?php
        $message = session()->get('message');
        if ($message)
        {
            echo '<div id="alertM" class="alert alert-success">
                    <strong>'.$message.'</strong>
                   
                </div>';
                session()->put('message', null);
        }
   ?>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Tên danh mục</th>
                            <th>Hình ảnh</th>
                            <th>Hiển thị</th>
                            <th>Nổi bật</th>
                            <th>Ngày thêm</th>
                            <th>Người thêm</th>
                            <th></th>

                        </tr>
                    </thead>
                   
                    <tbody>
                        @foreach ($all_product as $item)
                        <tr>

                            <td>{{ $item ->Name }}</td>
                            <td>{{ $item ->category->CategoryName }}</td>
                           
                            <td> <a href="{{ $item ->Image }}" target=”_blank”><img src="{{ $item -> Image }}" alt="" height="50px" ></a></td>
                            <td>
                                @if ($item ->Status == 0)
                                <a href="{{URL::to ('/admin/active-product/'.$item -> id ) }}"><span
                                        class="fa-toggle-styling fa fa-solid fa-toggle-off"></span></a>
                                @else
                                <a href="{{URL::to ('/admin/unactive-product/'.$item -> id ) }}"><span
                                        class="fa-toggle-styling fa fa-solid fa-toggle-on"></span></a>
                                @endif

                            </td>
                            <td>
                                @if ($item ->highlights == 0)
                                <a href="{{URL::to ('/admin/active-highlights/'.$item -> id ) }}"><span
                                        class="fa-toggle-styling fa fa-solid fa-toggle-off"></span></a>
                                @else
                                <a href="{{URL::to ('/admin/unactive-highlights/'.$item -> id ) }}"><span
                                        class="fa-toggle-styling fa fa-solid fa-toggle-on"></span></a>
                                @endif

                            </td>
                            <td><?php
                                if ($item -> ModifiedDate == null)
                                {
                                    echo $item -> CreateDate;

                                }
                                     
                                else {
                                    echo $item -> ModifiedDate;
                                }
                            ?>

                               
                            <td><?php
                                if ($item -> ModifiedBy == null)
                                {
                                    echo $item -> CreateBy;

                                }
                                else {
                                    echo $item -> ModifiedBy;
                                }
                            ?></td>
                            <td>
                                <a href="{{URL::to ('/admin/edit-product/'.$item -> id ) }}">Edit</a>
                                ||

                                <a id="deleteUser" class="deleteUser" data-target="#basic" data-toggle="modal"
                                    data-path="{{URL::to ('/admin/delete-product/'.$item -> id ) }}">Delete</a>

                                
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