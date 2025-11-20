<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <script src="https://kit.fontawesome.com/d881b9b36f.js" crossorigin="anonymous"></script>

</head>

<body>
    <div class="bg-secondary w-full h-screen flex items-center justify-center">
        <div class="flex flex-col items-center justify-center md:w-2/4 lg:w-1/4 sm:w-1/2 w-3/4 bg-gray-100 py-8 px-8 rounded-lg shadow-lg">
            <div class="flex flex-col text-center mb-6">
                <h1 class="text-lg font-bold">Login</h1>
                <p>Selamat Datang di Sistem Informasi Sekolah</p>
            </div>
            <form class="w-full" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mt-4 w-full">
                    <label for="email" class="block mb-2 ms-2 text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" placeholder="Input your email here" value="{{old('email')}}"
                        class="text-sm px-4 py-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-4 w-full">
                    <label for="password" class="block mb-2 ms-2 text-sm font-medium text-gray-700">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" placeholder="Input your password here"
                            class="text-sm px-4 py-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button type="button" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500">
                            <i class="fas fa-eye-slash"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <label class="inline-flex items-center mt-4">
                        <input type="checkbox" class="h-4 w-4 text-[#EBCB90] rounded-lg" name="remember" id="remember">
                        <span class="ml-2 text-sm text-gray-700">Remember Me</span>
                    </label>
                </div>
                <div class="mt-6">
                    <button type="submit"
                        class="w-full bg-primary text-white py-2 rounded-md hover:bg-blue-500 transition duration-200">Login
                        Now</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        const togglePassword = document.querySelector('button');
        const passwordField = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.innerHTML = type === 'password' ? '<i class="fas fa-eye-slash"></i>' :
                '<i class="fas fa-eye"></i>';
        });
    </script>
</body>

</html>
