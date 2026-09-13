@extends('layouts.layout')

@section('title', 'Detail Data Penduduk')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.css" rel="stylesheet">
<style>
    /* Global Styles */
    body {
        font-family: 'Poppins', sans-serif;
        overflow-x: hidden;
    }

        /* Tambahkan margin untuk konten */
        .content-wrapper {
        margin-top: 100px; /* Sesuaikan dengan tinggi header */
        margin-bottom: 0px; /* Sesuaikan dengan tinggi footer */
    }
    /* Background gradient untuk header */
    header {
        background: linear-gradient(135deg, #1c4e80, #0865FE); /* Gradien biru muda ke biru tua */
        padding: 20px 0; /* Tambahkan padding untuk header */
    }

    /* Animasi hover untuk card */
    .animate-up:hover {
        transform: translateY(-5px);
        transition: transform 0.3s ease;
    }

    /* Margin untuk konten */
    .content-section {
        margin-top: 100px;
        margin-bottom: 40px;
    }

    /* Background gradient untuk header */
    .header-section {
        padding: 80px 0;
        background: linear-gradient(135deg, #1c4e80, #0865FE);
        color: white;
        margin-bottom: 40px;
    }
    .header-section h2 {
        font-size: 1.5rem;
        font-weight: 300;
        margin-bottom: 10px;
    }
    .header-section h1 {
        font-size: 2.5rem;
        font-weight: 600;
    }

    /* Card styling */
    .card {
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s ease, transform 0.3s ease;
        border: none;
        overflow: hidden;
    }
    .card:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        transform: translateY(-5px);
    }
    .card-body {
        padding: 30px;
    }
    .card-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 20px;
        color: #343a40;
        text-align: center;
    }

    /* Section styling */
    .section-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #1f3a93;
        margin: 25px 0 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f0f0f0;
    }

    /* Chart container */
    .chart-container {
        position: relative;
        margin: auto;
        height: 300px;
        margin-bottom: 30px;
    }

    /* Detail item styling */
    .detail-item {
        margin-bottom: 15px;
        font-size: 16px;
        padding: 15px;
        background-color: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .detail-item strong {
        display: inline-block;
        width: 200px;
        color: #1f3a93;
        font-weight: 600;
    }

    /* Grid layout */
    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 15px;
    }

    /* Action buttons */
    .action-buttons {
        margin-top: 30px;
        display: flex;
        justify-content: center;
        gap: 15px;
    }
    .btn-edit {
        background-color: #1f3a93;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    .btn-edit:hover {
        background-color: #172b6d;
        color: white;
        transform: translateY(-2px);
    }
    .btn-back {
        background-color: #6c757d;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    .btn-back:hover {
        background-color: #5a6268;
        color: white;
        transform: translateY(-2px);
    }

    /* Chart section */
    .chart-section {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 30px;
        margin-bottom: 30px;
    }
    .chart-card {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .chart-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1f3a93;
        margin-bottom: 15px;
        text-align: center;
    }
</style>
@endsection

@section('header')
<div class="header-section text-center">
    <h2>DETAIL DATA PENDUDUK</h2>
    <h1>Kelola Data Penduduk</h1>
</div>
@endsection

