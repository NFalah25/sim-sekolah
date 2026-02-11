@extends('app.Template')

@section('title', 'Dashboard')

@section('content')
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <!-- Card 1 -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="dashboard-card bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-start">
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <rect width="20" height="8" x="2" y="4" rx="1" />
                            <path d="M4 12v7a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-7" />
                            <path d="M10 18h4" />
                        </svg>
                        <span class="card-value">{{$fasilitas}}</span>
                    </div>
                    <div class="mt-3">
                        <p class="card-title">Fasilitas Utama</p>
                        <p class="card-subtitle">Total kategori inventaris</p>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="dashboard-card text-white" style="background-color: #ec4899;">
                    <div class="d-flex justify-content-between align-items-start">
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 2H9a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2z" />
                            <path d="M10 9h4" />
                            <path d="M10 13h4" />
                            <path d="M10 17h4" />
                        </svg>
                        <span class="card-value">{{$berita}}</span>
                    </div>
                    <div class="mt-3">
                        <p class="card-title">Berita Aktif</p>
                        <p class="card-subtitle">Postingan terbaru bulan ini</p>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="dashboard-card text-white" style="background-color: #f97316;">
                    <div class="d-flex justify-content-between align-items-start">
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 21v-4a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2v4" />
                            <path d="M17 17a3 3 0 0 0 0-6H7a3 3 0 0 0 0 6" />
                            <path d="M18 10h1.5a2.5 2.5 0 0 0 0-5H18" />
                            <path d="M6 10H4.5a2.5 2.5 0 0 1 0-5H6" />
                            <path d="M12 2v3" />
                        </svg>
                        <span class="card-value">{{$agenda}}</span>
                    </div>
                    <div class="mt-3">
                        <p class="card-title">Kegiatan Mendatang</p>
                        <p class="card-subtitle">Agenda terjadwal</p>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="dashboard-card text-white" style="background-color: #10b981;">
                    <div class="d-flex justify-content-between align-items-start">
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 8c0 4.5-6 9-6 9s-6-4.5-6-9a6 6 0 0 1 12 0z" />
                            <circle cx="12" cy="8" r="3" />
                            <path d="M22 10s-2 3-2 5a2 2 0 0 1-2 2h-1" />
                            <path d="M2 10s2 3 2 5a2 2 0 0 0 2 2h1" />
                        </svg>
                        <span class="card-value">{{$prestasi}}</span>
                    </div>
                    <div class="mt-3">
                        <p class="card-title">Total Prestasi</p>
                        <p class="card-subtitle">Capaian tahun berjalan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .dashboard-card {
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .dashboard-card:hover {
            transform: scale(1.03);
            box-shadow: 0 1rem 1.5rem rgba(0, 0, 0, 0.15);
        }

        .dashboard-card .icon {
            width: 2.5rem;
            height: 2.5rem;
            opacity: 0.75;
        }

        .dashboard-card .card-value {
            font-size: 2.5rem;
            font-weight: 800;
            line-height: 1;
        }

        .dashboard-card .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            opacity: 0.9;
            margin-bottom: 0.25rem;
        }

        .dashboard-card .card-subtitle {
            font-size: 0.9rem;
            opacity: 0.85;
        }

        @media (max-width: 767.98px) {
            .dashboard-card {
                padding: 1rem;
            }

            .dashboard-card .card-value {
                font-size: 2rem;
            }
        }
    </style>
@endsection
