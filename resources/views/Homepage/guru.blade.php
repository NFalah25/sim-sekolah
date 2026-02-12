<style>
    .snap-start {
        scroll-snap-align: start;
    }

    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }

    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
<div class="w-full h-full bg-blue-dark md:px-20 p-4 overflow-hidden pb-16">
    <div class="w-24 h-1 bg-third mt-6"></div>
    <div class="flex items-center justify-between mt-2 mb-6 gap-5">
        <h2 class="md:text-2xl text-lg font-bold text-white items-center flex">Guru dan Tenaga Pendidik</h2>
        <a href="{{ route('landing.guru') }}" class="text-primary font-semibold">SELENGKAPNYA</a>
    </div>
    <div class="relative">
        <button id="prev-btn"
            class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-white p-3 rounded-full shadow-xl hover:bg-indigo-50 text-indigo-600 z-10 hidden md:block transition duration-200">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        <div id="carousel-container" class="flex overflow-x-scroll no-scrollbar space-x-6 py-4 scroll-smooth"
            style="scroll-snap-type: x mandatory;">
        </div>
        <button id="next-btn"
            class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-white p-3 rounded-full shadow-xl hover:bg-indigo-50 text-indigo-600 z-10 hidden md:block transition duration-200">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
    </div>
</div>

<script>
    const carouselContainer = document.getElementById('carousel-container');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');

    const teachersData = @json($teachers);
    console.log(teachersData);

    function getInitials(name) {
        const parts = name.trim().split(' ');
        let initials = '';

        if (parts.length > 0) {
            // Ambil huruf pertama kata pertama
            initials += parts[0][0];

            if (parts.length > 1) {
                // Ambil huruf pertama kata kedua
                initials += parts[1][0];
            }
        }

        return initials.toUpperCase();
    }

    function createTeacherCard(teacher) {
        let imageUrl;
        if (teacher.initial) {
            const initialsText = teacher.initial.replace(' ', '+');
            imageUrl = `https://placehold.co/80x80/4F46E5/FFFFFF?text=${initialsText}`;
        } else {
            imageUrl = teacher.image;
        }

        // 2. Kembalikan Template HTML
        return `
        <div class="flex-shrink-0 w-32 sm:w-32 md:w-48 teacher-card-item snap-start bg-white p-6 rounded-xl shadow-lg border border-gray-100 transition duration-300 transform hover:shadow-xl hover:scale-[1.02]">
            <img class="w-20 h-20 rounded-full mx-auto object-cover border-4 border-${teacher.color}-500 ring-2 ring-${teacher.color}-200"
                src="${imageUrl}"
                alt="Foto ${teacher.name}">
            <div class="mt-4 text-center">
                <h3 class="text-base font-bold text-gray-900">${teacher.name}</h3>
                <p class="text-${teacher.color}-600 font-semibold text-sm mt-1">${teacher.position}</p>
                <div class="mt-3 h-10 flex items-center justify-center">
                    <span class="inline-flex items-center text-xs font-medium bg-sky-100 text-sky-800 px-2.5 py-0.5 rounded-full">
                        ✨ ${teacher.motivation}
                    </span>
                </div>
            </div>
        </div>
    `;
    }

    function renderAllTeachers() {
        let htmlContent = '';
        teachersData.forEach(teacher => {
            htmlContent += createTeacherCard(teacher);
        });
        carouselContainer.innerHTML = htmlContent;
    }

    let scrollIndex = 0;
    const cardWidth = 320 + 24;

    function updateButtons() {
        prevBtn.disabled = scrollIndex === 0;
        nextBtn.disabled = scrollIndex >= (teachersData.length - 1);

        if (scrollIndex > 0) {
            prevBtn.classList.remove('opacity-50');
        } else {
            prevBtn.classList.add('opacity-50');
        }
    }

    function scrollCarousel(direction) {
        const cardItems = carouselContainer.querySelectorAll('.teacher-card-item');
        if (cardItems.length === 0) return;

        const cardWidthWithMargin = cardItems[0].offsetWidth + (parseFloat(getComputedStyle(carouselContainer).gap) ||
            24);

        if (direction === 'next') {
            if (scrollIndex < teachersData.length - 1) {
                scrollIndex++;
            }
        } else if (direction === 'prev') {
            if (scrollIndex > 0) {
                scrollIndex--;
            }
        }

        const targetScrollLeft = cardWidthWithMargin * scrollIndex;

        carouselContainer.scrollTo({
            left: targetScrollLeft,
            behavior: 'smooth'
        });

        updateButtons();
    }

    document.addEventListener('DOMContentLoaded', () => {
        renderAllTeachers();

        // Tambahkan event listener untuk tombol
        prevBtn.addEventListener('click', () => scrollCarousel('prev'));
        nextBtn.addEventListener('click', () => scrollCarousel('next'));

        // Inisialisasi status tombol
        updateButtons();

        // Set scroll index berdasarkan posisi scroll aktual (untuk sentuhan/swipe)
        carouselContainer.addEventListener('scroll', () => {
            // Mendapatkan lebar kartu pertama + margin
            const cardItems = carouselContainer.querySelectorAll('.teacher-card-item');
            if (cardItems.length === 0) return;
            const cardWidthWithMargin = cardItems[0].offsetWidth + (parseFloat(getComputedStyle(
                carouselContainer).gap) || 24);

            // Menghitung indeks berdasarkan scroll position
            const newIndex = Math.round(carouselContainer.scrollLeft / cardWidthWithMargin);
            if (newIndex !== scrollIndex) {
                scrollIndex = newIndex;
                updateButtons();
            }
        });
    });
</script>
