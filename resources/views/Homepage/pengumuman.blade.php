<style>
    .announcement-item {
        transition: transform 0.2s ease, color 0.2s ease;
    }

    .announcement-item:hover {
        transform: translateX(5px);
    }

    .agenda-card {
        transition: all 0.3s ease;
    }

    .agenda-card:hover {
        background-color: white;
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px -1px rgba(51, 150, 211, 0.1), 0 2px 4px -1px rgba(51, 150, 211, 0.06);
        padding-left: 1rem;
        padding-right: 1rem;
        margin-left: -1rem;
        margin-right: -1rem;
    }
</style>
<section class="py-16 bg-primary-light overflow-hidden" id="pengumuman">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" >

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

            <!-- KOLOM KIRI: PENGUMUMAN (7 Kolom) -->
            <div class="lg:col-span-7">
                <!-- Header Pengumuman -->
                <div class="flex items-center justify-between mb-8 border-b border-primary/20 pb-4">
                    <div>
                        <div class="w-16 h-1 bg-primary mb-2"></div>
                        <h2 class="text-2xl md:text-3xl font-extrabold text-slate-800 tracking-tight uppercase">
                            Pengumuman
                        </h2>
                    </div>
                    <!-- Tombol Navigasi Kecil -->
                    <a href="{{route('landing.pengumuman')}}"
                        class="p-2 rounded-lg border border-primary/30 text-primary hover:bg-primary hover:text-white transition-colors">
                        <i data-lucide="chevron-right" class="w-5 h-5"></i>
                    </a>
                </div>

                <!-- Grid Item Pengumuman -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-8">

                    <!-- Item 1 -->

                    @forelse($announcements as $data)
                        <div class="announcement-item group cursor-pointer">
                            <div class="flex items-start gap-3">
                                <div
                                    class="mt-1.5 w-3 h-3 rounded-full bg-primary flex-shrink-0 ring-4 ring-primary/20 group-hover:bg-secondary transition-colors">
                                </div>
                                <div>
                                    <span
                                        class="text-primary font-bold text-sm block mb-1">{{ \Carbon\Carbon::parse($data->date_published)->format('d F Y') }}</span>
                                    <h3
                                        class="text-lg font-bold text-slate-800 leading-snug group-hover:text-primary-dark transition-colors">
                                        {{ $data->title }}
                                    </h3>
                                    <p class="text-slate-500 text-sm mt-1 line-clamp-2">{{ $data->description }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>Tidak ada pengumuman.</p>
                    @endforelse

                </div>
            </div>

            <!-- KOLOM KANAN: AGENDA (5 Kolom) -->
            <div class="lg:col-span-5 lg:border-l lg:border-primary/10 lg:pl-12">
                <!-- Header Agenda -->
                <div class="flex items-center justify-between mb-8 border-b border-primary/20 pb-4">
                    <div>
                        <div class="w-16 h-1 bg-secondary mb-2"></div>
                        <h2 class="text-2xl md:text-3xl font-extrabold text-slate-800 tracking-tight uppercase">
                            Agenda
                        </h2>
                    </div>
                    <!-- GANTI DARI ICON CALENDAR KE CHEVRON (Lihat Semua) -->
                    <!-- Menambahkan title tooltip dan link ke halaman arsip -->
                    <a href="{{route('landing.pengumuman')}}" title="Lihat Semua Agenda"
                        class="p-2 rounded-lg border border-primary/30 text-primary hover:bg-primary hover:text-white transition-colors">
                        <i data-lucide="chevron-right" class="w-5 h-5"></i>
                    </a>
                </div>

                <!-- List Agenda Items -->
                <div class="space-y-6">

                    @forelse ($events as $event)
                        <div class="agenda-card flex gap-4 items-start cursor-pointer group">
                            <div
                                class="bg-darkbox text-white rounded-lg w-16 h-16 flex flex-col items-center justify-center flex-shrink-0 shadow-lg group-hover:bg-primary transition-colors duration-300">
                                <span class="text-[10px] uppercase font-bold tracking-wider text-secondary">{{\Carbon\Carbon::parse($event->date)->format('M')}}</span>
                                <span class="text-2xl font-bold leading-none">{{\Carbon\Carbon::parse($event->date)->format('d')}}</span>
                            </div>
                            <div>
                                <h3
                                    class="text-base font-bold text-slate-800 leading-snug group-hover:text-primary transition-colors">
                                    {{ $event->title }}
                                </h3>
                                <div class="flex items-center gap-2 mt-1">
                                    <i data-lucide="clock" class="w-3 h-3 text-slate-400"></i>
                                    @if (!$event->end_time)
                                    <span class="text-xs text-slate-500">{{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} - Selesai</span>
                                    @else
                                    <span class="text-xs text-slate-500">{{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse

                    <!-- Agenda 1 -->
                    {{-- <div class="agenda-card flex gap-4 items-start cursor-pointer group">
                        <!-- Date Box -->
                        <div
                            class="bg-darkbox text-white rounded-lg w-16 h-16 flex flex-col items-center justify-center flex-shrink-0 shadow-lg group-hover:bg-primary transition-colors duration-300">
                            <span class="text-[10px] uppercase font-bold tracking-wider text-secondary">Des</span>
                            <span class="text-2xl font-bold leading-none">17</span>
                        </div>
                        <!-- Content -->
                        <div>
                            <h3
                                class="text-base font-bold text-slate-800 leading-snug group-hover:text-primary transition-colors">
                                Informasi Pembukaan Seleksi Nasional Berdasarkan Prestasi Tahun 2025
                            </h3>
                            <div class="flex items-center gap-2 mt-1">
                                <i data-lucide="clock" class="w-3 h-3 text-slate-400"></i>
                                <span class="text-xs text-slate-500">08:00 - Selesai</span>
                            </div>
                        </div>
                    </div>

                    <!-- Agenda 2 -->
                    <div class="agenda-card flex gap-4 items-center cursor-pointer group">
                        <div
                            class="bg-darkbox text-white rounded-lg w-16 h-16 flex flex-col items-center justify-center flex-shrink-0 shadow-lg group-hover:bg-primary transition-colors duration-300">
                            <span class="text-[10px] uppercase font-bold tracking-wider text-secondary">Jan</span>
                            <span class="text-2xl font-bold leading-none">10</span>
                        </div>
                        <div>
                            <h3
                                class="text-base font-bold text-slate-800 leading-snug group-hover:text-primary transition-colors">
                                Layanan Konsultasi Karir & Psikologi Anak
                            </h3>
                            <div class="flex items-center gap-2 mt-1">
                                <i data-lucide="map-pin" class="w-3 h-3 text-slate-400"></i>
                                <span class="text-xs text-slate-500">Aula Sekolah</span>
                            </div>
                        </div>
                    </div>

                    <!-- Agenda 3 -->
                    <div class="agenda-card flex gap-4 items-start cursor-pointer group">
                        <div
                            class="bg-darkbox text-white rounded-lg w-16 h-16 flex flex-col items-center justify-center flex-shrink-0 shadow-lg group-hover:bg-primary transition-colors duration-300">
                            <span class="text-[10px] uppercase font-bold tracking-wider text-secondary">Jan</span>
                            <span class="text-2xl font-bold leading-none">01</span>
                        </div>
                        <div>
                            <h3
                                class="text-base font-bold text-slate-800 leading-snug group-hover:text-primary transition-colors">
                                Perubahan terbaru Jalur Masuk Sekolah Menengah Pertama (SMP)
                            </h3>
                            <div class="flex items-center gap-2 mt-1">
                                <i data-lucide="info" class="w-3 h-3 text-slate-400"></i>
                                <span class="text-xs text-slate-500">Daring (Zoom)</span>
                            </div>
                        </div>
                    </div> --}}

                </div>
            </div>

        </div>
    </div>
</section>
