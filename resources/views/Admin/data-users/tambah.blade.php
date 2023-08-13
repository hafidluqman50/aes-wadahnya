@extends('Admin.layout.layout-app')

@section('content')
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Tambah Users</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item"><a href="#">Data Users</a></li>
						<li class="breadcrumb-item active">Tambah Users</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<a href="{{ url('/admin/data-users') }}">
							<button class="btn btn-default">
								<span class="fas fa-arrow-left"></span> Kembali
							</button>
						</a>
					</div>
					<form action="{{ url('/admin/data-users/save') }}" method="POST">
						@csrf
						<div class="card-body">
							<div class="form-group">
								<label for="">Nama Karyawan</label>
								<input type="text" name="nama_karyawan" class="form-control" required placeholder="Isi Nama">
							</div>
							<div class="form-group">
								<label for="">Username</label>
								<input type="text" name="username" class="form-control" required placeholder="Isi Username">
							</div>
							<div class="form-group">
								<label for="">Password</label>
								<input type="password" name="password" class="form-control" required placeholder="Isi Password">
							</div>
						</div>
						<div class="card-footer">
							<button class="btn btn-primary">Simpan <span class="fas fa-save"></span></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
@endsection