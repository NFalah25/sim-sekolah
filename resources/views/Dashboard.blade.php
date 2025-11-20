@extends('Layout.layout')
@section('title', 'Dashboard')

@section('content')
    <main class="md:w-[calc(100vw-18rem)] w-full mt-16 md:ms-72 pt-4 md:min-h-[calc(100vh-4rem)] md:p-8 bg-gray-100">
        <div class="p-4 bg-white rounded-lg mb-6">
            <h2 class="md:text-2xl font-bold text-gray-800 text-lg">Ringkasan Data Sekolah</h2>
            <p class="text-sm text-black/80">Dashboard ini memberikan gambaran umum tentang data sekolah.</p>
        </div>

        <!-- 3. CARDS RINGKASAN DATA (1 Baris Isi 4) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- Card 1: Fasilitas (Biru Muda) -->
            <!-- Menggunakan card-fasilitas untuk membedakan dengan warna primary -->
            <div
                class="bg-[#3b82f6] text-white md:p-6 p-4 rounded-xl shadow-lg hover:shadow-xl transition duration-300 cursor-pointer transform hover:scale-[1.01]">
                <div class="flex justify-between items-start">
                    <!-- Ikon -->
                    <svg class="md:w-10 md:h-10 h-8 w-8 opacity-75" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <rect width="20" height="8" x="2" y="4" rx="1" />
                        <path d="M4 12v7a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-7" />
                        <path d="M10 18h4" />
                    </svg>
                    <span class="md:text-5xl text-3xl font-extrabold leading-none">4</span>
                </div>
                <div class="mt-4">
                    <p class="md:text-lg text-base text-base font-semibold opacity-90">Fasilitas Utama</p>
                    <p class="text-sm opacity-80">Total kategori inventaris</p>
                </div>
            </div>

            <!-- Card 2: Berita (Pink) -->
            <div
                class="bg-[#ec4899] text-white md:p-6 p-4 rounded-xl shadow-lg hover:shadow-xl transition duration-300 cursor-pointer transform hover:scale-[1.01]">
                <div class="flex justify-between items-start">
                    <!-- Ikon -->
                    <svg class="md:w-10 md:h-10 h-8 w-8 opacity-75" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 2H9a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2z" />
                        <path d="M10 9h4" />
                        <path d="M10 13h4" />
                        <path d="M10 17h4" />
                    </svg>
                    <span class="md:text-5xl text-3xl font-extrabold leading-none">10</span>
                </div>
                <div class="mt-4">
                    <p class="md:text-lg text-base font-semibold opacity-90">Berita Aktif</p>
                    <p class="text-sm opacity-80">Postingan terbaru bulan ini</p>
                </div>
            </div>

            <!-- Card 3: Kegiatan (Oranye) -->
            <div
                class="bg-[#f97316] text-white md:p-6 p-4 rounded-xl shadow-lg hover:shadow-xl transition duration-300 cursor-pointer transform hover:scale-[1.01]">
                <div class="flex justify-between items-start">
                    <!-- Ikon -->
                    <svg class="md:w-10 md:h-10 h-8 w-8 opacity-75" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 21v-4a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2v4" />
                        <path d="M17 17a3 3 0 0 0 0-6H7a3 3 0 0 0 0 6" />
                        <path d="M18 10h1.5a2.5 2.5 0 0 0 0-5H18" />
                        <path d="M6 10H4.5a2.5 2.5 0 0 1 0-5H6" />
                        <path d="M12 2v3" />
                    </svg>
                    <span class="md:text-5xl text-3xl font-extrabold leading-none">7</span>
                </div>
                <div class="mt-4">
                    <p class="md:text-lg text-base font-semibold opacity-90">Kegiatan Mendatang</p>
                    <p class="text-sm opacity-80">Agenda terjadwal</p>
                </div>
            </div>

            <!-- Card 4: Prestasi (Hijau) -->
            <div
                class="bg-[#10b981] text-white md:p-6 p-4 rounded-xl shadow-lg hover:shadow-xl transition duration-300 cursor-pointer transform hover:scale-[1.01]">
                <div class="flex justify-between items-start">
                    <!-- Ikon -->
                    <svg class="md:w-10 md:h-10 h-8 w-8 opacity-75" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 8c0 4.5-6 9-6 9s-6-4.5-6-9a6 6 0 0 1 12 0z" />
                        <circle cx="12" cy="8" r="3" />
                        <path d="M22 10s-2 3-2 5a2 2 0 0 1-2 2h-1" />
                        <path d="M2 10s2 3 2 5a2 2 0 0 0 2 2h1" />
                    </svg>
                    <span class="md:text-5xl text-3xl font-extrabold leading-none">12</span>
                </div>
                <div class="mt-4">
                    <p class="md:text-lg text-base font-semibold opacity-90">Total Prestasi</p>
                    <p class="text-sm opacity-80">Capaian tahun berjalan</p>
                </div>
            </div>
        </div>

        <!-- Contoh Bagian Dashboard Lainnya -->
        <!-- Menggunakan warna secondary dan tertiary untuk latar belakang dan highlight -->
        <div class="mt-10 p-6 bg-tertiary rounded-xl shadow-lg border-t-4 border-secondary">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Grafik Tren Akademik (Contoh)</h3>
            <p class="text-gray-700">Area ini bisa diisi dengan visualisasi data seperti chart pertumbuhan siswa atau
                performa nilai per semester.</p>
            <div
                class="h-64 bg-secondary/30 rounded-lg border border-dashed border-gray-400 flex items-center justify-center mt-4">
                <span class="text-gray-600">Placeholder untuk Grafik/Visualisasi Data</span>
            </div>
        </div>

    </main>

@endsection
