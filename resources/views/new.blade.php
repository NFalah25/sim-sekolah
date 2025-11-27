<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Informasi Sekolah</title>

    <!-- Load Tailwind & Assets -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <!-- Fallback CDN jika Vite belum build -->
        <script src="https://cdn.tailwindcss.com"></script>
    @endif

    <!-- Font Awesome & Google Fonts -->
    <script src="https://kit.fontawesome.com/d881b9b36f.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom Config Colors -->

    <style>
        /* Custom Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .delay-100 {
            animation-delay: 0.1s;
        }

        .delay-200 {
            animation-delay: 0.2s;
        }

        .delay-300 {
            animation-delay: 0.3s;
        }
    </style>
</head>

<body class="bg-surface font-sans text-slate-800">

    <div class="min-h-screen flex w-full">

        <!-- Bagian Kiri: Branding & Gambar (Hidden di Mobile) -->
        <div
            class="hidden lg:flex w-1/2 bg-gradient-to-br from-primary to-primary-dark relative overflow-hidden items-center justify-center">
            <!-- Background Pattern/Image -->
            <img src="{{ asset('images/bg-2.jpg') }}" alt="School Background"
                class="absolute inset-0 w-full h-full object-cover opacity-40">

            <!-- Decorative Circles -->
            <div class="absolute top-[-10%] left-[-10%] w-64 h-64 bg-white opacity-10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-80 h-80 bg-secondary opacity-20 rounded-full blur-3xl">
            </div>

            <!-- Content Branding -->
            <div class="relative z-10 text-center px-12 animate-fade-up">
                <div
                    class="bg-white/10 backdrop-blur-sm p-6 rounded-2xl border border-white/20 shadow-2xl inline-block mb-6">
                    <img src="{{ asset('images/LOGO SEKOLAH.jpeg') }}" alt="Logo SD"
                        class="h-32 w-auto drop-shadow-md">
                </div>
                <h1 class="text-4xl font-bold text-white mb-2 tracking-tight">SD Negeri JuwetKenongo</h1>
                <p class="text-blue-100 text-lg font-light tracking-wide">Mewujudkan Generasi Cerdas & Berkarakter</p>
            </div>
        </div>

        <!-- Bagian Kanan: Form Login -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white relative">
            <div class="w-full max-w-md animate-fade-up delay-100">

                <!-- Logo di Mobile (Muncul hanya di layar kecil) -->
                <div class="lg:hidden text-center mb-8">
                    <img src="{{ asset('images/LOGO SEKOLAH.jpeg') }}" alt="Logo SD" class="h-20 w-auto mx-auto mb-3">
                    <h2 class="text-xl font-bold text-slate-800">SDN JuwetKenongo</h2>
                </div>

                <!-- Header Form -->
                <div class="mb-10">
                    <h2 class="text-3xl font-extrabold text-slate-900 mb-2">Selamat Datang! 👋</h2>
                    <p class="text-slate-500">Silakan masukkan akun Anda untuk melanjutkan.</p>
                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    <!-- Email Input -->
                    <div class="space-y-2">
                        <label for="email" class="text-sm font-semibold text-slate-700">Email Address</label>
                        <div class="relative">
                            <div
                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <input type="email" id="email" name="email" placeholder="nama@sekolah.sch.id"
                                value="{{ old('email') }}" required autofocus
                                class="w-full pl-10 pr-4 py-3 border border-slate-200 rounded-lg text-slate-700 focus:outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all duration-200 @error('email') border-red-500 focus:ring-red-100 @enderror">
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div class="space-y-2">
                        <div class="flex justify-between items-center">
                            <label for="password" class="text-sm font-semibold text-slate-700">Password</label>
                        </div>
                        <div class="relative">
                            <div
                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <i class="fas fa-lock"></i>
                            </div>
                            <input type="password" id="password" name="password" placeholder="••••••••" required
                                class="w-full pl-10 pr-12 py-3 border border-slate-200 rounded-lg text-slate-700 focus:outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all duration-200">

                            <!-- Toggle Button -->
                            <button type="button" id="togglePassword"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 transition-colors cursor-pointer focus:outline-none">
                                <i class="fas fa-eye-slash"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me & Action -->
                    <div class="flex items-center justify-between pt-2">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="remember" id="remember"
                                class="w-4 h-4 text-primary border-slate-300 rounded focus:ring-primary">
                            <span class="ml-2 text-sm text-slate-600">Ingat Saya</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full bg-primary text-white font-bold py-3.5 px-4 rounded-xl hover:bg-primary-dark focus:ring-4 focus:ring-primary/30 transition-all duration-300 shadow-lg shadow-primary/30 transform hover:-translate-y-0.5 active:translate-y-0">
                        Masuk Sekarang
                    </button>
                </form>

                <!-- Footer / Back to Home -->
                <div class="mt-8 text-center">
                    <p class="text-sm text-slate-500">
                        Kembali ke <a href="{{ url('/') }}" class="text-primary font-bold hover:underline">Halaman
                            Utama</a>
                    </p>
                </div>
            </div>

            <!-- Decor Bottom Right -->
            <div class="absolute bottom-0 right-0 w-32 h-32 bg-secondary/10 rounded-tl-full pointer-events-none"></div>
        </div>
    </div>

    <script>
        // Toggle Password Visibility Logic
        const togglePasswordBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const icon = togglePasswordBtn.querySelector('i');

        togglePasswordBtn.addEventListener('click', function() {
            // Toggle type attribute
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Toggle icon class
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>
