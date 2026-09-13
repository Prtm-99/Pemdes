@extends('layouts.layout')
@section('title', 'Desa ' . $desa->nama_desa . ' - ' . $pemerintahan_desa->judul)

@section('styles')
<meta name="description" content="{{ $pemerintahan_desa->judul }} Pemerintahan Desa {{ $desa->nama_desa }}, Kecamatan {{ $desa->nama_kecamatan }}, Kabupaten {{ $desa->nama_kabupaten }}.">

<style>
    .animate-up:hover {
        transform: translateY(-5px);
        transition: transform 0.3s ease;
    }
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s ease;
        border: none;
    }
    .card:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }
    .card-img-top {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        height: 150px; /* Diperkecil dari 200px ke 150px */
        object-fit: cover;
    }
    .card-body {
        padding: 20px;
    }
    .card-title {
        font-size: 1.25rem;
        margin-bottom: 10px;
        color: #343a40;
    }
    .card-text {
        font-size: 0.9rem;
        color: #6c757d;
    }
    .header-section {
        padding: 60px 0;
        background-color: #f8f9fa;
        margin-bottom: 40px;
    }
    .header-section h2 {
        font-size: 1.2rem;
        color: #6c757d;
    }
    .header-section h1 {
        font-size: 2.5rem;
        color: #343a40;
        margin-top: 10px;
    }
    .content-section {
        padding: 20px 0;
    }
    .content-section img {
        border-radius: 10px;
        margin-bottom: 20px;
        width: 80%; /* Gambar utama diperkecil menjadi 80% dari lebar container */
        max-width: 600px; /* Batasi lebar maksimum gambar */
    }
    .section-title {
        font-size: 2rem;
        color: #343a40;
        margin-bottom: 30px;
        text-align: center;
    }
</style>
@endsection

@section('header')
<div class="header-section text-center">
    <h2 class="text-muted">PEMERINTAHAN DESA</h2>
    <h1>{{ $pemerintahan_desa->judul }}</h1>
</div>
@endsection

@section('content')
<div class="content-section">
    @if ($pemerintahan_desa->gambar)
        <div class="row mb-5">
            <div class="col-md text-center">
                <img class="img-fluid rounded" src="{{ url(Storage::url($pemerintahan_desa->gambar)) }}" alt="Gambar Informasi Pemerintahan Desa {{ $pemerintahan_desa->judul }}">
            </div>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            {!! $pemerintahan_desa->konten !!}
        </div>
    </div>

    @if ($pemerintahan_desas->count() > 2)
        <h2 class="section-title">Informasi Pemerintahan Desa Lainnya</h2>
        <div class="row">
            @foreach ($pemerintahan_desas as $item)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card animate-up">
                        @if ($item->gambar)
                            <img src="{{ url(Storage::url($item->gambar)) }}" class="card-img-top" alt="Gambar {{ $item->judul }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->judul }}</h5>
                            <p class="card-text"><i class="fas fa-clock"></i> {{ $item->created_at->diffForHumans() }}</p>
                            <a href="{{ route('pemerintahan-desa.show', ['pemerintahan_desa' => $item, 'slug' => Str::slug($item->judul)]) }}" class="btn btn-primary btn-sm">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection