@extends('layouts.app')

@section('content')
<div class="container mt-8">
    <h2>Edit UMKM</h2>
    <form action="{{ route('umkm.update', $umkm->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nama UMKM</label>
            <input type="text" name="nama" class="form-control" value="{{ $umkm->nama }}" required>
        </div>
        <div class="mb-3">
            <label>Gambar</label>
            <input type="file" name="gambar" class="form-control">
            @if($umkm->gambar)
                <img src="{{ asset('storage/' . $umkm->gambar) }}" width="100">
            @endif
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required>{{ $umkm->deskripsi }}</textarea>
        </div>
        <div class="mb-3">
            <label>Link</label>
            <input type="url" name="link" class="form-control" value="{{ $umkm->link }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection