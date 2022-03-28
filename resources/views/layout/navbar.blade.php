<nav class="navbar navbar-expand-lg navbar-dark bg-success mb-5">
    <div class="container-fluid">
        <a class="navbar-brand" href="/"><i class="fa-solid fa-book-atlas"></i> Pengaduan Masyarakat</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Dashboard</a>
                </li>
                @if(isset($user) && $user->role === 'EMPLOYEE')
                <li class="nav-item">
                    <a class="nav-link" href="/employee-reports">Pengaduan</a>
                </li>
                @endif
                @if(isset($user) && $user->role === 'ADMIN')
                <li class="nav-item">
                    <a class="nav-link" href="/registration">Akun Petugas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/generate-report">Laporan</a>
                </li>
                @endif
            </ul>
        </div>
        @if(isset($user))
        <form class="d-flex">
            <a href="/logout" class="btn btn-danger my-2 my-sm-0"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
        </form>
        @else
        <form class="d-flex">
            <button type="button" class="btn btn-dark my-2 my-sm-0" id="show-login-modal"><i class="fa-solid fa-right-to-bracket"></i> Login</button>
        </form>
        @endif
    </div>
</nav>
