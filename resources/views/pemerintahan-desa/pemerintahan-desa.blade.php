@extends('layouts.layout')

@section('title', 'Website Resmi Pemerintah Desa '. ($desa->nama_desa ?? '') . ' - Pemerintahan Desa')

@section('styles')
<meta name="description" content="Macam-macam sejarah Desa {{ $desa->nama_desa ?? '' }}, Kecamatan {{ $desa->nama_kecamatan ?? '' }}, Kabupaten {{ $desa->nama_kabupaten ?? '' }}.">

<style>
    /* Hilangkan scroll horizontal dan atur struktur flex agar footer selalu di bawah */
    html, body {
        overflow-x: hidden;
        margin: 0;
        padding: 0;
        height: 100%;
    }

    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    /* Bungkus konten utama agar fleksibel mendorong footer ke bawah */
    .main-container {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center; /* Posisikan konten di tengah secara vertikal jika kosong */
    }

    /* Header Styling dengan padding yang sangat lapang */
    header {
        background: linear-gradient(135deg, #1c4e80, #0865FE);
        padding: 120px 0 110px 0; /* Padding atas dan bawah diperbesar maksimal */
        color: white;
        text-align: center;
    }

    header h1 {
        font-size: 2.8rem;
        font-weight: bold;
        margin-bottom: 15px;
    }

    header p {
        font-size: 1.3rem;
        opacity: 0.9;
        margin-bottom: 0;
    }

    /* Konten Utama dengan jarak atas/bawah yang sangat lapang */
    .content-wrapper {
        margin-top: 120px;
        margin-bottom: 110px;
        padding: 0 15px;
    }

    /* Card Styling */
    .card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-bottom: 25px;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
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

    .card-body {
        padding: 25px;
        text-align: center;
    }

    .card-body h3 {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 12px;
        color: #333;
    }

    .card-body p {
        font-size: 1rem;
        color: #6c757d;
    }

    .card-body .text-muted {
        font-size: 0.9rem;
        color: #6c757d;
    }

    /* Empty State Styling dengan padding ekstra besar agar sangat lapang */
    .empty-state {
        padding: 100px 30px;
        background: #f8f9fa;
        border-radius: 16px;
        border: 2px dashed #ced4da;
    }

    .empty-state h3 {
        color: #6c757d;
        font-weight: 600;
        margin: 0;
        font-size: 1.7rem;
    }

    /* Pagination */
    .pagination {
        justify-content: center;
        margin-top: 60px;
    }

    .pagination .page-item .page-link {
        color: #0865FE;
        border: 1px solid #dee2e6;
        margin: 0 6px;
        border-radius: 6px;
        padding: 10px 16px;
    }

    .pagination .page-item.active .page-link {
        background-color: #0865FE;
        border-color: #0865FE;
        color: white;
    }

    /* Responsif */
    @media (max-width: 768px) {
        header {
            padding: 90px 0 70px 0;
        }

        header h1 {
            font-size: 2.1rem;
        }

        header p {
            font-size: 1.05rem;
        }

        .content-wrapper {
            margin-top: 50px;
            margin-bottom: 70px;
        }

        .empty-state {
            padding: 70px 20px;
        }
    }
</style>
@endsection

@section('header')
<header>
    <div class="container">
        <h1>PEMERINTAHAN DESA</h1>
        <p>Pemerintahan Desa {{ $desa->nama_desa ?? '' }}, masyarakat dapat dengan mudah mengetahui informasi seputar pemerintahan desa {{ $desa->nama_desa ?? '' }}.</p>
    </div>
</header>
@endsection

@section('content')
<div class="main-container">
    <div class="container content-wrapper">
        <div class="row justify-content-center">
            @forelse ($pemerintahan_desa as $item)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card animate-up shadow-sm">
                        <a href="{{ route('pemerintahan-desa.show', ['pemerintahan_desa' => $item, 'slug' => Str::slug($item->judul)]) }}">
                            <div class="card-img" style="background-image: url('{{ $item->gambar ? asset('storage/' . str_replace('public/', '', $item->gambar)) : asset('storage/noimage.jpg') }}');"></div>
                        </a>
                        <div class="card-body">
                            <a href="{{ route('pemerintahan-desa.show', ['pemerintahan_desa' => $item, 'slug' => Str::slug($item->judul)]) }}" class="text-decoration-none">
                                <h3>{{ $item->judul }}</h3>
                                <div class="mt-3 d-flex justify-content-between text-sm text-muted">
                                    <span><i class="fas fa-clock"></i> {{ $item->created_at->diffForHumans() }}</span>
                                    <span><i class="fas fa-eye"></i> {{ $item->dilihat }} Kali Dibaca</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-lg-9 col-md-11">
                    <div class="empty-state text-center shadow-sm">
                        <h3>Data belum tersedia</h3>
                    </div>
                </div>
            @endforelse
        </div>

        @if(method_exists($pemerintahan_desa, 'links'))
            <div class="row">
                <div class="col-12">
                    {{ $pemerintahan_desa->links() }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection