@extends('layouts.app')

@section('title', 'Daftar Informasi')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/jquery.fancybox.css') }}">
<style>
    .upload-image:hover{
        cursor: pointer;
        opacity: 0.7;
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
                                <h2 class="mb-0">Daftar Informasi</h2>
                                <p class="mb-0 text-sm">Kelola Informasi {{ config('app.name') }}</p>
                            </div>
                            <div class="mb-3">
                                <a href="{{ route('informasi.create') }}" class="btn btn-primary"><i class="fas fa-plus mr-2"></i> Tambah Informasi</a>
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
    @forelse ($informasis as $info)
        <div class="col-lg-4 col-md-6 mb-3 img-scale-up">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $info->judul }}</h5>
                    <p class="card-text">{{ $info->deskripsi }}</p>
                    @if($info->gambar)
                        <a href="{{ asset('storage/' . $info->gambar) }}" data-fancybox data-caption="{{ $info->judul }}">
                            <img class="mw-100" src="{{ asset('storage/' . $info->gambar) }}" alt="Gambar Informasi">
                        </a>
                    @endif
                    <div class="mt-3 d-flex justify-content-center">
                        <a href="{{ route('informasi.edit', $info->id) }}" class="btn btn-warning mr-2">Edit</a>
                        <form action="{{ route('informasi.destroy', $info->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col text-center">
            <h4>Data belum tersedia</h4>
        </div>
    @endforelse
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/jquery.fancybox.js') }}"></script>
@endpush
