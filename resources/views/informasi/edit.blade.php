@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Informasi</h2>
    <form action="{{ route('informasi.update', $informasi->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="form-group">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ $informasi->judul }}" required>
        </div>
        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required>{{ $informasi->deskripsi }}</textarea>
        </div>
        <div class="form-group">
            <label>Gambar</label>
            <input type="file" name="gambar" class="form-control">
            @if($informasi->gambar)
                <img src="{{ asset('storage/' . $informasi->gambar) }}" width="150">
            @endif
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
