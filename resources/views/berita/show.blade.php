@extends('layouts.layout')
@section('title', 'Desa ' . $desa->nama_desa . ' - Berita ' . $berita->judul)

@section('styles')
<meta name="description" content="Berita {{ $berita->judul }} Desa {{ $desa->nama_desa }}, Kecamatan {{ $desa->nama_kecamatan }}, Kabupaten {{ $desa->nama_kabupaten }}.">

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
        height: 100%; /* Memastikan card memiliki tinggi yang sama */
    }
    .card:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }
    .card-img {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        height: 150px; /* Diperkecil dari 200px ke 150px */
        background-size: cover;
        background-position: center;
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
    .card-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); /* Card akan menyesuaikan lebar layar */
        gap: 20px; /* Jarak antar card */
    }
    .btn-read-more {
        margin-top: 10px;
        width: 100%; /* Tombol memenuhi lebar card */
    }
</style>
@endsection

@section('header')
<div class="header-section text-center">
    <h2 class="text-muted">BERITA</h2>
    <h1>{{ $berita->judul }}</h1>
</div>
@endsection

@section('content')
<div class="content-section">
    @if ($berita->gambar)
        <div class="row mb-5">
            <div class="col-md text-center">
                <img class="img-fluid rounded" src="{{ url(Storage::url($berita->gambar)) }}" alt="Gambar Berita {{ $berita->judul }}">
            </div>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            {!! $berita->konten !!}
        </div>
    </div>

    @if ($beritas->count() > 0)
        <h2 class="section-title">Berita Lainnya</h2>
        <div class="card-container">
            @foreach ($beritas as $item)
                <div class="card animate-up">
                    @if ($item->gambar)
                        <a href="{{ route('berita.show', ['berita' => $item, 'slug' => Str::slug($item->judul)]) }}">
                            <div class="card-img" style="background-image: url('{{ url(Storage::url($item->gambar)) }}');"></div>
                        </a>
                    @endif
                    <div class="card-body">
                        <a href="{{ route('berita.show', ['berita' => $item, 'slug' => Str::slug($item->judul)]) }}">
                            <h5 class="card-title">{{ $item->judul }}</h5>
                            <p class="card-text"><i class="fas fa-clock"></i> {{ $item->created_at->diffForHumans() }}</p>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection