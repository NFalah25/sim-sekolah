<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struktur Organisasi - SD Negeri JuwetKenongo</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Konfigurasi Tema Warna -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#3396D3',
                            dark: '#2a78a9',
                            light: '#E6F4FA',
                        },
                        secondary: '#EBCB90',
                        third: '#FFF0CE',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }

        /* Tab Active State Style */
        .tab-btn {
            transition: all 0.3s ease;
        }
        .tab-btn.active {
            background-color: #3396D3; /* Primary */
            color: white;
            border-color: #3396D3;
            box-shadow: 0 4px 6px -1px rgba(51, 150, 211, 0.3);
        }

        .tab-btn.active i {
            color: white;
        }

        .tab-btn:not(.active):hover {
            background-color: rgba(51, 150, 211, 0.05);
        }

        /* Image Hover */
        .chart-container:hover .zoom-overlay {
            opacity: 1;
        }

        /* Modal Zoom */
        #zoom-modal {
            transition: opacity 0.3s ease;
        }
        #zoom-modal.hidden {
            opacity: 0;
            pointer-events: none;
        }
        #zoom-modal:not(.hidden) {
            opacity: 1;
            pointer-events: auto;
        }
    </style>
</head>
<body class="text-slate-800 flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-3">
                    <div class="bg-primary text-white p-1.5 rounded-lg">
                        <i data-lucide="book-open" class="h-5 w-5"></i>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-bold text-lg leading-none text-slate-800">SD Negeri <span class="text-primary">JuwetKenongo</span></span>
                    </div>
                </div>
                <!-- Menu Placeholder -->
                <div class="hidden md:flex items-center space-x-8 text-sm font-medium text-slate-500">
                    <a href="#" class="hover:text-primary transition">Beranda</a>
                    <a href="#" class="hover:text-primary transition">Profil</a>
                    <a href="#" class="hover:text-primary transition">Berita</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-12">
            <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4">Struktur Organisasi</h1>
            <div class="w-20 h-1.5 bg-secondary rounded-full mx-auto mb-4"></div>
            <p class="text-slate-500 text-lg">Mengenal lebih dekat susunan kepemimpinan, manajemen, dan tata usaha yang bersinergi memajukan sekolah.</p>
        </div>

        <!-- Layout Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            <!-- SIDEBAR MENU (Container ini akan diisi oleh JavaScript) -->
            <div class="lg:col-span-3 space-y-3">
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4 px-2">Pilih Struktur</h3>

                <!-- Menu List Container -->
                <div id="sidebar-menu-list" class="space-y-3">
                    <!-- Javascript akan menyuntikkan tombol di sini -->
                </div>

                <!-- Info Box -->
                <div class="mt-8 p-4 bg-third/30 rounded-xl border border-secondary/20">
                    <div class="flex items-start gap-3">
                        <i data-lucide="info" class="w-5 h-5 text-yellow-600 mt-0.5"></i>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Klik menu di atas untuk melihat bagan struktur organisasi yang berbeda.
                        </p>
                    </div>
                </div>
            </div>

            <!-- CONTENT DISPLAY -->
            <div class="lg:col-span-9">
                <div id="content-container" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-1.5 md:p-3 h-full transition-all duration-500">

                    <!-- Content Header -->
                    <div class="px-4 py-4 md:px-6 border-b border-gray-50 flex justify-between items-center">
                        <div>
                            <h2 id="display-title" class="text-xl font-bold text-slate-800">Loading...</h2>
                            <p id="display-desc" class="text-sm text-slate-500 mt-1">...</p>
                        </div>
                        <div class="hidden md:flex items-center gap-2 text-xs text-slate-400 bg-slate-50 px-3 py-1.5 rounded-full">
                            <i data-lucide="zoom-in" class="w-4 h-4"></i> Klik gambar untuk memperbesar
                        </div>
                    </div>

                    <!-- Image Container -->
                    <div class="chart-container relative w-full bg-slate-50 rounded-xl overflow-hidden mt-2 group cursor-zoom-in" onclick="openZoomModal()">
                        <img id="display-image"
                             src=""
                             alt="Bagan Organisasi"
                             class="w-full h-auto object-contain min-h-[400px] md:min-h-[600px] transition-transform duration-500 group-hover:scale-[1.02]">

                        <div class="zoom-overlay absolute inset-0 bg-black/20 opacity-0 transition-opacity duration-300 flex items-center justify-center backdrop-blur-[2px]">
                            <button class="bg-white text-primary px-6 py-3 rounded-full font-bold shadow-lg flex items-center gap-2 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                <i data-lucide="maximize-2" class="w-5 h-5"></i> Lihat Ukuran Penuh
                            </button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </main>

    <!-- MODAL ZOOM (Lightbox) -->
    <div id="zoom-modal" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/90 backdrop-blur-sm hidden p-4">
        <button onclick="closeZoomModal()" class="absolute top-4 right-4 z-20 p-3 bg-white/10 hover:bg-white/20 rounded-full text-white transition-colors">
            <i data-lucide="x" class="w-8 h-8"></i>
        </button>
        <div class="w-full h-full overflow-auto flex items-center justify-center" onclick="closeZoomModal()">
            <img id="modal-image" src="" alt="Full Size Chart" class="max-w-none md:max-w-full md:max-h-full shadow-2xl rounded-lg cursor-default" onclick="event.stopPropagation()">
        </div>
        <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 bg-black/50 text-white px-4 py-2 rounded-full text-sm backdrop-blur-md pointer-events-none">
            Tekan ESC atau klik area gelap untuk menutup
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-100 py-8 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm text-gray-500">
            <p>&copy; 2024 SD Negeri JuwetKenongo. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // --- 1. DATA DARI CONTROLLER (JSON) ---
        // Nanti di Laravel, ganti bagian ini dengan: const structures = @json($structures);

        const structures = [
            {
                id: 1,
                title: "Struktur Manajemen Sekolah",
                description: "Meliputi Kepala Sekolah, Wakil Kepala Sekolah, Bendahara, dan Koordinator Kurikulum.",
                image: "https://cdn.creately.com/files/templates/thumb/jng2z2722-school-organizational-chart-template-classic.png",
                icon: "users" // Nama icon lucide
            },
            {
                id: 2,
                title: "Struktur Staff & Tata Usaha",
                description: "Bagan susunan kepegawaian administrasi, operator sekolah, dan tenaga kependidikan.",
                image: "https://creately.com/static/assets/templates/thumbnails/organizational-chart-template-for-schools-thumb.png",
                icon: "file-text"
            },
            {
                id: 3,
                title: "Struktur Komite Sekolah",
                description: "Susunan pengurus komite sekolah sebagai mitra dalam memajukan pendidikan.",
                image: "https://www.orgcharting.com/wp-content/uploads/2020/07/university-org-chart.png",
                icon: "heart-handshake"
            },
            {
                id: 4,
                title: "Struktur OSIS",
                description: "Organisasi Siswa Intra Sekolah sebagai wadah pengembangan kepemimpinan siswa.",
                image: "https://wcs.smartdraw.com/organization-chart/img/organization-chart-of-a-company.jpg",
                icon: "graduation-cap"
            }
        ];

        // --- 2. LOGIC RENDER & INTERAKSI ---
        const menuContainer = document.getElementById('sidebar-menu-list');
        const contentContainer = document.getElementById('content-container');

        const displayTitle = document.getElementById('display-title');
        const displayDesc = document.getElementById('display-desc');
        const displayImage = document.getElementById('display-image');

        // Fungsi Render Menu Sidebar
        function renderSidebar() {
            menuContainer.innerHTML = ''; // Bersihkan container

            structures.forEach((item, index) => {
                const btn = document.createElement('button');
                // Set default class
                btn.className = `tab-btn w-full flex items-center gap-3 px-4 py-3.5 rounded-xl text-left font-semibold text-slate-600 bg-white border border-transparent transition-all duration-300 ${index === 0 ? 'active' : ''}`;

                // Set konten button
                btn.innerHTML = `
                    <div class="p-2 bg-white/50 rounded-lg shrink-0">
                        <i data-lucide="${item.icon}" class="w-5 h-5 text-slate-400 transition-colors"></i>
                    </div>
                    <span>${item.title}</span>
                `;

                // Add Event Listener
                btn.onclick = () => switchTab(index, btn);

                menuContainer.appendChild(btn);
            });

            // Re-initialize icons setelah render HTML baru
            lucide.createIcons();

            // Load data pertama saat awal
            if(structures.length > 0) {
                updateContent(structures[0]);
            }
        }

        // Fungsi Ganti Tab
        function switchTab(index, clickedBtn) {
            const data = structures[index];
            if (!data) return;

            // 1. Update Active State Buttons
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            clickedBtn.classList.add('active');

            // 2. Animasi Fade Out
            contentContainer.classList.add('opacity-50', 'translate-y-2');

            // 3. Update Data (dengan delay sedikit agar animasi terasa)
            setTimeout(() => {
                updateContent(data);
                // 4. Animasi Fade In
                contentContainer.classList.remove('opacity-50', 'translate-y-2');
            }, 300);
        }

        // Helper Update HTML Content
        function updateContent(data) {
            displayTitle.innerText = data.title;
            displayDesc.innerText = data.description; // Sesuai key JSON 'description'
            displayImage.src = data.image; // Jika dari laravel pakai: asset('storage/' + data.image)
        }

        // --- 3. MODAL LOGIC (Tetap Sama) ---
        const modal = document.getElementById('zoom-modal');
        const modalImg = document.getElementById('modal-image');

        function openZoomModal() {
            modalImg.src = displayImage.src;
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeZoomModal() {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeZoomModal();
            }
        });

        // --- 4. INITIALIZE ---
        // Jalankan render saat halaman siap
        document.addEventListener('DOMContentLoaded', () => {
            renderSidebar();
        });

    </script>
</body>
</html>
{{-- ```

### Cara Implementasi di Controller Laravel:

Nanti di Controller Anda, cukup kirim data seperti ini:

```php
public function index()
{
    // Ambil data dari database
    $structures = StrukturOrganisasi::select('id', 'title', 'description', 'image', 'icon')->get();

    // Modifikasi path image agar full URL (Opsional, bisa juga diatur di JS)
    $structures->transform(function($item) {
        $item->image = asset('storage/' . $item->image);
        return $item;
    });

    return view('landing.organisasi', compact('structures'));
} --}}
