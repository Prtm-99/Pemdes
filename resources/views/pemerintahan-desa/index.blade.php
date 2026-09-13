@extends('layouts.app')

@section('title', 'Pemerintahan Desa')

@section('styles')
<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<style>
    .ikon {
        font-family: fontAwesome;
    }
    .animate-up {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .animate-up:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }
    .card {
        border-radius: 10px;
        overflow: hidden;
        border: none;
    }
    .card-img {
        background-size: cover;
        background-position: center;
        height: 200px;
        transition: transform 0.3s ease;
    }
    .card-img:hover {
        transform: scale(1.05);
    }
    .btn-success {
        background: linear-gradient(45deg, #28a745, #20c997);
        border: none;
        transition: background 0.3s ease;
    }
    .btn-success:hover {
        background: linear-gradient(45deg, #20c997, #28a745);
    }
    .btn-primary {
        background: linear-gradient(45deg, #007bff, #0056b3);
        border: none;
        transition: background 0.3s ease;
    }
    .btn-primary:hover {
        background: linear-gradient(45deg, #0056b3, #007bff);
    }
    .btn-danger {
        background: linear-gradient(45deg, #dc3545, #c82333);
        border: none;
        transition: background 0.3s ease;
    }
    .btn-danger:hover {
        background: linear-gradient(45deg, #c82333, #dc3545);
    }
    .modal-content {
        border-radius: 10px;
        border: none;
    }
    .modal-header {
        border-bottom: none;
    }
    .modal-footer {
        border-top: none;
    }
    .content {
        padding-top: 20px; /* Tambahkan padding untuk konten */
    }
</style>
@endsection

@section('content-header')
<div class="header pb-8 pt-5 pt-md-8" style="background: linear-gradient(87deg, #1f3a93, #4a90e2);">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card shadow h-100">
                    <div class="card-header border-0">
                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-between text-center text-md-left">
                            <div class="mb-3">
                                <h2 class="mb-0">Pemerintahan Desa</h2>
                                <p class="mb-0 text-sm">Kelola Informasi Pemerintahan Desa</p>
                            </div>
                            <div class="mb-3">
                                <a href="{{ route('pemerintahan-desa.create') }}" class="btn btn-primary" title="Tambah">
                                    <i class="fas fa-plus"></i> Tambah Informasi Pemerintahan Desa
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
@include('layouts.components.alert')
<div class="row mt-4 justify-content-center">
    @forelse ($pemerintahan_desa as $item)
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card animate-up shadow">
                <a href="{{ route('pemerintahan-desa.show', ['pemerintahan_desa' => $item, 'slug' => Str::slug($item->judul)]) }}">
                    <div class="card-img" style="background-image: url('{{ $item->gambar ? url(Storage::url($item->gambar)) : url(Storage::url('noimage.jpg')) }}');"></div>
                </a>
                <div class="card-body text-center">
                    <a href="{{ route('pemerintahan-desa.show', ['pemerintahan_desa' => $item, 'slug' => Str::slug($item->judul)]) }}">
                        <h3>{{ $item->judul }}</h3>
                        <div class="mt-3 d-flex justify-content-between text-sm text-muted">
                            <i class="fas fa-clock"> {{ $item->created_at->diffForHumans() }}</i>
                            <i class="fas fa-eye"> {{ $item->dilihat }} Kali Dibaca</i>
                        </div>
                    </a>
                    <div class="mt-3">
                        <a href="{{ route('pemerintahan-desa.edit', $item) }}" class="btn btn-sm btn-success" title="Edit"><i class="fas fa-edit"></i> Edit</a>
                        <a class="btn btn-sm btn-danger hapus-data" data-nama="{{ $item->judul }}" data-action="{{ route('pemerintahan-desa.destroy', $item) }}" data-toggle="modal" href="#modal-hapus" title="Hapus"><i class="fas fa-trash"></i> Hapus</a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center">
            <div class="alert alert-info">
                <h4>Data belum tersedia</h4>
                <p>Silakan tambahkan data baru.</p>
            </div>
        </div>
    @endforelse
    <div class="col-12">
        {{ $pemerintahan_desa->links() }}
    </div>
</div>

<div class="modal fade" id="modal-hapus" tabindex="-1" role="dialog" aria-labelledby="modal-hapus" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-danger">

            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-delete">Hapus Informasi Pemerintahan Desa?</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="py-3 text-center">
                    <i class="ni ni-bell-55 ni-3x"></i>
                    <h4 class="heading mt-4">Perhatian!!</h4>
                    <p>Menghapus informasi pemerintahan desa akan menghapus semua data yang dimilikinya</p>
                    <p><strong id="nama-hapus"></strong></p>
                </div>

            </div>

            <div class="modal-footer">
                <form id="form-hapus" action="" method="POST" >
                    @csrf @method('delete')
                    <button type="submit" class="btn btn-white">Yakin</button>
                </form>
                <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Tidak</button>
            </div>

        </div>
    </div>
</div>
@endsection