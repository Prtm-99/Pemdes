@extends('layouts.layout')
@section('title', 'Website Resmi Pemerintah Desa '. $desa->nama_desa . ' - Berita')

@section('styles')
<meta name="description" content="Macam-macam berita Desa {{ $desa->nama_desa }}, Kecamatan {{ $desa->nama_kecamatan }}, Kabupaten {{ $desa->nama_kabupaten }}.">

<style>
    body {
        overflow-x: hidden;
    }

    .animate-up:hover {
        top: -5px;
    }
    /* Tambahkan margin untuk konten */
    .content-wrapper {
        margin-top: 120px; /* Sesuaikan dengan tinggi header */
        margin-bottom: 130px; /* Sesuaikan dengan tinggi footer */
    }
    /* Background gradient untuk header */
    header {
        background: linear-gradient(135deg, #1c4e80, #0865FE); /* Gradien biru muda ke biru tua */
        padding: 20px 0; /* Tambahkan padding untuk header */
    }
</style>
@endsection

@section('header')
<h1 class="text-white text-muted">BERITA</h1>
<p class="text-white">Berita Desa {{ $desa->nama_desa }}, masyarakat dapat dengan mudah mengetahui informasi seputar berita desa {{ $desa->nama_desa }}.</p>
@endsection

@section('content')
<div class="content-wrapper">
    <div class="row justify-content-center mt-4 mb-4">
        @forelse ($berita as $item)
            <div class="col-lg-4 col-md-6 mb-3">
                <div class="card animate-up shadow">
                    <a href="{{ route('berita.show', ['berita' => $item, 'slug' => Str::slug($item->judul)]) }}">
                        <div class="card-img" style="background-image: url('{{ $item->gambar ? url(Storage::url($item->gambar)) : url(Storage::url('noimage.jpg')) }}'); background-size: cover; height: 200px;"></div>
                    </a>
                    <div class="card-body text-center">
                        <a href="{{ route('berita.show', ['berita' => $item, 'slug' => Str::slug($item->judul)]) }}">
                            <h3>{{ $item->judul }}</h3>
                            <div class="mt-3 d-flex justify-content-between text-sm text-muted">
                                <i class="fas fa-clock"> {{ $item->created_at->diffForHumans() }}</i>
                                <i class="fas fa-eye"> {{ $item->dilihat }} Kali Dibaca</i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col">
                <div class="card">
                    <div class="card-body text-center">
                        <h3>Data belum tersedia</h3>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
