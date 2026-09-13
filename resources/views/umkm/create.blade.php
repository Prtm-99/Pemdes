@extends('layouts.app')

@section('title', 'Tambah UMKM')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<style>
    .ikon {
        font-family: fontAwesome;
    }
    .upload-image {
        border: 2px dashed #ccc;
        padding: 10px;
        border-radius: 10px;
        max-height: 300px;
        width: 100%;
        object-fit: cover;
    }
    .upload-image:hover {
        cursor: pointer;
        opacity: 0.7;
        border-color: #4a90e2;
        background-color: #f9f9f9;
    }
    .form-group {
        margin-bottom: 1.5rem;
    }
    .header {
        padding: 100px 0;
        background: linear-gradient(87deg, #1f3a93, #4a90e2);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .card.shadow {
        border-radius: 10px;
    }
</style>
@endsection

@section('content-header')
<div class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card shadow h-100">
                    <div class="card-header border-0">
                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-between text-center text-md-left">
                            <div class="mb-3">
                                <h2 class="mb-0">Tambah UMKM</h2>
                                <p class="mb-0 text-sm">Kelola UMKM</p>
                            </div>
                            <div class="mb-3">
                                <a href="{{ route('umkm.index') }}" class="btn btn-success" title="Kembali"><i class="fas fa-arrow-left"></i> Kembali</a>
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
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card bg-secondary shadow h-100">
            <div class="card-header bg-white border-0">
                <h3 class="mb-0">Tambah UMKM</h3>
            </div>
            <div class="card-body">
                <form autocomplete="off" action="{{ route('umkm.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="form-control-label">Gambar</label>
                        <div class="text-center">
                            <img onclick="$(this).siblings('.images').click()" class="upload-image" src="{{ asset('path/to/placeholder-image.jpg') }}" alt="Upload Gambar">
                            <input accept="image/*" onchange="uploadImage(this)" type="file" name="gambar" class="images" style="display: none">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Nama UMKM</label>
                        <input class="form-control @error('nama') is-invalid @enderror" name="nama" placeholder="Masukkan Nama UMKM ..." value="{{ old('nama') }}">
                        @error('nama') <div class="invalid-feedback font-weight-bold">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi') <div class="invalid-feedback font-weight-bold">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Link</label>
                        <input class="form-control @error('link') is-invalid @enderror" name="link" placeholder="Masukkan Link UMKM ..." value="{{ old('link') }}">
                        @error('link') <div class="invalid-feedback font-weight-bold">{{ $message }}</div> @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" id="simpan">
                        <span id="submit-text">SIMPAN</span>
                        <span id="loading-text" style="display: none;">
                            <i class="fas fa-spinner fa-spin"></i> Loading ...
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
<script>
    function uploadImage(inputFile) {
        if (inputFile.files && inputFile.files[0]) {
            const file = inputFile.files[0];
            const validImageTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!validImageTypes.includes(file.type)) {
                alert('File yang diupload harus berupa gambar (JPEG, PNG, JPG).');
                inputFile.value = ''; // Clear input file
                return;
            }
            var reader = new FileReader();
            reader.onload = function (e) {
                $(inputFile).siblings('img').attr("src", e.target.result);
            }
            reader.readAsDataURL(inputFile.files[0]);
        }
    }
    $(document).ready(function () {
        $(document).on("submit", "form", function () {
            $(this).find("#submit-text").hide();
            $(this).find("#loading-text").show();
            $(this).find("button:submit").attr('disabled', 'disabled');
        });

        $("textarea").summernote({
            dialogsInBody: true,
            placeholder: 'Silahkan isi deskripsi UMKM',
            tabsize: 2,
            height: 300,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
</script>
@endpush