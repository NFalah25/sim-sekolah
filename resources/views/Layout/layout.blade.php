<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @section('title', 'SD Negeri JuwetKenongo')
    </title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    @stack('styles')
</head>

<body>
{{-- header --}}
@include('Layout.navbar')
@include('Layout.sidebar')

{{-- content --}}
@yield('content')

{{-- footer --}}
{{-- @include('Layout.footer') --}}

</body>
@stack('scripts')
<script src="https://kit.fontawesome.com/d881b9b36f.js" crossorigin="anonymous"></script>
<script>
    const bars = document.getElementById('bars');
    const sidebar = document.getElementById('sidebar');
    bars.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
        sidebar.classList.add('sidebar');
    });

    //     klik diluar sidebar untuk menutup sidebar
    document.addEventListener('click', function (event) {
        const isClickInside = sidebar.contains(event.target) || bars.contains(event.target);
        console.log(isClickInside);
        if (!isClickInside) {
            sidebar.classList.add('-translate-x-full');
        }
    });


</script>
</html>
