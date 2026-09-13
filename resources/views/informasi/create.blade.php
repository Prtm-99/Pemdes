@extends('layouts.app')

@section('title', 'Tambah Informasi')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/jquery.fancybox.css') }}">
<style>
    .upload-image:hover {
        cursor: pointer;
        opacity: 0.7;
    }
    .content-container {
        position: relative;
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 10;
        margin-top: -50px; /* Mengangkat formulir agar terlihat */
    }
    .header-bg {
        background-color: #FFD700; /* Warna kuning */
        padding: 150px 0;
        text-align: center;
    }
</style>
@endsection

@section('content-header')
<div class="header-bg">
    <div class="container">
        <h2 class="text-dark">Tambah Informasi</h2>
    </div>
</div>
@endsection

@section('content')
@include('layouts.components.alert')

<div class="container content-container">
    <form action="{{ route('informasi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label>Gambar</label>
            <div class="text-center">
                <img onclick="$(this).siblings('.images').click()" class="mw-100 upload-image" style="max-height: 300px" src="{{ asset('storage/upload.jpg') }}" alt="">
                <input accept="image/*" onchange="uploadImage(this)" type="file" name="gambar" class="images" style="display: none">
                <span class="invalid-feedback font-weight-bold"></span>
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">Simpan</button>
            <button type="button" class="btn btn-secondary bg-red" onclick="history.back()">Kembali</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/jquery.fancybox.js') }}"></script>
<script>
    function uploadImage(inputFile) {
        if (inputFile.files && inputFile.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(inputFile).siblings('img').attr("src", e.target.result);
            }
            reader.readAsDataURL(inputFile.files[0]);
        }
    }
</script>
@endpush
