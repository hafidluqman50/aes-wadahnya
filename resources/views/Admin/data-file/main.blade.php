@extends('Admin.layout.layout-app')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Data File</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data File</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ url('/admin/data-file/tambah') }}">
                                <button class="btn btn-primary">
                                    Tambah Data
                                </button>
                            </a>
                        </div>
                        <div class="card-body">
                            @if(session()->has('message'))
                            <div class="alert alert-success alert-dismissible fade show">
                                {{ session('message') }} <button class="close" data-dismiss="alert">X</button>
                            </div>
                            @endif
                        <table class="table table-hover" width="100%" id="data-file">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal Input</th>
                                    <th>Nama File</th>
                                    <th>Nama File Enkripsi</th>
                                    <th>Status File</th>
                                    <th>Ket. File</th>
                                    <th>Input By</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('js')
<script>
    
    $(function(){
        var data_file = $('#data-file').DataTable({
            processing:true,
            serverSide:true,
            ajax:"{{ url('/datatables/data-file') }}",
            columns:[
                {data:'id_data_file',searchable:false,render:function(data,type,row,meta){
                    return meta.row + meta.settings._iDisplayStart+1;
                }},
                {data:'tanggal_input',name:'tanggal_input'},
                {data:'nama_file',name:'nama_file'},
                {data:'nama_file_enkripsi',name:'nama_file_enkripsi'},
                {data:'status_file',name:'status_file'},
                {data:'keterangan_file',name:'keterangan_file'},
                {data:'name',name:'name'},
                {data:'action',name:'action',searchable:false,orderable:false}
            ],
            scrollCollapse: true,
            columnDefs: [ {
            sortable: true,
            "class": "index",
            }],
            scrollX:true,
            order: [[ 0, 'desc' ]],
            responsive:true,
            fixedColumns: true
        });
        data_file.on( 'order.dt search.dt', function () {
            data_file.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            });
        }).draw();
    });
</script>
@endsection