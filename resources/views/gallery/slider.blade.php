@extends('layouts.app')

@section('title', 'Slider')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/jquery.fancybox.css') }}">
<style>
    .upload-image:hover {
        cursor: pointer;
        opacity: 0.7;
    }
    .img-scale-up {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .img-scale-up:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }
    .btn-primary {
        background: linear-gradient(45deg, #007bff, #0056b3);
        border: none;
        transition: background 0.3s ease;
    }
    .btn-primary:hover {
        background: linear-gradient(45deg, #0056b3, #007bff);
    }
    .btn-danger {
        background: linear-gradient(45deg, #dc3545, #c82333);
        border: none;
        transition: background 0.3s ease;
    }
    .btn-danger:hover {
        background: linear-gradient(45deg, #c82333, #dc3545);
    }
    .modal-content {
        border-radius: 10px;
        border: none;
    }
    .modal-header {
        border-bottom: none;
    }
    .modal-footer {
        border-top: none;
    }
</style>
@endsection

@section('content-header')
<div class="header pb-8 pt-5 pt-md-8" style="background: linear-gradient(87deg, #1f3a93, #4a90e2);">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Kelola Slider</h6>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <a href="#tambah-gambar" data-toggle="modal" class="btn btn-neutral text-primary font-weight-bold">
                        <i class="fas fa-plus mr-1"></i> Tambah Gambar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
@include('layouts.components.alert')
<div class="row mt-4 justify-content-center">
    @forelse ($gallery as $item)
        <div class="col-lg-4 col-md-6 mb-3 img-scale-up">
            <a href="{{ url(Storage::url($item->gallery)) }}" data-caption="{{ $item->caption }}" data-fancybox>
                <img class="mw-100 rounded shadow" src="{{ url(Storage::url($item->gallery)) }}" alt="Slider Image">
            </a>
            <a href="#modal-hapus" data-toggle="modal" data-action="{{ route('gallery.destroy', $item) }}" class="mb-0 btn btn-sm btn-danger hapus-data" style="position: absolute; top: 10px; left: 25px; z-index: 1;">
                <i class="fas fa-trash" title="Hapus" data-toggle="tooltip"></i>
            </a>
        </div>
    @empty
        <div class="col-12 text-center">
            <div class="card bg-white rounded shadow p-5">
                <h4>Data slider belum tersedia</h4>
            </div>
        </div>
    @endforelse
</div>

<!-- Modal Tambah Gambar -->
<div class="modal fade" id="tambah-gambar" tabindex="-1" role="dialog" aria-labelledby="tambah-gambar" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-delete">Tambah Gambar Slider</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="slider" value="1">
                    <div class="form-group">
                        <label class="form-control-label d-block">Pilih Gambar</label>
                        <div class="text-center">
                            <!-- Preview Image / Placeholder -->
                            <img onclick="$(this).siblings('.images').click()" class="mw-100 upload-image mb-3 rounded" style="max-height: 250px; border: 2px dashed #ddd; padding: 5px; cursor: pointer;" src="{{ asset('storage/upload.jpg') }}" onerror="this.src='https://via.placeholder.com/400x200?text=Klik+Di+Sini+Untuk+Upload+Gambar'" alt="Upload Image">
                            
                            <!-- Input File (Hidden) -->
                            <input accept="image/*" onchange="uploadImage(this)" type="file" name="gambar" class="images" style="display: none">
                            
                            <br>
                            <!-- Tombol manual jika area gambar tidak diklik -->
                            <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="$(this).siblings('.images').click()">
                                <i class="fas fa-upload mr-1"></i> Pilih File Gambar
                            </button>
                            
                            <span class="invalid-feedback font-weight-bold d-block mt-2"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Caption / Keterangan</label>
                        <textarea class="form-control" name="caption" rows="3" placeholder="Masukkan keterangan gambar (opsional)..."></textarea>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Gambar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus Gambar -->
<div class="modal fade" id="modal-hapus" tabindex="-1" role="dialog" aria-labelledby="modal-hapus" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered" role="document">
        <div class="modal-content bg-gradient-danger">

            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-delete">Konfirmasi Hapus</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="py-3 text-center">
                    <i class="ni ni-bell-55 ni-3x"></i>
                    <h4 class="heading mt-4 text-white">Perhatian!!</h4>
                    <p class="text-white">Apakah Anda yakin ingin menghapus gambar ini?</p>
                </div>
            </div>

            <div class="modal-footer">
                <form id="form-hapus" action="" method="POST">
                    @csrf 
                    @method('delete')
                    <button type="submit" class="btn btn-white">Yakin</button>
                </form>
                <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Batal</button>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/jquery.fancybox.js') }}"></script>
<script>
    function uploadImage (inputFile) {
        if (inputFile.files && inputFile.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(inputFile).siblings('img').attr("src", e.target.result);
            }
            reader.readAsDataURL(inputFile.files[0]);
        }
    }

    $(document).ready(function() {
        $('.hapus-data').click(function() {
            var action = $(this).data('action');
            $('#form-hapus').attr('action', action);
        });
    });
</script>
@endpush