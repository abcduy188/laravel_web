@extends('admin_layout')
@section('admin_content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liệt kê đơn hàng</h6>
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
                            <th>Mã đơn hàng</th>
                            <th>Tình trạng đơn hàng</th>
                            <th>Ngày đặt</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $item)
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
                                <a href="{{URL::to ('/admin/detail-order/'.$item -> order_id ) }}">Chi tiết</a>
                                ||
                               
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