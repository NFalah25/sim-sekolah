    <script src="https://unpkg.com/lucide@latest"></script>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12    ">
        <div class="w-24 bg-primary mb-4 h-1"></div>
        <div class="flex items-center justify-between mb-6 gap-5">
            <div>
                <h2 class="md:text-2xl text-lg font-bold text-gray-800 items-center flex">Prestasi</h2>
                <p class="text-sm">Prestasi Akademik dan non Akademik Siswa</p>
            </div>
            <a href="{{route('landing.prestasi')}}" class="text-primary font-semibold">SELENGKAPNYA</a>
        </div>
        <div
            class="flex flex-nowrap overflow-x-auto gap-6 pb-10 px-4 snap-x snap-mandatory no-scrollbar scroll-smooth -mx-4 md:mx-0 md:px-0">
            @foreach ($achievements as $data)
                <div class="preview-card flex-none w-72 md:w-[calc(33%-1rem)] lg:w-[calc(25%-1.125rem)] snap-center bg-white p-4 rounded-2xl border border-slate-100 shadow-sm cursor-pointer group"
                    onclick="openModal(this)">
                    <div class="img-zoom-container aspect-[4/5] bg-gray-100 mb-4 relative">
                        <img src="{{ Storage::url($data->image) }}" alt="Prestasi Siswa"
                            class="w-full h-full object-cover">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                        </div>

                        <!-- Data -->
                        <div class="hidden modal-data-title">{{ $data->title }}</div>
                        <div class="hidden modal-data-date">{{ $data->date }}</div>
                        <div class="hidden modal-data-desc">{{ $data->description }}</div>
                        <div class="hidden modal-data-full-img">
                            {{ Storage::url($data->image) }}
                        </div>
                    </div>
                    <div class="text-center">
                        <h3
                            class="font-bold text-base md:text-lg text-slate-800 leading-snug mb-3 group-hover:text-primary transition-colors line-clamp-2">
                            {{ $data->title }}
                        </h3>
                    </div>
                    <div class="flex items-center justify-between">
                        <div
                            class="inline-block bg-primary text-white text-xs md:text-sm font-semibold px-4 py-1.5 rounded-md shadow-md shadow-primary/20">
                            Admin</div>
                        <div class="flex items-center text-slate-400 text-xs md:text-sm font-medium">
                            <i data-lucide="calendar" class="w-4 h-4 mr-1.5"></i>
                            <span>{{ \Carbon\Carbon::parse($data->date)->locale('id')->IsoFormat('D MMMM YYYY') }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
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
