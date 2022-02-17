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

                        <tr>
                            <td>Michael Bruce</td>
                            <td>Ẩn/Hiển thị</td>
                            <td>2011/06/27</td>
                            <td>29</td>
                            <td>2011/06/27</td>

                        </tr>
                        <tr>
                            <td>Michael Bruce</td>
                            <td>Ẩn/Hiển thị</td>
                            <td>2011/06/27</td>
                            <td>29</td>
                            <td>
                                <a id="editCate" class="editCate" data-target="#edit"
                                data-toggle="modal"
                                data-path="">Edit</a>
                                <a id="deleteUser" class="deleteUser" data-target="#basic"
                                data-toggle="modal"
                                data-path="">Delete</a>
                               
                            </td>

                        </tr>
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