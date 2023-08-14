@extends('Admin.layout.layout-app')

@section('content')
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Data Users</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Data Users</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<a href="{{ url('/admin/data-users/tambah') }}">
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
							<table class="table table-hover" id="data-users" width="100%">
								<thead>
									<tr>
										<th>No.</th>
										<th>Nama</th>
										<th>Username</th>
										<th>Status User</th>
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
		</div>
	</section>
@endsection


@section('js')
<script>
    $(function(){
        var users = $('.data-users').DataTable({
            processing:true,
            serverSide:true,
            ajax:"{{ url('/datatables/data-users') }}",
            columns:[
                {data:'id_users',searchable:false,render:function(data,type,row,meta){
                    return meta.row + meta.settings._iDisplayStart+1;
                }},
                {data:'name',name:'name'},
                {data:'username',name:'username'},
                {data:'status_akun',name:'status_akun'},
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
        users.on( 'order.dt search.dt', function () {
            users.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            });
        }).draw();
    });
</script>
@endsection