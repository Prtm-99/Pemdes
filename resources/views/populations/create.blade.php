@extends('layouts.app')

@section('title', 'Tambah Data Penduduk')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<style>
    .ikon {
        font-family: fontAwesome;
    }
    .upload-image:hover{
        cursor: pointer;
        opacity: 0.7;
    }
    .form-group {
        margin-bottom: 1rem;
    }
    .card-body {
        padding: 2rem;
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
                                <h2 class="mb-0">Tambah Data Penduduk</h2>
                                <p class="mb-0 text-sm">Kelola Data Penduduk</p>
                            </div>
                            <div class="mb-3">
                                <a href="{{ route('populations.index') }}" class="btn btn-success" title="Kembali"><i class="fas fa-arrow-left"></i> Kembali</a>
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
<div class="row">
    <div class="col">
        <div class="card bg-secondary shadow h-100">
            <div class="card-header bg-white border-0">
                <h3 class="mb-0">Tambah Data Penduduk</h3>
            </div>
            <div class="card-body">
                <form autocomplete="off" action="{{ route('populations.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="mb-3">Data Demografi</h4>
                            <div class="form-group">
                                <label class="form-control-label">Jumlah Laki-laki</label>
                                <input type="number" class="form-control @error('male') is-invalid @enderror" name="male" placeholder="Masukkan Jumlah Laki-laki" required>
                                @error('male') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Jumlah Perempuan</label>
                                <input type="number" class="form-control @error('female') is-invalid @enderror" name="female" placeholder="Masukkan Jumlah Perempuan" required>
                                @error('female') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Jumlah Kematian</label>
                                <input type="number" class="form-control @error('deaths') is-invalid @enderror" name="deaths" placeholder="Masukkan Jumlah Kematian" required>
                                @error('deaths') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Jumlah Kelahiran</label>
                                <input type="number" class="form-control @error('births') is-invalid @enderror" name="births" placeholder="Masukkan Jumlah Kelahiran" required>
                                @error('births') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <h4 class="mb-3">Data Transmigrasi</h4>
                            <div class="form-group">
                                <label class="form-control-label">Jumlah Transmisi Masuk</label>
                                <input type="number" class="form-control @error('migration_in') is-invalid @enderror" name="migration_in" placeholder="Masukkan Jumlah Transmisi Masuk" required>
                                @error('migration_in') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Jumlah Transmisi Keluar</label>
                                <input type="number" class="form-control @error('migration_out') is-invalid @enderror" name="migration_out" placeholder="Masukkan Jumlah Transmisi Keluar" required>
                                @error('migration_out') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h4 class="mb-3">Data Agama</h4>
                            <div class="form-group">
                                <label class="form-control-label">Islam</label>
                                <input type="number" class="form-control @error('islam') is-invalid @enderror" name="islam" placeholder="Masukkan Jumlah Pemeluk Islam" value="0">
                                @error('islam') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Kristen</label>
                                <input type="number" class="form-control @error('christian') is-invalid @enderror" name="christian" placeholder="Masukkan Jumlah Pemeluk Kristen" value="0">
                                @error('christian') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Katolik</label>
                                <input type="number" class="form-control @error('catholic') is-invalid @enderror" name="catholic" placeholder="Masukkan Jumlah Pemeluk Katolik" value="0">
                                @error('catholic') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Hindu</label>
                                <input type="number" class="form-control @error('hindu') is-invalid @enderror" name="hindu" placeholder="Masukkan Jumlah Pemeluk Hindu" value="0">
                                @error('hindu') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Buddha</label>
                                <input type="number" class="form-control @error('buddha') is-invalid @enderror" name="buddha" placeholder="Masukkan Jumlah Pemeluk Buddha" value="0">
                                @error('buddha') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Konghucu</label>
                                <input type="number" class="form-control @error('confucianism') is-invalid @enderror" name="confucianism" placeholder="Masukkan Jumlah Pemeluk Konghucu" value="0">
                                @error('confucianism') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h4 class="mb-3">Data Pekerjaan</h4>
                            <div class="form-group">
                                <label class="form-control-label">Bekerja</label>
                                <input type="number" class="form-control @error('employed') is-invalid @enderror" name="employed" placeholder="Masukkan Jumlah yang Bekerja" required>
                                @error('employed') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Tidak Bekerja</label>
                                <input type="number" class="form-control @error('unemployed') is-invalid @enderror" name="unemployed" placeholder="Masukkan Jumlah yang Tidak Bekerja" required>
                                @error('unemployed') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Ibu Rumah Tangga</label>
                                <input type="number" class="form-control @error('housewife') is-invalid @enderror" name="housewife" placeholder="Masukkan Jumlah Ibu Rumah Tangga" required>
                                @error('housewife') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Pelajar</label>
                                <input type="number" class="form-control @error('student') is-invalid @enderror" name="student" placeholder="Masukkan Jumlah Pelajar" required>
                                @error('student') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block mt-4" id="simpan">SIMPAN</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
<script>
    $(document).ready(function () {
        $(document).on("submit","form", function () {
            $(this).children("button:submit").attr('disabled','disabled');
            $(this).children("button:submit").html(`<img height="20px" src="{{ url('/storage/loading.gif') }}" alt=""> Loading ...`);
        });
    });
</script>
@endpush