@section('content')
<div class="content-section">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card animate-up">
                <div class="card-body">
                    <h3 class="card-title">Detail Data Penduduk</h3>
                    
                    <!-- Chart Section -->
                    <div class="chart-section">
                        <!-- Gender Distribution -->
                        <div class="chart-card">
                            <h4 class="chart-title">Distribusi Jenis Kelamin</h4>
                            <div class="chart-container">
                                <canvas id="genderChart"></canvas>
                            </div>
                            <div class="detail-grid">
                                <div class="detail-item">
                                    <strong>Laki-laki:</strong> {{ $population->male }}
                                </div>
                                <div class="detail-item">
                                    <strong>Perempuan:</strong> {{ $population->female }}
                                </div>
                            </div>
                        </div>

                        <!-- Religion Distribution -->
                        <div class="chart-card">
                            <h4 class="chart-title">Distribusi Agama</h4>
                            <div class="chart-container">
                                <canvas id="religionChart"></canvas>
                            </div>
                            <div class="detail-grid">
                                <div class="detail-item">
                                    <strong>Islam:</strong> {{ $population->islam }}
                                </div>
                                <div class="detail-item">
                                    <strong>Kristen:</strong> {{ $population->christian }}
                                </div>
                                <div class="detail-item">
                                    <strong>Katolik:</strong> {{ $population->catholic }}
                                </div>
                                <div class="detail-item">
                                    <strong>Hindu:</strong> {{ $population->hindu }}
                                </div>
                                <div class="detail-item">
                                    <strong>Buddha:</strong> {{ $population->buddha }}
                                </div>
                                <div class="detail-item">
                                    <strong>Konghucu:</strong> {{ $population->confucianism }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="chart-section">
                        <!-- Employment Distribution -->
                        <div class="chart-card">
                            <h4 class="chart-title">Distribusi Pekerjaan</h4>
                            <div class="chart-container">
                                <canvas id="employmentChart"></canvas>
                            </div>
                            <div class="detail-grid">
                                <div class="detail-item">
                                    <strong>Bekerja:</strong> {{ $population->employed }}
                                </div>
                                <div class="detail-item">
                                    <strong>Tidak Bekerja:</strong> {{ $population->unemployed }}
                                </div>
                                <div class="detail-item">
                                    <strong>Ibu Rumah Tangga:</strong> {{ $population->housewife }}
                                </div>
                                <div class="detail-item">
                                    <strong>Pelajar:</strong> {{ $population->student }}
                                </div>
                            </div>
                        </div>

                        <!-- Migration Distribution -->
                        <div class="chart-card">
                            <h4 class="chart-title">Distribusi Transmigrasi</h4>
                            <div class="chart-container">
                                <canvas id="migrationChart"></canvas>
                            </div>
                            <div class="detail-grid">
                                <div class="detail-item">
                                    <strong>Transmisi Masuk:</strong> {{ $population->migration_in }}
                                </div>
                                <div class="detail-item">
                                    <strong>Transmisi Keluar:</strong> {{ $population->migration_out }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Vital Statistics Section -->
                    <h4 class="section-title">Statistik Vital</h4>
                    <div class="detail-grid">
                        <div class="detail-item">
                            <strong>Kematian:</strong> {{ $population->deaths }}
                        </div>
                        <div class="detail-item">
                            <strong>Kelahiran:</strong> {{ $population->births }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gender Distribution Chart
        const genderCtx = document.getElementById('genderChart').getContext('2d');
        const genderChart = new Chart(genderCtx, {
            type: 'pie',
            data: {
                labels: ['Laki-laki', 'Perempuan'],
                datasets: [{
                    data: [{{ $population->male }}, {{ $population->female }}],
                    backgroundColor: ['#1f3a93', '#4a90e2'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Religion Distribution Chart
        const religionCtx = document.getElementById('religionChart').getContext('2d');
        const religionChart = new Chart(religionCtx, {
            type: 'pie',
            data: {
                labels: ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'],
                datasets: [{
                    data: [
                        {{ $population->islam }},
                        {{ $population->christian }},
                        {{ $population->catholic }},
                        {{ $population->hindu }},
                        {{ $population->buddha }},
                        {{ $population->confucianism }}
                    ],
                    backgroundColor: [
                        '#1f3a93',
                        '#4a90e2',
                        '#7cb5ec',
                        '#a5d8ff',
                        '#d0e7ff',
                        '#e6f2ff'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Employment Distribution Chart
        const employmentCtx = document.getElementById('employmentChart').getContext('2d');
        const employmentChart = new Chart(employmentCtx, {
            type: 'pie',
            data: {
                labels: ['Bekerja', 'Tidak Bekerja', 'Ibu Rumah Tangga', 'Pelajar'],
                datasets: [{
                    data: [
                        {{ $population->employed }},
                        {{ $population->unemployed }},
                        {{ $population->housewife }},
                        {{ $population->student }}
                    ],
                    backgroundColor: [
                        '#1f3a93',
                        '#4a90e2',
                        '#7cb5ec',
                        '#a5d8ff'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Migration Distribution Chart
        const migrationCtx = document.getElementById('migrationChart').getContext('2d');
        const migrationChart = new Chart(migrationCtx, {
            type: 'pie',
            data: {
                labels: ['Transmisi Masuk', 'Transmisi Keluar'],
                datasets: [{
                    data: [{{ $population->migration_in }}, {{ $population->migration_out }}],
                    backgroundColor: ['#1f3a93', '#4a90e2'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    });
</script>
@endpush