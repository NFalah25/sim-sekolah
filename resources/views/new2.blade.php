<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fasilitas SD Negeri JuwetKenongo</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts: Poppins (Headings) & Inter (Body) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        heading: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            DEFAULT: '#3396D3', // Biru Utama
                            dark: '#2a78a9',    // Biru Gelap
                        },
                        secondary: '#EBCB90',   // Emas/Krem Tua
                        third: '#FFF0CE',       // Krem Muda (Masih disimpan untuk aksen menu mobile)
                        school: {
                            dark: '#1F2937',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #ffffff; /* Track scrollbar jadi putih */
        }
        ::-webkit-scrollbar-thumb {
            background: #3396D3;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #2a78a9;
        }

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
    </style>
</head>
<!-- Body Background diubah menjadi bg-white -->
<body class="bg-white text-gray-800 font-sans flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav class="bg-white shadow-sm sticky top-0 z-40 border-b-4 border-secondary">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <!-- Logo Section -->
                <div class="flex-shrink-0 flex items-center gap-3">
                    <!-- Placeholder Logo -->
                    <img class="h-10 w-auto" src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9c/Logo_Tut_Wuri_Handayani.png/1200px-Logo_Tut_Wuri_Handayani.png" alt="Logo SD">
                    <div>
                        <h1 class="text-lg font-heading font-bold text-gray-900 leading-tight">SD Negeri <span class="text-primary">JuwetKenongo</span></h1>
                        <p class="text-xs text-gray-500 font-medium">Mewujudkan Generasi Cerdas & Berkarakter</p>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="text-gray-600 hover:text-primary font-medium transition duration-300">Beranda</a>
                    <a href="#" class="text-gray-600 hover:text-primary font-medium transition duration-300">Profil Sekolah</a>
                    <div class="relative group">
                        <button class="text-gray-600 group-hover:text-primary font-medium flex items-center gap-1 transition duration-300">
                            Berita <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                    </div>
                    <a href="#" class="text-gray-600 hover:text-primary font-medium transition duration-300">Prestasi</a>
                    <a href="#" class="text-primary font-bold border-b-2 border-secondary pb-1">Fasilitas</a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex items-center md:hidden">
                    <button onclick="toggleMobileMenu()" class="text-gray-600 hover:text-primary focus:outline-none p-2">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100 absolute w-full shadow-lg">
            <div class="px-4 pt-2 pb-4 space-y-1">
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary hover:bg-gray-50">Beranda</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary hover:bg-gray-50">Profil Sekolah</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-primary bg-third/30">Fasilitas</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary hover:bg-gray-50">Kontak</a>
            </div>
        </div>
    </nav>

    <!-- Breadcrumb -->
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
            <p class="text-sm text-gray-500">
                <a href="#" class="hover:text-primary">Beranda</a>
                <span class="mx-2 text-secondary">/</span>
                <span class="font-semibold text-gray-800">Fasilitas</span>
            </p>
        </div>
    </div>

    <!-- Main Content -->
    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full">

        <!-- Header Section -->
        <div class="text-center max-w-3xl mx-auto mb-12 fade-in-up" style="animation-delay: 0.1s;">
            <h2 class="text-3xl md:text-4xl font-heading font-bold text-gray-900 mb-4">
                Fasilitas <span class="text-primary">Unggulan</span> Kami
            </h2>
            <div class="h-1.5 w-24 bg-secondary mx-auto rounded-full mb-6"></div>
            <p class="text-gray-600 text-lg leading-relaxed">
                SD Negeri JuwetKenongo dilengkapi dengan berbagai fasilitas modern yang dirancang untuk mendukung kenyamanan siswa dan efektivitas proses pembelajaran.
            </p>
        </div>

        <!-- Gallery Grid -->
        <div id="facility-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 fade-in-up" style="animation-delay: 0.3s;">
            <!-- Content will be injected by JS -->
        </div>

    </main>

    <!-- Footer Simple -->
    <footer class="bg-school-dark text-white py-8 mt-auto border-t-4 border-primary">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-gray-400 text-sm">© 2024 SD Negeri JuwetKenongo. All rights reserved.</p>
        </div>
    </footer>

    <!-- Image Modal (Lightbox) -->
    <div id="image-modal" class="fixed inset-0 z-50 hidden bg-school-dark/90 flex items-center justify-center p-4 backdrop-blur-sm transition-opacity duration-300">
        <button onclick="closeModal()" class="absolute top-4 right-4 text-white hover:text-secondary focus:outline-none z-50 transition-colors">
            <i class="fas fa-times text-3xl"></i>
        </button>

        <div class="relative max-w-5xl w-full bg-white rounded-lg overflow-hidden shadow-2xl transform transition-all scale-95 opacity-0 border-t-4 border-secondary" id="modal-content">
            <div class="grid grid-cols-1 md:grid-cols-3">
                <div class="md:col-span-2 bg-black flex items-center justify-center h-[50vh] md:h-[70vh]">
                    <img id="modal-img" src="" alt="Fasilitas Detail" class="max-h-full max-w-full object-contain">
                </div>
                <div class="p-6 md:p-8 flex flex-col justify-center bg-white">
                    <div class="mb-4">
                        <span class="inline-block px-3 py-1 text-xs font-bold text-gray-800 bg-secondary rounded-full mb-2">Fasilitas Sekolah</span>
                        <h3 id="modal-title" class="text-2xl font-heading font-bold text-gray-900 mb-2">Nama Fasilitas</h3>
                        <div class="h-1 w-12 bg-primary rounded-full mb-4"></div>
                    </div>
                    <p id="modal-desc" class="text-gray-600 mb-6 leading-relaxed">
                        Deskripsi fasilitas.
                    </p>
                    <button onclick="closeModal()" class="self-start px-6 py-2 border-2 border-gray-200 rounded-lg text-gray-700 hover:border-primary hover:text-primary transition font-medium text-sm">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Data Fasilitas
        const facilities = [
            {
                title: "Mushola Sekolah",
                image: "https://images.unsplash.com/photo-1564121211835-e88c852648ab?q=80&w=1000&auto=format&fit=crop",
                icon: "fa-mosque",
                desc: "Tempat ibadah yang bersih dan nyaman untuk kegiatan keagamaan siswa dan guru."
            },
            {
                title: "Perpustakaan",
                image: "https://images.unsplash.com/photo-1568667256549-094345857637?q=80&w=1000&auto=format&fit=crop",
                icon: "fa-book-open",
                desc: "Koleksi buku lengkap dengan ruang baca yang hening untuk menumbuhkan minat baca siswa."
            },
            {
                title: "Lab. Komputer",
                image: "https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=1000&auto=format&fit=crop",
                icon: "fa-desktop",
                desc: "Laboratorium modern dengan perangkat komputer terbaru untuk pembelajaran teknologi."
            },
            {
                title: "Lapangan Olahraga",
                image: "https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=1000&auto=format&fit=crop",
                icon: "fa-futbol",
                desc: "Area luas untuk kegiatan olahraga, upacara bendera, dan aktivitas luar ruangan lainnya."
            },
            {
                title: "Kantin Sehat",
                image: "https://images.unsplash.com/photo-1588072432836-e10032774350?q=80&w=1000&auto=format&fit=crop",
                icon: "fa-utensils",
                desc: "Menyediakan makanan dan minuman yang higienis serta sehat untuk seluruh warga sekolah."
            },
            {
                title: "Ruang Kelas",
                image: "https://images.unsplash.com/photo-1580582932707-520aed937b7b?q=80&w=1000&auto=format&fit=crop",
                icon: "fa-chalkboard-user",
                desc: "Ruang belajar yang kondusif, dilengkapi ventilasi udara yang baik dan pencahayaan cukup."
            }
        ];

        // Render Grid
        const gridContainer = document.getElementById('facility-grid');

        facilities.forEach((item, index) => {
            const cardHTML = `
                <div onclick="openModal(${index})" class="group relative h-64 rounded-2xl overflow-hidden cursor-pointer shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 bg-gray-100 border border-gray-200">
                    <!-- Image -->
                    <img src="${item.image}" alt="${item.title}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-school-dark/90 via-primary-dark/30 to-transparent opacity-90"></div>

                    <!-- Content -->
                    <div class="absolute bottom-0 left-0 w-full p-5 translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                        <div class="flex items-center gap-3 mb-1">
                            <div class="bg-primary/90 p-2 rounded-lg text-white text-sm backdrop-blur-sm shadow-md border border-white/20">
                                <i class="fas ${item.icon}"></i>
                            </div>
                            <h3 class="text-xl font-heading font-bold text-white tracking-wide drop-shadow-md">${item.title}</h3>
                        </div>
                        <div class="h-0 group-hover:h-auto overflow-hidden transition-all duration-300 opacity-0 group-hover:opacity-100">
                            <p class="text-secondary text-sm line-clamp-2 mt-2 font-medium">Klik untuk melihat detail.</p>
                        </div>
                    </div>

                    <!-- Corner Decoration -->
                    <div class="absolute top-4 right-4 bg-white/20 backdrop-blur-md p-2 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 hover:bg-primary hover:text-white">
                        <i class="fas fa-expand text-white text-xs"></i>
                    </div>
                </div>
            `;
            gridContainer.innerHTML += cardHTML;
        });

        // Mobile Menu Logic
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }

        // Modal Logic
        const modal = document.getElementById('image-modal');
        const modalContent = document.getElementById('modal-content');
        const modalImg = document.getElementById('modal-img');
        const modalTitle = document.getElementById('modal-title');
        const modalDesc = document.getElementById('modal-desc');

        function openModal(index) {
            const item = facilities[index];
            modalImg.src = item.image;
            modalTitle.innerText = item.title;
            modalDesc.innerText = item.desc;

            modal.classList.remove('hidden');
            // Small timeout to allow CSS transition to work
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeModal() {
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');

            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        // Close modal on clicking outside content
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeModal();
            }
        });
    </script>
</body>
</html>
