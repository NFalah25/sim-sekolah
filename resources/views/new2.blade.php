<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita & Artikel - SD Negeri JuwetKenongo</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc; /* Slate 50 */
        }
        .text-highlight {
            color: #2563eb; /* Blue-600 */
        }
        .bg-highlight {
            background-color: #2563eb;
        }

        /* Card Hover Effect */
        .news-card {
            /* Transisi untuk shadow dan transform kartu */
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s ease;
            will-change: transform, box-shadow; /* Optimasi performa render */
        }
        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -6px rgba(0, 0, 0, 0.05);
            z-index: 10;
        }

        /* Image Zoom */
        .img-container {
            overflow: hidden;
        }
        .img-container img {
            transition: transform 0.6s ease;
        }
        .news-card:hover .img-container img {
            transform: scale(1.08);
        }

        /* Title Animation Styles */
        .news-title-wrapper {
            /* Wrapper khusus untuk menghandle animasi height */
            overflow: hidden;
            transition: height 0.4s ease-out; /* Durasi animasi smooth */
            will-change: height;
        }

        .news-title {
            display: -webkit-box;
            -webkit-line-clamp: 3; /* Batas baris awal */
            -webkit-box-orient: vertical;
            overflow: hidden;
            /* Teks itu sendiri tidak perlu transisi height, wrappernya yang kita mainkan */
        }

        /* Utility class untuk unclamp */
        .line-clamp-none {
            -webkit-line-clamp: unset !important;
        }
    </style>
