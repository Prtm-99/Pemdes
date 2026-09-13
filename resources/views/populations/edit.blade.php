@extends('layouts.app')

@section('title', 'Edit Data Penduduk')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
<style>
    .card-header {
        background: white;
        color: white;
    }
    .btn-action {
        margin: 2px;
        padding: 5px 10px;
        font-size: 14px;
    }
    .form-group {
        margin-bottom: 15px;
    }
    .form-control {
        border-radius: 5px;
    }
    .section-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #eee;
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
                                <h2 class="mb-0">Edit Data Penduduk</h2>
                                <p class="mb-0 text-sm">Kelola Data Penduduk</p>
                            </div>
                            <div class="mb-3">
                                <a href="{{ route('populations.index') }}" class="btn btn-success" title="Kembali"><i class="bi bi-arrow-left"></i> Kembali</a>
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
        <div class="card shadow">
            <div class="card-header bg-white border-0">
                <h3 class="mb-0">Edit Data Penduduk</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('populations.update', $population) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="section-title">Data Demografi</h4>
                            <div class="form-group">
                                <label class="form-control-label">Laki-laki</label>
                                <input type="number" class="form-control @error('male') is-invalid @enderror" name="male" value="{{ old('male', $population->male) }}" required>
                                @error('male') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Perempuan</label>
                                <input type="number" class="form-control @error('female') is-invalid @enderror" name="female" value="{{ old('female', $population->female) }}" required>
                                @error('female') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Kematian</label>
                                <input type="number" class="form-control @error('deaths') is-invalid @enderror" name="deaths" value="{{ old('deaths', $population->deaths) }}" required>
                                @error('deaths') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Kelahiran</label>
                                <input type="number" class="form-control @error('births') is-invalid @enderror" name="births" value="{{ old('births', $population->births) }}" required>
                                @error('births') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <h4 class="section-title">Data Transmigrasi</h4>
                            <div class="form-group">
                                <label class="form-control-label">Transmisi Masuk</label>
                                <input type="number" class="form-control @error('migration_in') is-invalid @enderror" name="migration_in" value="{{ old('migration_in', $population->migration_in) }}" required>
                                @error('migration_in') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Transmisi Keluar</label>
                                <input type="number" class="form-control @error('migration_out') is-invalid @enderror" name="migration_out" value="{{ old('migration_out', $population->migration_out) }}" required>
                                @error('migration_out') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h4 class="section-title">Data Agama</h4>
                            <div class="form-group">
                                <label class="form-control-label">Islam</label>
                                <input type="number" class="form-control @error('islam') is-invalid @enderror" name="islam" value="{{ old('islam', $population->islam) }}" required>
                                @error('islam') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Kristen</label>
                                <input type="number" class="form-control @error('christian') is-invalid @enderror" name="christian" value="{{ old('christian', $population->christian) }}" required>
                                @error('christian') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Katolik</label>
                                <input type="number" class="form-control @error('catholic') is-invalid @enderror" name="catholic" value="{{ old('catholic', $population->catholic) }}" required>
                                @error('catholic') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Hindu</label>
                                <input type="number" class="form-control @error('hindu') is-invalid @enderror" name="hindu" value="{{ old('hindu', $population->hindu) }}" required>
                                @error('hindu') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Buddha</label>
                                <input type="number" class="form-control @error('buddha') is-invalid @enderror" name="buddha" value="{{ old('buddha', $population->buddha) }}" required>
                                @error('buddha') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Konghucu</label>
                                <input type="number" class="form-control @error('confucianism') is-invalid @enderror" name="confucianism" value="{{ old('confucianism', $population->confucianism) }}" required>
                                @error('confucianism') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <h4 class="section-title">Data Pekerjaan</h4>
                            <div class="form-group">
                                <label class="form-control-label">Bekerja</label>
                                <input type="number" class="form-control @error('employed') is-invalid @enderror" name="employed" value="{{ old('employed', $population->employed) }}" required>
                                @error('employed') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Tidak Bekerja</label>
                                <input type="number" class="form-control @error('unemployed') is-invalid @enderror" name="unemployed" value="{{ old('unemployed', $population->unemployed) }}" required>
                                @error('unemployed') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Ibu Rumah Tangga</label>
                                <input type="number" class="form-control @error('housewife') is-invalid @enderror" name="housewife" value="{{ old('housewife', $population->housewife) }}" required>
                                @error('housewife') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Pelajar</label>
                                <input type="number" class="form-control @error('student') is-invalid @enderror" name="student" value="{{ old('student', $population->student) }}" required>
                                @error('student') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-action"><i class="bi bi-save"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection