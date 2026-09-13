@extends('layouts.layout')

@section('title', 'UMKM')

@section('styles')
<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<style>
    /* Global Styles */
    body {
        font-family: 'Poppins', sans-serif;
        overflow-x: hidden;
    }

    /* Tambahkan margin untuk konten */
    .content-wrapper {
        margin-top: 120px; /* Sesuaikan dengan tinggi header */
        margin-bottom: 100px; /* Sesuaikan dengan tinggi footer */
    }
    /* Background gradient untuk header */
    header {
        background: linear-gradient(135deg, #1c4e80, #0865FE); /* Gradien biru muda ke biru tua */
        padding: 20px 0; /* Tambahkan padding untuk header */
    }

    /* Card UMKM */
    .card-umkm {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background: white;
        margin-bottom: 20px;
    }

    .card-umkm:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
    }

    .card-umkm .card-img {
        height: 200px;
        background-size: cover;
        background-position: center;
        transition: transform 0.3s ease;
    }

    .card-umkm:hover .card-img {
        transform: scale(1.1);
    }

    .card-umkm .card-body {
        padding: 20px;
        text-align: center;
    }

    .card-umkm h3 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 10px;
        color: #333;
    }

    .card-umkm p {
        font-size: 1rem;
        color: #666;
        margin-bottom: 15px;
    }

    .card-umkm .btn-visit {
        background: linear-gradient(45deg, #007bff, #0056b3);
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 25px;
        transition: background 0.3s ease;
    }

    /* No Data Available */
    .no-data {
        text-align: center;
        padding: 50px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .no-data h4 {
        font-size: 1.5rem;
        color: #333;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .header h1 {
            font-size: 2rem;
        }

        .header p {
            font-size: 1rem;
        }

        .card-umkm {
            margin-bottom: 15px;
        }
    }
</style>
@endsection

@section('content')
@include('layouts.components.alert')

<div class="content-wrapper">
    <div class="header">
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @forelse ($umkms as $umkm)
                    <div class="col-lg-4 col-md-6">
                        <div class="card-umkm">
                            <a href="{{ route('umkm.show', ['umkm' => $umkm, 'slug' => Str::slug($umkm->nama)]) }}">
                                <div class="card-img" style="background-image: url('{{ $umkm->gambar ? asset('storage/' . str_replace('public/', '', $umkm->gambar)) : asset('storage/noimage.jpg') }}');"></div>
                            </a>
                            <div class="card-body">
                                <a href="{{ route('umkm.show', ['umkm' => $umkm, 'slug' => Str::slug($umkm->nama)]) }}" class="text-decoration-none">
                                    <h3>{{ $umkm->nama }}</h3>
                                    
                                    {{-- Membersihkan tag HTML dan spasi kosong bawaan Summernote --}}
                                    @php
                                        $cleanDesc = trim(strip_tags($umkm->deskripsi));
                                    @endphp

                                    @if(!empty($cleanDesc))
                                        <p>{{ Str::limit($cleanDesc, 100) }}</p>
                                    @else
                                        <p class="text-muted font-italic">Tidak ada deskripsi</p>
                                    @endif
                                </a>
                                <div class="mt-3">
                                    <a href="{{ $umkm->link }}" target="_blank" class="btn btn-visit">
                                        <i class="fas fa-link"></i> Kunjungi
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col">
                        <div class="no-data">
                            <h4>Data belum tersedia</h4>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection