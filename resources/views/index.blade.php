@extends('layouts.layout')
@section('title', 'Website Resmi Pemerintah Desa ' . ($desa->nama_desa ?? '') . ' - Beranda')

@section('styles')
<meta name="description" content="Website Resmi Pemerintah Desa {{ $desa->nama_desa ?? '' }}, Kecamatan {{ $desa->nama_kecamatan ?? '' }}, Kabupaten {{ $desa->nama_kabupaten ?? '' }}. Melayani pembuatan surat keterangan secara online">
<link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<link rel="stylesheet" href="{{ asset('css/jquery.fancybox.css') }}">
<link rel="stylesheet" href="{{ asset('/css/style.css') }}">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<style>
    /* Hilangkan scrollbar horizontal dan vertikal */
    html, body {
        overflow-x: hidden; /* Menghilangkan scrollbar horizontal */
        overflow-y: auto; /* Menghilangkan scrollbar vertikal */
    }

    /* Slider Styles */
    #owl-one {
        width: 100vw;
        height: 100vh; /* Slider menempati seluruh tinggi viewport */
        overflow: hidden;
        position: relative;
        z-index: 1;
    }

    #owl-one .item {
        width: 100vw;
        height: 100vh; /* Slider menempati seluruh tinggi viewport */
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #owl-one .item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Overlay Styles */
    .mantine-Overlay-root {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: var(--overlay-bg);
        z-index: var(--overlay-z-index);
    }

    /* Gradient Text for h2 */
    h2.section-title {
        font-size: 2.5rem; /* Ukuran font lebih besar */
        font-weight: 800; /* Font lebih tebal */
        background: linear-gradient(135deg, #1c4e80, #0865FE); /* Gradient biru tua ke biru muda */
        -webkit-background-clip: text; /* Menerapkan gradient ke teks */
        -webkit-text-fill-color: transparent; /* Membuat teks transparan untuk menampilkan gradient */
        display: inline-block; /* Agar gradient hanya berlaku pada teks */
    }

    /* Other Styles */
    .card {
        margin: 20px auto;
        max-width: 1200px;
        transition: transform 0.3s ease;
        border: 1px solid #ddd;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .card-img {
        width: 100%;
        height: 200px;
        background-size: cover;
        background-position: center;
    }

    .card-body {
        padding: 20px;
        background-color: #f9f9f9;
    }

    .card-body h3 {
        font-size: 1.5rem;
        margin-bottom: 10px;
        color: #333;
    }

    .card-body p {
        font-size: 1rem;
        color: #666;
    }

    .card-body .text-sm {
        font-size: 0.875rem;
        color: #999;
    }

    .card-body .d-flex {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 15px;
        padding: 15px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .gallery-item {
        position: relative;
        overflow: hidden;
    }

    .gallery-item img {
        width: 100%;
        height: auto;
        transition: transform 0.3s ease;
    }

    .gallery-item:hover img {
        transform: scale(1.1);
    }

    .gallery-item i {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 2rem;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .gallery-item:hover i {
        opacity: 1;
    }

    .center-content {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        text-align: center;
    }

    .center-content .row {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
    }

    .visi-misi-section {
        padding: 60px 0;
        background-color: #f9f9f9;
    }

    .visi-misi-content {
        padding: 20px;
    }

    .visi-misi-content h2 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .visi-misi-content h3 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .visi-misi-content p,
    .visi-misi-content ul {
        font-size: 1rem;
        line-height: 1.8;
    }

    .visi-misi-content ul {
        list-style-type: disc;
        padding-left: 20px;
    }

    .visi-misi-content ul li {
        margin-bottom: 10px;
    }

    .img-fluid {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Mobile Styles */
    @media (max-width: 767.98px) {
        header.navbar {
            padding: 0 10px;
        }

        .visi-misi-section .row {
            flex-direction: column-reverse;
        }

        .visi-misi-content {
            padding: 10px;
        }

        .visi-misi-content h2 {
            font-size: 1.5rem;
        }

        .visi-misi-content h3 {
            font-size: 1.2rem;
        }

        .visi-misi-content p,
        .visi-misi-content ul {
            font-size: 0.9rem;
        }

        .card {
            margin: 10px auto;
        }

        .card-body h3 {
            font-size: 1.2rem;
        }

        .card-body p {
            font-size: 0.9rem;
        }

        .gallery-grid {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 10px;
            padding: 10px;
        }

        /* Adjust carousel height for mobile */
        #owl-one {
            height: 50vh;
        }

        #owl-one .item {
            height: 50vh;
        }

        /* Adjust iframe height for mobile */
        iframe {
            height: 300px;
        }
    }
</style>
@endsection

@section('header')
@endsection

@section('content')
<div id="owl-one" class="owl-carousel owl-theme">
    @foreach($gallery as $key => $item)
        <div class="item">
            <img src="{{ asset('storage/' . str_replace('public/', '', $item->gallery)) }}" alt="Slide Show {{ $key }}" class="h-full w-full object-cover">
            <!-- Overlay -->
            <div style="--overlay-bg:rgba(0, 0, 0, 0.6);--overlay-z-index:5;opacity:0.6" class="m-9814e45f mantine-Overlay-root absolute inset-0"></div>
        </div>
    @endforeach
</div>

<section class="visi-misi-section mb-5">
    <div class="container">
        <div class="row align-items-center">
            <!-- Gambar -->
            <div class="col-12 col-md-6 order-md-2 text-center">
                <img height="350px" src="{{ url('/storage/Logo0.png') }}" alt="logo" class="img-fluid">
            </div>      
            <!-- Teks Visi Misi -->
            <div class="col-12 col-md-6 order-md-1">
                <div class="visi-misi-content">
                    <h2 class="section-title text-primary">Visi & Misi {{ $desa->nama_desa ?? '' }}</h2>
                    <div class="visi mt-4">
                        <h3 class="text-dark">Visi</h3>
                        <p class="text-muted">
                            "Mewujudkan Desa {{ $desa->nama_desa ?? '' }} yang maju, mandiri, dan sejahtera berbasis partisipasi masyarakat."
                        </p>
                    </div>
                    <div class="misi mt-4">
                        <h3 class="text-dark">Misi</h3>
                        <ul class="text-muted">
                            <li>Meningkatkan kualitas pelayanan publik.</li>
                            <li>Membangun infrastruktur desa yang berkelanjutan.</li>
                            <li>Mendorong partisipasi aktif masyarakat dalam pembangunan.</li>
                            <li>Meningkatkan kesejahteraan masyarakat melalui program ekonomi kreatif.</li>
                            <li>Menjaga kelestarian lingkungan dan budaya lokal.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@if ($berita->count() > 0)
<section class="mb-5 center-content">
    <div class="row">
        <div class="col-md">
            <div class="header-body text-center mt-5 mb-5">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10 border-bottom pb-4">
                        <h2 class="text-blue display-4 font-weight-bold section-title">Berita Desa</h2>
                        <p class="text-dark lead section-description mt-3">
                            Menyajikan informasi terbaru tentang peristiwa, berita terkini, dan artikel-artikel jurnalistik dari Desa {{ $desa->nama_desa ?? '' }}.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        @foreach ($berita as $item)
            <div class="col-lg-4 col-md-6 mb-3">
                <div class="card animate-up shadow">
                    <a href="{{ route('berita.show', ['berita' => $item, 'slug' => Str::slug($item->judul)]) }}">
                        <div class="card-img" style="background-image: url('{{ $item->gambar ? asset('storage/' . str_replace('public/', '', $item->gambar)) : asset('storage/noimage.jpg') }}');"></div>
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
        @endforeach
    </div>
    @if (App\Berita::count() > 3)
        <div class="text-center">
            <a href="{{ route('berita') }}" class="btn btn-primary">Lebih Banyak Berita</a>
        </div>
    @endif
</section>
@endif

@if ($pemerintahan_desa->count() > 0)
<section class="mb-5 center-content">
<div class="row">
    <div class="col-md">
        <div class="header-body text-center mt-5 mb-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 border-bottom pb-4">
                    <h2 class="text-blue display-4 font-weight-bold section-title">Informasi Pemerintahan Desa</h2>
                    <p class="text-muted lead section-description mt-3">
                        Informasi Pemerintahan {{ $desa->nama_desa ?? '' }}, masyarakat dapat dengan mudah mengetahui informasi seputar pemerintahan {{ $desa->nama_desa ?? '' }}.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="row justify-content-center">
        @foreach ($pemerintahan_desa as $item)
            <div class="col-lg-4 col-md-6 mb-3">
                <div class="card animate-up shadow">
                    <a href="{{ route('pemerintahan-desa.show', ['pemerintahan_desa' => $item, 'slug' => Str::slug($item->judul)]) }}">
                        <div class="card-img" style="background-image: url('{{ $item->gambar ? asset('storage/' . str_replace('public/', '', $item->gambar)) : asset('storage/noimage.jpg') }}');"></div>
                    </a>
                    <div class="card-body text-center">
                        <a href="{{ route('pemerintahan-desa.show', ['pemerintahan_desa' => $item, 'slug' => Str::slug($item->judul)]) }}">
                            <h3>{{ $item->judul }}</h3>
                            <div class="mt-3 d-flex justify-content-between text-sm text-muted">
                                <i class="fas fa-clock"> {{ $item->created_at->diffForHumans() }}</i>
                                <i class="fas fa-eye"> {{ $item->dilihat }} Kali Dibaca</i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @if (App\PemerintahanDesa::count() > 3)
        <div class="text-center">
            <a href="{{ route('pemerintahan-desa') }}" class="btn btn-primary">Lebih Banyak Informasi Pemerintahan Desa</a>
        </div>
    @endif
</section>
@endif

@if (count($galleries) > 0)
<section class="mb-5 center-content">
    <div class="row">
        <div class="col-md">
            <div class="header-body text-center mt-5 mb-5">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10 border-bottom pb-4">
                        <h2 class="text-blue display-4 font-weight-bold section-title">GALLERY</h2>
                        <p class="text-muted lead section-description mt-3">
                            Gallery Desa {{ $desa->nama_desa ?? '' }}, masyarakat dapat dengan mudah mengetahui gallery {{ $desa->nama_desa ?? '' }}.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        @foreach ($galleries as $key => $item)
            @if ($key < 6)
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="card animate-up shadow">
                        <div class="card-img">
                            @if ($item['jenis'] == 1)
                                <a href="{{ asset('storage/' . str_replace('public/', '', $item['gambar'])) }}" data-fancybox data-caption="{{ $item['caption'] }}">
                                    <img src="{{ asset('storage/' . str_replace('public/', '', $item['gambar'])) }}" alt="{{ $item['caption'] }}" class="img-fluid">
                                </a>
                            @else
                                <a href="https://www.youtube.com/watch?v={{ $item['id'] }}" data-fancybox data-caption="{{ $item['caption'] }}">
                                    <i class="fas fa-play"></i>
                                    <img src="{{ $item['gambar'] }}" alt="{{ $item['caption'] }}" class="img-fluid">
                                </a>
                            @endif
                        </div>
                        <div class="card-body text-center">
                            <p class="text-muted">{{ $item['caption'] }}</p>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    @if (count($galleries) > 6)
        <div class="text-center">
            <a href="{{ route('gallery') }}" class="btn btn-primary">Lebih Banyak Gallery</a>
        </div>
    @endif
</section>
@endif

<div class="row">
    <div class="col-md">
        <div class="header-body text-center mt-5 mb-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 border-bottom pb-4">
                    <h2 class="text-blue display-4 font-weight-bold section-title">PETA</h2>
                    <p class="text-muted lead section-description mt-3">
                        Peta {{ $desa->nama_desa ?? '' }}, masyarakat dapat dengan mudah mengetahui Peta {{ $desa->nama_desa ?? '' }}.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d2564.5310130122352!2d112.63594488138956!3d-7.191941618578181!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sid!2sid!4v1737817491593!5m2!1sid!2sid" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/jquery.fancybox.js') }}"></script>
<script src="{{ asset('js/apbdes.js') }}"></script>
<script>
$(document).ready(function () {
    $('#owl-one').owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: false,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        smartSpeed: 1000,
        dots: false,
        nav: false,
        responsive: {
            0: { items: 1 },
            600: { items: 1 },
            1000: { items: 1 }
        }
    });
});
</script>
@endpush