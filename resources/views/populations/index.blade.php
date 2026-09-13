@extends('layouts.app')

@section('title', 'Data Penduduk')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
<style>
    .table-responsive {
        overflow-x: auto;
    }
    .btn-action {
        margin: 2px;
        padding: 5px 10px;
        font-size: 14px;
    }
    .card-header {
        background: white;
        color: white;
    }
    .table thead th {
        background-color: #f8f9fa;
    }
    .btn-gradient-blue {
        background: linear-gradient(87deg, #1f3a93, #4a90e2);
        color: white;
        border: none;
    }
    .btn-gradient-blue:hover {
        background: linear-gradient(87deg, #1a327d, #3a7dcc);
        color: white;
    }
    .btn-primary {
        background: linear-gradient(45deg, #007bff, #0056b3);
        border: none;
        transition: background 0.3s ease;
    }
    .btn-primary:hover {
        background: linear-gradient(45deg, #0056b3, #007bff);
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
                                <h2 class="mb-0">Data Penduduk</h2>
                                <p class="mb-0 text-sm">Kelola Data Penduduk</p>
                            </div>
                            @if($populations->isEmpty())
                            <div class="mb-3">
                                <a href="{{ route('populations.create') }}" class="btn btn-primary" title="Tambah Data">
                                    <i class="bi bi-plus-circle"></i> Tambah Data
                                </a>
                            </div>
                            @endif
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
                <h3 class="mb-0">Daftar Data Penduduk</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Laki-laki</th>
                                <th>Perempuan</th>
                                <th>Kematian</th>
                                <th>Kelahiran</th>
                                <th>Islam</th>
                                <th>Kristen</th>
                                <th>Katolik</th>
                                <th>Hindu</th>
                                <th>Buddha</th>
                                <th>Konghucu</th>
                                <th>Bekerja</th>
                                <th>Tidak Bekerja</th>
                                <th>Ibu Rumah Tangga</th>
                                <th>Pelajar</th>
                                <th>Transmisi Masuk</th>
                                <th>Transmisi Keluar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($populations as $population)
                            <tr>
                                <td>{{ $population->male }}</td>
                                <td>{{ $population->female }}</td>
                                <td>{{ $population->deaths }}</td>
                                <td>{{ $population->births }}</td>
                                <td>{{ $population->islam }}</td>
                                <td>{{ $population->christian }}</td>
                                <td>{{ $population->catholic }}</td>
                                <td>{{ $population->hindu }}</td>
                                <td>{{ $population->buddha }}</td>
                                <td>{{ $population->confucianism }}</td>
                                <td>{{ $population->employed }}</td>
                                <td>{{ $population->unemployed }}</td>
                                <td>{{ $population->housewife }}</td>
                                <td>{{ $population->student }}</td>
                                <td>{{ $population->migration_in }}</td>
                                <td>{{ $population->migration_out }}</td>
                                <td>
                                    <a href="{{ route('populations.edit', $population) }}" class="btn btn-warning btn-action" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('populations.destroy', $population) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-action" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="17" class="text-center">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection