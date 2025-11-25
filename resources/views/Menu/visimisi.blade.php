@extends('Layout.app')
@section('content')
    <div class="bg-white border-b mt-4 border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
            <p class="text-sm text-gray-500">
                <a href="#" class="hover:text-primary">Beranda</a>
                <span class="mx-2 text-secondary">/</span>
                <span class="font-semibold text-gray-800">Visi Misi</span>
            </p>
        </div>
    </div>
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 pt-4">

        <!-- Header Title -->
        <div class="text-center mb-12 fade-in-up">
            <!-- Badge menggunakan Third color bg dan Primary dark text -->
            <span class="text-primary-dark font-semibold tracking-wider text-xs uppercase bg-third px-3 py-1 rounded-full">Profil Sekolah</span>
            <h1 class="text-3xl md:text-4xl font-bold text-slate-900 mt-4 mb-2">Visi & Misi</h1>
            <p class="text-slate-500 max-w-xl mx-auto">Landasan kami dalam mendidik generasi penerus bangsa.</p>
        </div>

        <!-- VISI SECTION (Card Besar) -->
        <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden mb-12 fade-in-up delay-100 relative">
            <div class="absolute top-0 left-0 w-2 h-full bg-primary"></div> <!-- Accent Line Primary -->
            <div class="p-8 md:p-10">
                <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
                    <div class="flex-shrink-0">
                        <!-- Icon Background menggunakan Third color, Icon Text Primary -->
                        <div class="w-16 h-16 bg-third rounded-full flex items-center justify-center text-primary text-3xl">
                            <i class="ph-fill ph-target"></i>
                        </div>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900 mb-3">Visi Sekolah</h2>
                        <blockquote class="text-lg md:text-xl text-slate-700 leading-relaxed font-medium italic border-l-4 border-secondary pl-4 md:border-none md:pl-0">
                            "Mewujudkan SD Negeri JuwetKenongo sebagai lembaga pendidikan yang unggul dalam prestasi akademik dan karakter, serta berkontribusi positif terhadap masyarakat."
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>

        <!-- MISI SECTION (Modern List Style) -->
        <div class="fade-in-up delay-200">
            <div class="flex items-center gap-3 mb-6">
                <h2 class="text-2xl font-bold text-slate-900">Misi Sekolah</h2>
                <div class="h-px flex-grow bg-slate-200"></div>
            </div>

            <!-- The List Container -->
            <div class="space-y-4">

                <!-- List Item 1 -->
                <div class="group flex items-start gap-4 bg-white p-5 rounded-xl border border-slate-200 shadow-sm hover:shadow-md hover:border-secondary transition-all duration-300 hover:-translate-y-1">
                    <!-- Nomor menggunakan bg-third secara default agar tidak terlalu pucat -->
                    <div class="flex-shrink-0 w-10 h-10 bg-third text-primary-dark rounded-full flex items-center justify-center font-bold text-lg group-hover:bg-primary group-hover:text-white transition-colors">
                        1
                    </div>
                    <div class="pt-1">
                        <p class="text-slate-700 leading-relaxed group-hover:text-slate-900">Menyelenggarakan proses pembelajaran yang inovatif, kreatif, dan menyenangkan untuk meningkatkan prestasi akademik siswa.</p>
                    </div>
                </div>

                <!-- List Item 2 -->
                <div class="group flex items-start gap-4 bg-white p-5 rounded-xl border border-slate-200 shadow-sm hover:shadow-md hover:border-secondary transition-all duration-300 hover:-translate-y-1">
                    <div class="flex-shrink-0 w-10 h-10 bg-third text-primary-dark rounded-full flex items-center justify-center font-bold text-lg group-hover:bg-primary group-hover:text-white transition-colors">
                        2
                    </div>
                    <div class="pt-1">
                        <p class="text-slate-700 leading-relaxed group-hover:text-slate-900">Mengembangkan karakter siswa melalui program pendidikan karakter yang terintegrasi dalam kurikulum.</p>
                    </div>
                </div>

                <!-- List Item 3 -->
                <div class="group flex items-start gap-4 bg-white p-5 rounded-xl border border-slate-200 shadow-sm hover:shadow-md hover:border-secondary transition-all duration-300 hover:-translate-y-1">
                    <div class="flex-shrink-0 w-10 h-10 bg-third text-primary-dark rounded-full flex items-center justify-center font-bold text-lg group-hover:bg-primary group-hover:text-white transition-colors">
                        3
                    </div>
                    <div class="pt-1">
                        <p class="text-slate-700 leading-relaxed group-hover:text-slate-900">Mendorong partisipasi aktif siswa dalam kegiatan ekstrakurikuler untuk mengembangkan bakat dan minat mereka.</p>
                    </div>
                </div>

                <!-- List Item 4 -->
                <div class="group flex items-start gap-4 bg-white p-5 rounded-xl border border-slate-200 shadow-sm hover:shadow-md hover:border-secondary transition-all duration-300 hover:-translate-y-1">
                    <div class="flex-shrink-0 w-10 h-10 bg-third text-primary-dark rounded-full flex items-center justify-center font-bold text-lg group-hover:bg-primary group-hover:text-white transition-colors">
                        4
                    </div>
                    <div class="pt-1">
                        <p class="text-slate-700 leading-relaxed group-hover:text-slate-900">Membangun kemitraan yang erat dengan orang tua, masyarakat, dan pihak terkait untuk mendukung perkembangan pendidikan di sekolah.</p>
                    </div>
                </div>

                <!-- List Item 5 -->
                <div class="group flex items-start gap-4 bg-white p-5 rounded-xl border border-slate-200 shadow-sm hover:shadow-md hover:border-secondary transition-all duration-300 hover:-translate-y-1">
                    <div class="flex-shrink-0 w-10 h-10 bg-third text-primary-dark rounded-full flex items-center justify-center font-bold text-lg group-hover:bg-primary group-hover:text-white transition-colors">
                        5
                    </div>
                    <div class="pt-1">
                        <p class="text-slate-700 leading-relaxed group-hover:text-slate-900">Meningkatkan kompetensi guru dan staf melalui pelatihan dan pengembangan profesional secara berkelanjutan.</p>
                    </div>
                </div>

                <!-- List Item 6 -->
                <div class="group flex items-start gap-4 bg-white p-5 rounded-xl border border-slate-200 shadow-sm hover:shadow-md hover:border-secondary transition-all duration-300 hover:-translate-y-1">
                    <div class="flex-shrink-0 w-10 h-10 bg-third text-primary-dark rounded-full flex items-center justify-center font-bold text-lg group-hover:bg-primary group-hover:text-white transition-colors">
                        6
                    </div>
                    <div class="pt-1">
                        <p class="text-slate-700 leading-relaxed group-hover:text-slate-900">Menciptakan lingkungan sekolah yang aman, nyaman, dan kondusif bagi proses belajar mengajar.</p>
                    </div>
                </div>

                <!-- List Item 7 -->
                <div class="group flex items-start gap-4 bg-white p-5 rounded-xl border border-slate-200 shadow-sm hover:shadow-md hover:border-secondary transition-all duration-300 hover:-translate-y-1">
                    <div class="flex-shrink-0 w-10 h-10 bg-third text-primary-dark rounded-full flex items-center justify-center font-bold text-lg group-hover:bg-primary group-hover:text-white transition-colors">
                        7
                    </div>
                    <div class="pt-1">
                        <p class="text-slate-700 leading-relaxed group-hover:text-slate-900">Memanfaatkan teknologi informasi dalam proses pembelajaran untuk meningkatkan efektivitas dan efisiensi.</p>
                    </div>
                </div>

                <!-- List Item 8 -->
                <div class="group flex items-start gap-4 bg-white p-5 rounded-xl border border-slate-200 shadow-sm hover:shadow-md hover:border-secondary transition-all duration-300 hover:-translate-y-1">
                    <div class="flex-shrink-0 w-10 h-10 bg-third text-primary-dark rounded-full flex items-center justify-center font-bold text-lg group-hover:bg-primary group-hover:text-white transition-colors">
                        8
                    </div>
                    <div class="pt-1">
                        <p class="text-slate-700 leading-relaxed group-hover:text-slate-900">Mengembangkan program-program sosial yang memberikan kontribusi positif terhadap masyarakat sekitar sekolah.</p>
                    </div>
                </div>

                <!-- List Item 9 -->
                <div class="group flex items-start gap-4 bg-white p-5 rounded-xl border border-slate-200 shadow-sm hover:shadow-md hover:border-secondary transition-all duration-300 hover:-translate-y-1">
                    <div class="flex-shrink-0 w-10 h-10 bg-third text-primary-dark rounded-full flex items-center justify-center font-bold text-lg group-hover:bg-primary group-hover:text-white transition-colors">
                        9
                    </div>
                    <div class="pt-1">
                        <p class="text-slate-700 leading-relaxed group-hover:text-slate-900">Mengupayakan pengelolaan sekolah yang transparan, akuntabel, dan berorientasi pada kualitas.</p>
                    </div>
                </div>

            </div>
        </div>
    </main>
    <div class="">
        @include('Homepage.footer')
    </div>
@endsection

@push('styles')
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        .fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
            opacity: 0;
            transform: translateY(20px);
        }
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
    </style>
@endpush
