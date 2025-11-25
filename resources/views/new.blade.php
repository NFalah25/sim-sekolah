<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview Prestasi - Landing Page</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
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
                        },
                        secondary: '#EBCB90',
                        third: '#FFF0CE',
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
        }

        /* Smooth Card Hover */
        .preview-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .preview-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Image Zoom Inside Card */
        .img-zoom-container {
            overflow: hidden;
            border-radius: 1rem;
        }

        .img-zoom-container img {
            transition: transform 0.6s ease;
        }

        .preview-card:hover .img-zoom-container img {
            transform: scale(1.1);
        }

        /* Modal Transitions */
        #preview-modal {
            transition: opacity 0.3s ease;
        }

        #preview-modal.hidden {
            opacity: 0;
            pointer-events: none;
        }

        #preview-modal:not(.hidden) {
            opacity: 1;
            pointer-events: auto;
        }

        .modal-content {
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        #preview-modal.hidden .modal-content {
            transform: scale(0.95);
        }

        #preview-modal:not(.hidden) .modal-content {
            transform: scale(1);
        }

        /* Hide scrollbar for Clean Look but keep functionality */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen justify-center">

    <!-- Section Prestasi (Landing Page Component) -->
    <section class="py-12 md:py-16 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header Section -->
            <div class="flex flex-col md:flex-row justify-between items-end mb-8 md:mb-10 border-b border-gray-100 pb-4">
                <div class="mb-4 md:mb-0 w-full md:w-auto">
                    <div class="w-16 h-1.5 bg-primary rounded-full mb-3"></div>
                    <h2 class="text-2xl md:text-3xl font-extrabold text-slate-900 tracking-tight">Prestasi</h2>
                    <p class="text-slate-500 mt-2 text-base md:text-lg">Prestasi Akademik dan non Akademik Siswa</p>
                </div>

                <!-- Desktop Arrow Navigation (Optional Hint) -->
                <div class="hidden md:flex items-center gap-4">
                    <span class="text-sm text-slate-400 font-medium">Geser untuk melihat lainnya</span>
                    <a href="#"
                        class="group flex items-center text-primary font-bold hover:text-primary-dark transition-colors">
                        SELENGKAPNYA
                        <i data-lucide="arrow-right"
                            class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>

            <!-- Slider Container (Single Row for ALL Screens) -->
            <!-- flex-nowrap ensures single row. overflow-x-auto allows scrolling. -->
            <div
                class="flex flex-nowrap overflow-x-auto gap-6 pb-10 px-4 snap-x snap-mandatory no-scrollbar scroll-smooth -mx-4 md:mx-0 md:px-0">

                <!-- Card 1 -->
                <!-- Mobile: w-72 (Fixed), Desktop: w-[calc(25%-1.125rem)] (Fit 4 items perfectly with gap) -->
                <div class="preview-card flex-none w-72 md:w-[calc(33%-1rem)] lg:w-[calc(25%-1.125rem)] snap-center bg-white p-4 rounded-2xl border border-slate-100 shadow-sm cursor-pointer group"
                    onclick="openModal(this)">
                    <div class="img-zoom-container aspect-[4/5] bg-gray-100 mb-4 relative">
                        <img src="https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&q=80&w=400"
                            alt="Prestasi Siswa" class="w-full h-full object-cover">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                        </div>

                        <!-- Data -->
                        <div class="hidden modal-data-title">Juara 1 Lomba Melukis Tingkat Provinsi</div>
                        <div class="hidden modal-data-date">12 November 2025</div>
                        <div class="hidden modal-data-desc">Ananda Putri dari kelas 5B berhasil memukau juri dengan
                            lukisan bertema "Lingkunganku". Ia berhasil menyisihkan 50 peserta lainnya dan membawa
                            pulang piala gubernur.</div>
                        <div class="hidden modal-data-full-img">
                            https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&q=80&w=800
                        </div>
                    </div>
                    <div class="text-center">
                        <h3
                            class="font-bold text-base md:text-lg text-slate-800 leading-snug mb-3 group-hover:text-primary transition-colors line-clamp-2">
                            Juara 1 Lomba Melukis Tingkat Provinsi
                        </h3>
                        <span
                            class="inline-block bg-primary text-white text-xs md:text-sm font-semibold px-4 py-1.5 rounded-md shadow-md shadow-primary/20">Admin</span>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="preview-card flex-none w-72 md:w-[calc(33%-1rem)] lg:w-[calc(25%-1.125rem)] snap-center bg-white p-4 rounded-2xl border border-slate-100 shadow-sm cursor-pointer group"
                    onclick="openModal(this)">
                    <div class="img-zoom-container aspect-[4/5] bg-gray-100 mb-4 relative">
                        <img src="https://images.unsplash.com/photo-1628155930542-3c7a64e2c833?auto=format&fit=crop&q=80&w=400"
                            alt="Prestasi Siswa" class="w-full h-full object-cover">
                        <div class="hidden modal-data-title">Medali Emas Olimpiade Matematika</div>
                        <div class="hidden modal-data-date">10 Oktober 2025</div>
                        <div class="hidden modal-data-desc">Budi Santoso kembali mengharumkan nama sekolah dengan meraih
                            medali emas pada ajang OSN Matematika. Ketekunannya dalam belajar menjadi inspirasi bagi
                            teman-temannya.</div>
                        <div class="hidden modal-data-full-img">
                            https://images.unsplash.com/photo-1628155930542-3c7a64e2c833?auto=format&fit=crop&q=80&w=800
                        </div>
                    </div>
                    <div class="text-center">
                        <h3
                            class="font-bold text-base md:text-lg text-slate-800 leading-snug mb-3 group-hover:text-primary transition-colors line-clamp-2">
                            Medali Emas Olimpiade Matematika
                        </h3>
                        <span
                            class="inline-block bg-primary text-white text-xs md:text-sm font-semibold px-4 py-1.5 rounded-md shadow-md shadow-primary/20">Admin</span>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="preview-card flex-none w-72 md:w-[calc(33%-1rem)] lg:w-[calc(25%-1.125rem)] snap-center bg-white p-4 rounded-2xl border border-slate-100 shadow-sm cursor-pointer group"
                    onclick="openModal(this)">
                    <div class="img-zoom-container aspect-[4/5] bg-gray-100 mb-4 relative">
                        <img src="https://images.unsplash.com/photo-1575361204480-aadea25e6e68?auto=format&fit=crop&q=80&w=400"
                            alt="Prestasi Siswa" class="w-full h-full object-cover">
                        <div class="hidden modal-data-title">Juara 1 Futsal Cup Antar SD</div>
                        <div class="hidden modal-data-date">25 September 2025</div>
                        <div class="hidden modal-data-desc">Tim Futsal SD Negeri JuwetKenongo berhasil mempertahankan
                            gelar juara bertahan setelah mengalahkan lawan di partai final dengan skor telak 3-0.</div>
                        <div class="hidden modal-data-full-img">
                            https://images.unsplash.com/photo-1575361204480-aadea25e6e68?auto=format&fit=crop&q=80&w=800
                        </div>
                    </div>
                    <div class="text-center">
                        <h3
                            class="font-bold text-base md:text-lg text-slate-800 leading-snug mb-3 group-hover:text-primary transition-colors line-clamp-2">
                            Juara 1 Futsal Cup Antar SD
                        </h3>
                        <span
                            class="inline-block bg-primary text-white text-xs md:text-sm font-semibold px-4 py-1.5 rounded-md shadow-md shadow-primary/20">Admin</span>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="preview-card flex-none w-72 md:w-[calc(33%-1rem)] lg:w-[calc(25%-1.125rem)] snap-center bg-white p-4 rounded-2xl border border-slate-100 shadow-sm cursor-pointer group"
                    onclick="openModal(this)">
                    <div class="img-zoom-container aspect-[4/5] bg-gray-100 mb-4 relative">
                        <img src="https://images.unsplash.com/photo-1511632765486-a01980e01a18?auto=format&fit=crop&q=80&w=400"
                            alt="Prestasi Siswa" class="w-full h-full object-cover">
                        <div class="hidden modal-data-title">Penampilan Terbaik Tari Tradisional</div>
                        <div class="hidden modal-data-date">17 Agustus 2025</div>
                        <div class="hidden modal-data-desc">Grup tari "Sekar Arum" mendapatkan penghargaan sebagai
                            penampil terbaik dalam acara gebyar seni budaya tingkat kecamatan.</div>
                        <div class="hidden modal-data-full-img">
                            https://images.unsplash.com/photo-1511632765486-a01980e01a18?auto=format&fit=crop&q=80&w=800
                        </div>
                    </div>
                    <div class="text-center">
                        <h3
                            class="font-bold text-base md:text-lg text-slate-800 leading-snug mb-3 group-hover:text-primary transition-colors line-clamp-2">
                            Penampilan Terbaik Tari Tradisional
                        </h3>
                        <span
                            class="inline-block bg-primary text-white text-xs md:text-sm font-semibold px-4 py-1.5 rounded-md shadow-md shadow-primary/20">Admin</span>
                    </div>
                </div>

                <!-- Card 5 -->
                <div class="preview-card flex-none w-72 md:w-[calc(33%-1rem)] lg:w-[calc(25%-1.125rem)] snap-center bg-white p-4 rounded-2xl border border-slate-100 shadow-sm cursor-pointer group"
                    onclick="openModal(this)">
                    <div class="img-zoom-container aspect-[4/5] bg-gray-100 mb-4 relative">
                        <img src="https://images.unsplash.com/photo-1516475429286-465d815a0df4?auto=format&fit=crop&q=80&w=400"
                            alt="Prestasi Siswa" class="w-full h-full object-cover">
                        <div class="hidden modal-data-title">Juara Umum Lomba Pramuka</div>
                        <div class="hidden modal-data-date">14 Agustus 2025</div>
                        <div class="hidden modal-data-desc">Regu Pramuka Penggalang SD Negeri JuwetKenongo berhasil
                            menyabet gelar Juara Umum pada kemah bakti tingkat Kwartir Ranting.</div>
                        <div class="hidden modal-data-full-img">
                            https://images.unsplash.com/photo-1516475429286-465d815a0df4?auto=format&fit=crop&q=80&w=800
                        </div>
                    </div>
                    <div class="text-center">
                        <h3
                            class="font-bold text-base md:text-lg text-slate-800 leading-snug mb-3 group-hover:text-primary transition-colors line-clamp-2">
                            Juara Umum Lomba Pramuka
                        </h3>
                        <span
                            class="inline-block bg-primary text-white text-xs md:text-sm font-semibold px-4 py-1.5 rounded-md shadow-md shadow-primary/20">Admin</span>
                    </div>
                </div>

                <!-- Card 6 -->
                <div class="preview-card flex-none w-72 md:w-[calc(33%-1rem)] lg:w-[calc(25%-1.125rem)] snap-center bg-white p-4 rounded-2xl border border-slate-100 shadow-sm cursor-pointer group"
                    onclick="openModal(this)">
                    <div class="img-zoom-container aspect-[4/5] bg-gray-100 mb-4 relative">
                        <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&q=80&w=400"
                            alt="Prestasi Siswa" class="w-full h-full object-cover">
                        <div class="hidden modal-data-title">Pemenang Lomba Cerdas Cermat</div>
                        <div class="hidden modal-data-date">2 Mei 2025</div>
                        <div class="hidden modal-data-desc">Tim Cerdas Cermat IPA berhasil meraih skor tertinggi dalam
                            babak final melawan perwakilan dari berbagai sekolah dasar lainnya.</div>
                        <div class="hidden modal-data-full-img">
                            https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&q=80&w=800
                        </div>
                    </div>
                    <div class="text-center">
                        <h3
                            class="font-bold text-base md:text-lg text-slate-800 leading-snug mb-3 group-hover:text-primary transition-colors line-clamp-2">
                            Pemenang Lomba Cerdas Cermat
                        </h3>
                        <span
                            class="inline-block bg-primary text-white text-xs md:text-sm font-semibold px-4 py-1.5 rounded-md shadow-md shadow-primary/20">Admin</span>
                    </div>
                </div>

            </div>

            <!-- Mobile Only Link -->
            <div class="mt-6 md:hidden text-center">
                <a href="#"
                    class="inline-flex items-center text-primary font-bold hover:text-primary-dark transition-colors">
                    LIHAT SEMUA PRESTASI
                    <i data-lucide="arrow-right" class="w-5 h-5 ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Modal Popup (Reusable) -->
    <div id="preview-modal"
        class="fixed inset-0 z-[100] flex items-center justify-center bg-black/70 backdrop-blur-sm hidden p-4">
        <div class="absolute inset-0" onclick="closeModal()"></div>

        <div
            class="modal-content relative bg-white rounded-2xl shadow-2xl w-full max-w-4xl max-h-[90vh] flex flex-col overflow-hidden">
            <button onclick="closeModal()"
                class="absolute top-4 right-4 z-20 p-2 bg-black/50 hover:bg-black/70 rounded-full text-white transition-colors backdrop-blur">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>

            <div class="overflow-y-auto flex flex-col h-full">
                <!-- Full Image -->
                <div class="w-full bg-slate-900 flex items-center justify-center min-h-[300px] p-4">
                    <img id="modal-image" src="" alt="Detail"
                        class="max-w-full max-h-[60vh] object-contain rounded-lg shadow-lg">
                </div>

                <!-- Content -->
                <div class="p-6 md:p-8 bg-white flex-grow">
                    <div class="flex items-center gap-3 mb-3">
                        <span
                            class="bg-secondary text-slate-900 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">Prestasi</span>
                        <div class="flex items-center text-slate-400 text-xs font-medium">
                            <i data-lucide="calendar" class="w-3.5 h-3.5 mr-1.5"></i>
                            <span id="modal-date"></span>
                        </div>
                    </div>

                    <h2 id="modal-title" class="text-2xl md:text-3xl font-bold text-slate-900 mb-4 leading-tight">
                    </h2>
                    <p id="modal-desc" class="text-slate-600 leading-relaxed text-lg mb-6"></p>

                    <!-- Close Action -->
                    <div class="pt-6 border-t border-gray-100 text-right">
                        <button onclick="closeModal()"
                            class="px-6 py-2 bg-gray-100 hover:bg-gray-200 text-slate-700 font-semibold rounded-lg transition-colors">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();

        // Modal Logic
        const modal = document.getElementById('preview-modal');
        const modalImg = document.getElementById('modal-image');
        const modalTitle = document.getElementById('modal-title');
        const modalDate = document.getElementById('modal-date');
        const modalDesc = document.getElementById('modal-desc');

        function openModal(cardElement) {
            const title = cardElement.querySelector('.modal-data-title').innerText;
            const date = cardElement.querySelector('.modal-data-date').innerText;
            const desc = cardElement.querySelector('.modal-data-desc').innerText;
            const fullImg = cardElement.querySelector('.modal-data-full-img').innerText;

            modalTitle.innerText = title;
            modalDate.innerText = date;
            modalDesc.innerText = desc;
            modalImg.src = fullImg;

            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeModal();
            }
        });
    </script>
</body>

</html>