</head>
<body class="text-slate-800 flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-3">
                    <div class="bg-blue-600 text-white p-1.5 rounded-lg">
                        <i data-lucide="book-open" class="h-5 w-5"></i>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-bold text-lg leading-none text-slate-800">SD Negeri <span class="text-highlight">JuwetKenongo</span></span>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8 text-sm font-medium text-slate-500">
                    <a href="#" class="hover:text-blue-600 transition">Beranda</a>
                    <a href="#" class="hover:text-blue-600 transition">Profil</a>
                    <a href="#" class="text-blue-600 font-semibold border-b-2 border-blue-600 pb-0.5">Berita</a>
                    <a href="#" class="hover:text-blue-600 transition">Guru & Staf</a>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="md:hidden text-slate-500 hover:text-blue-600">
                    <i data-lucide="menu" class="h-6 w-6"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Panel -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100 absolute w-full shadow-lg">
            <div class="px-4 pt-2 pb-4 space-y-1">
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-slate-600 hover:bg-blue-50 hover:text-blue-600">Beranda</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-blue-600 bg-blue-50">Berita</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-slate-600 hover:bg-blue-50 hover:text-blue-600">Guru & Staf</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">

        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-slate-900">Arsip Berita</h1>
                <p class="text-slate-500 mt-2">Informasi terkini dan kegiatan sekolah terbaru.</p>
            </div>

            <!-- Search -->
            <div class="relative w-full md:w-64">
                <input type="text" placeholder="Cari berita..." class="w-full pl-10 pr-4 py-2 bg-white border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all">
                <i data-lucide="search" class="absolute left-3 top-2.5 h-4 w-4 text-gray-400"></i>
            </div>
        </div>

        <!-- Grid Berita -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12 items-start">

            <!-- Card 1 -->
            <article class="news-card bg-white rounded-xl border border-gray-100 overflow-hidden flex flex-col h-full cursor-pointer group">
                <div class="img-container relative h-48 bg-gray-200 flex-shrink-0">
                    <img src="https://images.unsplash.com/photo-1541829070764-84a7d30dd3f3?auto=format&fit=crop&q=80&w=600" alt="Thumbnail" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-blue-900/0 group-hover:bg-blue-900/10 transition-colors"></div>
                </div>
                <div class="p-5 flex flex-col flex-grow">
                    <!-- Title Wrapper: Kunci animasi smooth -->
                    <div class="news-title-wrapper">
                        <h2 class="news-title text-base font-bold text-slate-900 leading-snug mb-3 group-hover:text-blue-600 transition-colors">
                            SD Negeri JuwetKenongo Selenggarakan Tes Akademik dan Penilaian Tengah Semester Ganjil Tahun 2024 secara Serentak
                        </h2>
                    </div>
                    <div class="mt-auto flex items-center gap-3 pt-4 border-t border-gray-50">
                        <span class="bg-highlight text-white text-[10px] font-bold px-2 py-1 rounded tracking-wide">Admin</span>
                        <span class="text-xs text-gray-500 font-medium">7 November 2024</span>
                    </div>
                </div>
            </article>

            <!-- Card 2 -->
            <article class="news-card bg-white rounded-xl border border-gray-100 overflow-hidden flex flex-col h-full cursor-pointer group">
                <div class="img-container relative h-48 bg-gray-200 flex-shrink-0">
                    <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&q=80&w=600" alt="Thumbnail" class="w-full h-full object-cover">
                </div>
                <div class="p-5 flex flex-col flex-grow">
                    <div class="news-title-wrapper">
                        <h2 class="news-title text-base font-bold text-slate-900 leading-snug mb-3 group-hover:text-blue-600 transition-colors">
                            Pemeriksaan dan Penyuluhan Kesehatan Fisik dan Jiwa Siswa bekerjasama dengan Puskesmas Setempat
                        </h2>
                    </div>
                    <div class="mt-auto flex items-center gap-3 pt-4 border-t border-gray-50">
                        <span class="bg-highlight text-white text-[10px] font-bold px-2 py-1 rounded tracking-wide">Admin</span>
                        <span class="text-xs text-gray-500 font-medium">21 Oktober 2024</span>
                    </div>
                </div>
            </article>

            <!-- Card 3 -->
            <article class="news-card bg-white rounded-xl border border-gray-100 overflow-hidden flex flex-col h-full cursor-pointer group">
                <div class="img-container relative h-48 bg-gray-200 flex-shrink-0">
                    <img src="https://images.unsplash.com/photo-1560785496-4c97b9275ce5?auto=format&fit=crop&q=80&w=600" alt="Thumbnail" class="w-full h-full object-cover">
                </div>
                <div class="p-5 flex flex-col flex-grow">
                    <div class="news-title-wrapper">
                        <h2 class="news-title text-base font-bold text-slate-900 leading-snug mb-3 group-hover:text-blue-600 transition-colors">
                            Apel Pagi & Serah Terima Jabatan Dokter Kecil (Dokcil) Periode 2024-2025 di Halaman Sekolah
                        </h2>
                    </div>
                    <div class="mt-auto flex items-center gap-3 pt-4 border-t border-gray-50">
                        <span class="bg-highlight text-white text-[10px] font-bold px-2 py-1 rounded tracking-wide">Admin</span>
                        <span class="text-xs text-gray-500 font-medium">15 September 2024</span>
                    </div>
                </div>
            </article>

            <!-- Card 4 -->
            <article class="news-card bg-white rounded-xl border border-gray-100 overflow-hidden flex flex-col h-full cursor-pointer group">
                <div class="img-container relative h-48 bg-gray-200 flex-shrink-0">
                    <img src="https://images.unsplash.com/photo-1564347714493-9c869c9b6348?auto=format&fit=crop&q=80&w=600" alt="Thumbnail" class="w-full h-full object-cover">
                </div>
                <div class="p-5 flex flex-col flex-grow">
                    <div class="news-title-wrapper">
                        <h2 class="news-title text-base font-bold text-slate-900 leading-snug mb-3 group-hover:text-blue-600 transition-colors">
                            Upacara Bendera Khidmat dalam Rangka Peringatan HUT Kemerdekaan Republik Indonesia Ke-79
                        </h2>
                    </div>
                    <div class="mt-auto flex items-center gap-3 pt-4 border-t border-gray-50">
                        <span class="bg-highlight text-white text-[10px] font-bold px-2 py-1 rounded tracking-wide">Admin</span>
                        <span class="text-xs text-gray-500 font-medium">17 Agustus 2024</span>
                    </div>
                </div>
            </article>

            <!-- Card 5 -->
            <article class="news-card bg-white rounded-xl border border-gray-100 overflow-hidden flex flex-col h-full cursor-pointer group">
                <div class="img-container relative h-48 bg-gray-200 flex-shrink-0">
                    <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&q=80&w=600" alt="Thumbnail" class="w-full h-full object-cover">
                </div>
                <div class="p-5 flex flex-col flex-grow">
                    <div class="news-title-wrapper">
                        <h2 class="news-title text-base font-bold text-slate-900 leading-snug mb-3 group-hover:text-blue-600 transition-colors">
                            Kegiatan Belajar Luar Kelas (Outing Class) di Kebun Raya guna Mengenal Flora Nusantara
                        </h2>
                    </div>
                    <div class="mt-auto flex items-center gap-3 pt-4 border-t border-gray-50">
                        <span class="bg-highlight text-white text-[10px] font-bold px-2 py-1 rounded tracking-wide">Admin</span>
                        <span class="text-xs text-gray-500 font-medium">10 Agustus 2024</span>
                    </div>
                </div>
            </article>

            <!-- Card 6 -->
            <article class="news-card bg-white rounded-xl border border-gray-100 overflow-hidden flex flex-col h-full cursor-pointer group">
                <div class="img-container relative h-48 bg-gray-200 flex-shrink-0">
                    <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&q=80&w=600" alt="Thumbnail" class="w-full h-full object-cover">
                </div>
                <div class="p-5 flex flex-col flex-grow">
                    <div class="news-title-wrapper">
                        <h2 class="news-title text-base font-bold text-slate-900 leading-snug mb-3 group-hover:text-blue-600 transition-colors">
                            Informasi Lengkap Penerimaan Peserta Didik Baru (PPDB) Tahun Ajaran 2024/2025
                        </h2>
                    </div>
                    <div class="mt-auto flex items-center gap-3 pt-4 border-t border-gray-50">
                        <span class="bg-highlight text-white text-[10px] font-bold px-2 py-1 rounded tracking-wide">Admin</span>
                        <span class="text-xs text-gray-500 font-medium">1 Juli 2024</span>
                    </div>
                </div>
            </article>

            <!-- Card 7 -->
            <article class="news-card bg-white rounded-xl border border-gray-100 overflow-hidden flex flex-col h-full cursor-pointer group">
                <div class="img-container relative h-48 bg-gray-200 flex-shrink-0">
                    <img src="https://images.unsplash.com/photo-1511632765486-a01980e01a18?auto=format&fit=crop&q=80&w=600" alt="Thumbnail" class="w-full h-full object-cover">
                </div>
                <div class="p-5 flex flex-col flex-grow">
                    <div class="news-title-wrapper">
                        <h2 class="news-title text-base font-bold text-slate-900 leading-snug mb-3 group-hover:text-blue-600 transition-colors">
                            Pentas Seni Akhir Tahun: Mengangkat Tema "Kearifan Lokal dan Budaya Bangsa"
                        </h2>
                    </div>
                    <div class="mt-auto flex items-center gap-3 pt-4 border-t border-gray-50">
                        <span class="bg-highlight text-white text-[10px] font-bold px-2 py-1 rounded tracking-wide">Admin</span>
                        <span class="text-xs text-gray-500 font-medium">20 Juni 2024</span>
                    </div>
                </div>
            </article>

            <!-- Card 8 -->
            <article class="news-card bg-white rounded-xl border border-gray-100 overflow-hidden flex flex-col h-full cursor-pointer group">
                <div class="img-container relative h-48 bg-gray-200 flex-shrink-0">
                    <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b955?auto=format&fit=crop&q=80&w=600" alt="Thumbnail" class="w-full h-full object-cover">
                </div>
                <div class="p-5 flex flex-col flex-grow">
                    <div class="news-title-wrapper">
                        <h2 class="news-title text-base font-bold text-slate-900 leading-snug mb-3 group-hover:text-blue-600 transition-colors">
                            Sosialisasi Bahaya Narkoba dan Kenakalan Remaja untuk Siswa Kelas 6 SD
                        </h2>
                    </div>
                    <div class="mt-auto flex items-center gap-3 pt-4 border-t border-gray-50">
                        <span class="bg-highlight text-white text-[10px] font-bold px-2 py-1 rounded tracking-wide">Admin</span>
                        <span class="text-xs text-gray-500 font-medium">15 Mei 2024</span>
                    </div>
                </div>
            </article>

        </div>

        <!-- Pagination -->
        <div class="flex flex-col items-center justify-center space-y-4">
            <nav class="bg-white rounded-full shadow-lg shadow-slate-200/50 px-2 py-2 flex items-center space-x-1 border border-slate-50">
                <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full text-slate-400 hover:text-blue-600 hover:bg-slate-50 transition-all duration-200 group">
                    <i data-lucide="chevron-left" class="w-5 h-5 group-hover:-translate-x-0.5 transition-transform"></i>
                </a>
                <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-highlight text-white shadow-md shadow-blue-200 font-semibold transition-all hover:bg-blue-700">1</a>
                <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full text-slate-600 hover:bg-slate-100 hover:text-blue-600 font-medium transition-all">2</a>
                <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full text-slate-600 hover:bg-slate-100 hover:text-blue-600 font-medium transition-all hidden sm:flex">3</a>
                <span class="w-10 h-10 flex items-center justify-center text-slate-400 font-medium">...</span>
                <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full text-slate-400 hover:text-blue-600 hover:bg-slate-50 transition-all duration-200 group">
                    <i data-lucide="chevron-right" class="w-5 h-5 group-hover:translate-x-0.5 transition-transform"></i>
                </a>
            </nav>
            <p class="text-xs text-slate-400 font-medium">Menampilkan 1 - 8 dari 32 Berita</p>
        </div>

    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-100 py-6 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center text-sm text-gray-500">
            <p>&copy; 2024 SD Negeri JuwetKenongo. All rights reserved.</p>
            <div class="flex space-x-4 mt-2 md:mt-0">
                <a href="#" class="hover:text-blue-600">Privacy</a>
                <a href="#" class="hover:text-blue-600">Terms</a>
                <a href="#" class="hover:text-blue-600">Contact</a>
            </div>
        </div>
    </footer>

    <script>
        lucide.createIcons();

        // Mobile Menu Logic
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        // --- Optimized Smooth Expansion Script ---
        const cards = document.querySelectorAll('.news-card');

        cards.forEach(card => {
            // Kita menganimasikan 'wrapper' bukan 'title' secara langsung
            // karena line-clamp pada 'title' tidak bisa dianimasikan.
            const wrapper = card.querySelector('.news-title-wrapper');
            const title = card.querySelector('.news-title');

            // Set initial height explicitly for wrapper to match collapsed content
            // Gunakan requestAnimationFrame agar browser selesai render CSS awal
            requestAnimationFrame(() => {
                if(wrapper && title) {
                    wrapper.style.height = `${title.offsetHeight}px`;
                }
            });

            card.addEventListener('mouseenter', () => {
                if(!wrapper || !title) return;

                // 1. Dapatkan tinggi saat collapsed
                const startHeight = title.offsetHeight;

                // 2. Buka line-clamp untuk mengukur tinggi penuh
                title.classList.add('line-clamp-none');

                // 3. Ukur tinggi penuh konten
                const endHeight = title.offsetHeight;

                // 4. Kembalikan clamp sejenak agar animasi dimulai dari posisi collapsed
                title.classList.remove('line-clamp-none');

                // 5. Set tinggi wrapper ke startHeight (jaga-jaga)
                wrapper.style.height = `${startHeight}px`;

                // 6. Force reflow agar browser sadar perubahan height
                void wrapper.offsetHeight;

                // 7. Mulai animasi: Buka clamp DAN set height wrapper ke full
                // Kita perlu menambahkan class clamp-none agar teks merender full
                // TAPI jika kita tambah langsung, teks akan loncat.
                // Trik: Animasi wrapper height dulu, baru buka clamp? Tidak bisa karena teks butuh ruang.

                // Solusi Terbaik:
                // Biarkan wrapper overflow hidden.
                // Tambah class line-clamp-none. Teks akan ekspansi tapi tertutup wrapper.
                title.classList.add('line-clamp-none');

                // Set wrapper height ke endHeight. CSS transition akan mengurus sisanya.
                wrapper.style.height = `${endHeight}px`;
            });

            card.addEventListener('mouseleave', () => {
                if(!wrapper || !title) return;

                // 1. Saat mouse leave, wrapper sedang di endHeight.
                // Kita harus kembalikan ke tinggi collapsed.

                // Hitung tinggi collapsed ideal (kita bisa simpan di awal, atau hitung ulang)
                // Hapus class clamp untuk mengukur (tapi ini akan bikin flash)
                // Karena font tidak berubah, kita bisa asumsikan tinggi collapsed relatif stabil
                // atau lebih aman: biarkan wrapper animasi mengecil dulu.

                // hapus line-clamp-none SETELAH animasi selesai?
                // Jika kita hapus sekarang, teks akan snap ke ... dan wrapper akan shrink pelan2 -> jelek (ada gap kosong).

                // Solusi: Animasi wrapper shrink dulu.
                // Tapi kita butuh target height.

                // Cara hacky tapi smooth:
                // Kita clone elemen sebentar untuk ukur tinggi collapsed? Berat.
                // Kita remove clamp, ukur full (sudah ada), lalu remove clamp class? Tidak.

                // Kita tahu tinggi wrapper saat ini (full).
                // Kita remove class clamp, ukur tinggi collapsed.

                title.classList.remove('line-clamp-none');
                const collapsedHeight = title.offsetHeight;
                title.classList.add('line-clamp-none'); // Kembalikan ke full biar ga snap visual

                // Force reflow
                void wrapper.offsetHeight;

                // Set height target ke collapsed
                wrapper.style.height = `${collapsedHeight}px`;

                // Tunggu transisi selesai baru pasang clamp 'resmi'
                // Gunakan 'once' event listener untuk transitionend
                wrapper.addEventListener('transitionend', function() {
                    title.classList.remove('line-clamp-none');
                    // Optional: wrapper.style.height = 'auto'; // jika ingin responsif, tapi bisa bikin jump saat resize window
                }, { once: true });
            });
        });
    </script>
</body>
</html>
