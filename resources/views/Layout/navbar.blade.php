<nav
    class="navbar md:w-[calc(100%-18rem)] w-full h-16 top-0 z-10 md:ms-72 bg-primary flex justify-between items-center md:px-10 px-4 shadow-md fixed ">
    <div class="flex items-center gap-4">
        <button class="inline md:hidden" id="bars"><i class="fa-solid fa-bars"></i></button>
        <h1 class="text-xl font-bold text-white">{{$pageTitle}}</h1>
    </div>
    <div class="flex md:gap-4 gap-1 items-center">
        <div class="flex items-center gap-2 bg-third px-3 rounded-full py-1 hover:bg-secondary">
            <i class="fa-regular fa-user text-base text-gray-600"></i>
            <div class="text-base font-medium text-gray-800">Hi, {{auth()->user()->name}}</div>
        </div>
        <form action="{{route('logout')}}" method="post" hidden id="logoutForm">
            @csrf
        </form>
        <button class="hover:bg-red-50 p-2 rounded-lg" id="logoutBtn">
            <i class="fa-solid fa-right-from-bracket text-marker-red text-xl"></i>
        </button>
    </div>
</nav>

<script>
    const logoutBtn = document.getElementById('logoutBtn');
    const formLogout = document.getElementById('logoutForm');

    logoutBtn.addEventListener('click', function() {
        formLogout.submit();
    });

</script>
