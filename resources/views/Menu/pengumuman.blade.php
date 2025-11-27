@extends('Layout.app')

@section('content')
    <div class="bg-white border-b mt-4 border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
            <p class="text-sm text-gray-500">
                <a href="{{route('home')}}" class="hover:text-primary">Beranda</a>
                <span class="mx-2 text-secondary">/</span>
                <span class="font-semibold text-gray-800">Ekstrakurikuler</span>
            </p>
        </div>
    </div>
    <main class="flex-grow w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-10 pt-2">

        <div class="mb-10">
            <div class="flex flex-col md:flex-row justify-between items-end gap-4 border-b border-gray-200 pb-6">
                <div>
                    <h1 class="text-3xl font-extrabold text-slate-900">Arsip Informasi</h1>
                    <p class="text-slate-500 mt-2">Semua pengumuman sekolah dan jadwal kegiatan akademik/non-akademik.</p>
                </div>

                <div class="flex gap-3 w-full md:w-auto relative">
                    <div class="relative flex-grow md:w-64">
                        <input type="text" id="searchInput" placeholder="Cari info..." value="{{ request('q') }}"
                            class="w-full pl-10 pr-4 py-2 bg-white border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all shadow-sm">
                        <i data-lucide="search" class="absolute left-3 top-2.5 h-4 w-4 text-slate-400"></i>
                    </div>

                    <div class="relative">
                        <button id="filterBtn" onclick="toggleFilter()"
                            class="flex items-center gap-2 bg-white border border-gray-200 px-4 py-2 rounded-lg text-sm font-medium text-slate-600 hover:bg-primary hover:text-white hover:border-primary transition-colors shadow-sm">
                            <i data-lucide="filter" class="w-4 h-4"></i>
                            Filter
                        </button>

                        <div id="filter-dropdown"
                            class="hidden absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-gray-100 z-50 p-2">

                            <div class="px-3 py-2 border-b border-gray-50">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Tampilkan</span>
                            </div>
                            <label class="flex items-center px-3 py-2 hover:bg-gray-50 rounded-lg cursor-pointer">
                                <input type="radio" name="filterType" value="all"
                                    {{ request('type') == 'all' || !request('type') ? 'checked' : '' }}
                                    class="w-4 h-4 text-primary border-gray-300 focus:ring-primary"
                                    onchange="handleFilterChange()">
                                <span class="ml-2 text-sm text-slate-700">Semua</span>
                            </label>
                            <label class="flex items-center px-3 py-2 hover:bg-gray-50 rounded-lg cursor-pointer">
                                <input type="radio" name="filterType" value="pengumuman"
                                    {{ request('type') == 'pengumuman' ? 'checked' : '' }}
                                    class="w-4 h-4 text-primary border-gray-300 focus:ring-primary"
                                    onchange="handleFilterChange()">
                                <span class="ml-2 text-sm text-slate-700">Hanya Pengumuman</span>
                            </label>
                            <label class="flex items-center px-3 py-2 hover:bg-gray-50 rounded-lg cursor-pointer">
                                <input type="radio" name="filterType" value="agenda"
                                    {{ request('type') == 'agenda' ? 'checked' : '' }}
                                    class="w-4 h-4 text-primary border-gray-300 focus:ring-primary"
                                    onchange="handleFilterChange()">
                                <span class="ml-2 text-sm text-slate-700">Hanya Agenda</span>
                            </label>

                            <div class="px-3 py-2 border-b border-gray-50 mt-2">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Kategori</span>
                            </div>

                            @php
                                $currentCats = explode(',', request('category', ''));
                            @endphp
                            <label class="flex items-center px-3 py-2 hover:bg-gray-50 rounded-lg cursor-pointer">
                                <input type="checkbox" value="Akademik"
                                    {{ in_array('Akademik', $currentCats) ? 'checked' : '' }}
                                    class="category-filter w-4 h-4 text-primary rounded border-gray-300 focus:ring-primary"
                                    onchange="handleFilterChange()">
                                <span class="ml-2 text-sm text-slate-700">Akademik</span>
                            </label>
                            <label class="flex items-center px-3 py-2 hover:bg-gray-50 rounded-lg cursor-pointer">
                                <input type="checkbox" value="Kesiswaan"
                                    {{ in_array('Kesiswaan', $currentCats) ? 'checked' : '' }}
                                    class="category-filter w-4 h-4 text-primary rounded border-gray-300 focus:ring-primary"
                                    onchange="handleFilterChange()">
                                <span class="ml-2 text-sm text-slate-700">Kesiswaan</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @php
            $type = request('type', 'all');

            $announcementClass = 'lg:col-span-8';
            $agendaClass = 'lg:col-span-4';
            $announcementHidden = '';
            $agendaHidden = '';
            $agendaSticky = 'sticky top-24';

            if ($type === 'pengumuman') {
                $announcementClass = 'lg:col-span-12';
                $agendaClass = 'hidden';
                $agendaHidden = 'hidden';
            } elseif ($type === 'agenda') {
                $announcementClass = 'hidden';
                $announcementHidden = 'hidden';
                $agendaClass = 'lg:col-span-12';
                $agendaSticky = '';
            }
        @endphp

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

            <div id="announcement-column"
                class="{{ $announcementClass }} space-y-6 transition-all duration-300 {{ $announcementHidden }}">

                <div class="flex items-center gap-2 mb-2">
                    <i data-lucide="bell" class="w-5 h-5 text-primary"></i>
                    <h2 class="text-xl font-bold text-slate-800">Daftar Pengumuman</h2>
                </div>

                <div id="announcement-list" class="space-y-4">
                    @forelse ($announcements as $data)
                        <div
                            class="announcement-card bg-white p-6 rounded-xl shadow-sm border border-gray-100 cursor-pointer group relative overflow-hidden">
                            @if ($data->is_pinned)
                                <div
                                    class="absolute top-0 right-0 bg-secondary text-white px-3 py-1 rounded-bl-xl text-xs font-bold flex items-center gap-1">
                                    <i data-lucide="pin" class="w-3 h-3"></i> Penting
                                </div>
                            @endif

                            <div class="flex flex-col md:flex-row md:items-center gap-4 mb-3">
                                @php
                                    $badgeColor = match ($data->category) {
                                        'akademik' => 'bg-blue-100 text-blue-600',
                                        'kesiswaan' => 'bg-purple-100 text-purple-600',
                                        'umum' => 'bg-green-100 text-green-600',
                                        default => 'bg-gray-100 text-gray-600',
                                    };
                                @endphp
                                <span
                                    class="inline-block px-3 py-1 capitalize rounded-full {{ $badgeColor }} text-xs font-bold category-badge">
                                    {{ $data->category }}
                                </span>
                                <span class="text-slate-400 text-xs flex items-center">
                                    <i data-lucide="calendar" class="w-3 h-3 mr-1"></i>
                                    {{ \Carbon\Carbon::parse($data->date_published)->translatedFormat('d F Y') }}
                                </span>
                            </div>
                            <h3 class="text-xl font-bold text-slate-800 mb-2 group-hover:text-primary transition-colors">
                                {{ $data->title }}
                            </h3>
                            <p class="text-slate-600 text-sm leading-relaxed">
                                {{ Str::limit(strip_tags($data->description), 150) }}
                            </p>
                        </div>
                    @empty
                        @if ($type !== 'agenda')
                            <div class="text-center py-12 bg-white rounded-xl border border-dashed border-gray-300">
                                <p class="text-slate-400">Tidak ada pengumuman ditemukan.</p>
                            </div>
                        @endif
                    @endforelse
                </div>

                <div class="pt-8 flex justify-center">
                    @if ($announcements instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        {{ $announcements->links('vendor.pagination.tailwind') }}
                    @endif
                </div>
            </div>

            <div id="agenda-column" class="{{ $agendaClass }} transition-all duration-300 {{ $agendaHidden }}">
                <div class="{{ $agendaSticky }} space-y-8">

                    <div class="flex items-center gap-2 pb-2 border-b border-gray-200">
                        <i data-lucide="calendar-days" class="w-5 h-5 text-secondary"></i>
                        <h2 class="text-xl font-bold text-slate-800">Agenda Mendatang</h2>
                    </div>

                    <div id="agenda-list" class="space-y-4">
                        @forelse ($events as $data)
                            <div
                                class="agenda-item flex gap-4 group cursor-pointer bg-white p-3 rounded-xl hover:bg-primary/5 transition-colors">
                                <div
                                    class="date-box bg-darkbox text-white rounded-xl w-16 h-16 flex flex-col items-center justify-center flex-shrink-0 shadow-lg transition-transform duration-300">
                                    <span class="text-[10px] uppercase font-bold tracking-wider text-secondary">
                                        {{ \Carbon\Carbon::parse($data->event_date)->translatedFormat('M') }}
                                    </span>
                                    <span class="text-2xl font-bold leading-none">
                                        {{ \Carbon\Carbon::parse($data->event_date)->format('d') }}
                                    </span>
                                </div>
                                <div>
                                    <span
                                        class="text-[10px] font-bold text-primary bg-primary/10 px-2 py-0.5 rounded mb-1 inline-block">
                                        {{ $data->time_label ?? '08:00 WIB' }}
                                    </span>
                                    <h3
                                        class="text-sm font-bold text-slate-800 leading-snug group-hover:text-primary transition-colors">
                                        {{ $data->title }}
                                    </h3>
                                    <p class="text-xs text-slate-500 mt-1 flex items-center gap-1">
                                        <i data-lucide="map-pin" class="w-3 h-3"></i> {{ $data->location }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            @if ($type !== 'pengumuman')
                                <div class="text-center py-4 text-slate-400 text-sm">Belum ada agenda.</div>
                            @endif
                        @endforelse

                        <div class="flex justify-center pt-4 scale-90 origin-top">
                            @if ($events instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                {{ $events->links('vendor.pagination.simple-tailwind') }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection

@push('styles')
    <style>
        .announcement-card:hover {
            transform: translateX(5px);
            border-left: 4px solid #3396D3;
        }

        .agenda-item:hover .date-box {
            background-color: #3396D3;
            transform: scale(1.05);
        }
    </style>
@endpush

@push('scripts')
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();

        const searchInput = document.getElementById('searchInput');
        const dropdown = document.getElementById('filter-dropdown');

        function toggleFilter() {
            dropdown.classList.toggle('hidden');
        }

        window.addEventListener('click', function(e) {
            if (!document.getElementById('filterBtn').contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });

        let timeout = null;

        function applyFilter() {
            const query = searchInput.value;
            const filterType = document.querySelector('input[name="filterType"]:checked').value;

            const checkedCategories = Array.from(document.querySelectorAll('.category-filter:checked')).map(cb => cb.value);

            const url = new URL(window.location.href);

            if (query) url.searchParams.set('q', query);
            else url.searchParams.delete('q');

            if (filterType && filterType !== 'all') url.searchParams.set('type', filterType);
            else url.searchParams.delete('type');

            if (checkedCategories.length > 0) {
                url.searchParams.set('category', checkedCategories.join(','));
            } else {
                url.searchParams.delete('category');
            }

            url.searchParams.delete('page_announcement');
            url.searchParams.delete('page_event');

            window.location.href = url.toString();
        }

        searchInput.addEventListener('input', () => {
            clearTimeout(timeout);
            timeout = setTimeout(applyFilter, 800);
        });

        function handleFilterChange() {
            clearTimeout(timeout);
            timeout = setTimeout(applyFilter, 500);
        }
    </script>
@endpush
