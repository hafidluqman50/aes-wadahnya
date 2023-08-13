@extends('Admin.layout.layout-app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Enkripsi Ulang File</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Data File</a></li>
                        <li class="breadcrumb-item active">Enkripsi Ulang File</li>
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
                        <a href="{{ url('/admin/data-file') }}">
                            <button class="btn btn-default">
                                <span class="fas fa-arrow-left"></span> Kembali
                            </button>
                        </a>
                    </div>
                    <form action="{{ url('/admin/data-file/enkripsi-ulang/proses',$id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Tanggal Input</label>
                                <input type="date" name="tanggal_input" class="form-control" readonly value="{{ $row->tanggal_input }}">
                            </div>
                            <div class="form-group">
                                <label for="">Nama File</label>
                                <input type="text" class="form-control" readonly value="{{ $row->nama_file }}">
                            </div>
                            <div class="form-group">
                                <label for="">Nama File</label>
                                <input type="text" class="form-control" readonly value="{{ $row->nama_file }}">
                            </div>
                            <div class="form-group">
                                <label for="">Keterangan File</label>
                                <textarea name="keterangan_file" class="form-control" readonly cols="30" rows="10">{{$row->keterangan_file}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Kunci</label>
                                <input type="password" name="kunci" class="form-control" required placeholder="Isi Kunci; Harus 16 Karakter">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-warning">Proses <span class="fas fa-key"></span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection