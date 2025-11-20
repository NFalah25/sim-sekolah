<form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    </ul>
</form>
<ul class="navbar-nav navbar-right">
    <li class="dropdown"><a href="#" data-toggle="dropdown"
            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{asset('assets/img/avatar/avatar-1.png')}}" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hai, {{ Auth::user()->name }}</div>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-divider"></div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none" hidden>
                @csrf
            </form>
            <a href="#" class="dropdown-item has-icon text-danger" id="logoutLink">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </li>
</ul>

<script>
    const logoutForm = document.getElementById('logout-form');
    const logoutLink = document.getElementById('logoutLink');

    logoutLink.addEventListener('click', function(event) {
        event.preventDefault();
        logoutForm.submit();
    });

</script>
