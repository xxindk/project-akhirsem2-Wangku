<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Wangku - Pengatur Keuangan Pribadi</title>

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .btn-white:hover {
    background-color: #e9e9e9 !important;
    border-color: #e9e9e9;
}

.btn-white:active,
.btn-white.show {
    background-color: #f0f0f0 !important;
    border-color: #f0f0f0 !important;
    box-shadow: none !important;
    outline: none !important;
}
    </style>
</head>
<body class="p-0 m-0 bg-white">

    <div class="container-fluid p-0">
<nav class="d-flex align-items-center px-3 py-2 sticky-top" style="background: transparent;">
            {{-- Logo --}}
            <a href="#" class="me-auto">
                <img src="{{ asset('images/darklogoandfont.png') }}" alt="logo" style="max-height: 40px;">
            </a>

            {{-- Hello User --}}
            <span class="fw-semibold me-3 text-dark">Hello, User!</span>

            {{-- Akun Dropdown --}}
            <div class="dropdown">
                <a class="btn btn-white d-flex align-items-center p-2 me-2" href="#" role="button" data-bs-toggle="dropdown">
                    <i class="bi bi-person-fill fs-5"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                    <li>
                        <a class="dropdown-item d-flex align-items-center " href="#">
                            <i class="bi bi-person-circle fs-1 text-secondary me-2"></i>
                            <div class="d-flex flex-column">
                                <small class="text-muted">Your Account</small>
                                <span class="text-truncate fw-semibold" style="max-width: 180px;">{{ Auth::user()->email ?? 'user@gmail.com' }}</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center text-danger" href="{{ url('/logout') }}">
                            <i class="bi bi-box-arrow-right me-2 "></i>
                            Logout
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Menu Dropdown --}}
            <div class="dropdown ms-2 ">
                <a class="btn btn-white d-flex align-items-center p-2 " href="#" role="button" data-bs-toggle="dropdown">
                    <i class="bi bi-list fs-5"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                    <li><a class="dropdown-item py-2 fw-semibold" href="{{ route('home') }}">Halaman Utama</a></li>
                    <li><a class="dropdown-item py-2 fw-semibold" href="journal">Jurnal Pengeluaran dan Pemasukan</a></li>
                    <li><a class="dropdown-item py-2 fw-semibold" href="{{ route('reminders.index') }}">Pengingat Keuangan</a></li>
                    <li><a class="dropdown-item py-2 fw-semibold" href="{{ route('utang-piutang.index') }}">Catatan Utang-Piutang</a></li>
                    <li><a class="dropdown-item py-2 fw-semibold" href="#">Jurnal Keuangan Bulanan</a></li>
                    <li><a class="dropdown-item py-2 fw-semibold" href="#">Target Wangku</a></li>
                </ul>
            </div>
        </nav>
    </div>

    <main class="container mt-3">
        @yield('content')
        
    </main>
    {{-- Footer --}}
<footer class="bg-white  ">

    {{-- Elemen Gambar Hiasan --}}
  <img src="{{ asset('images/hiasanbawahhome.png') }}" alt="Hiasan Footer"
         class="w-100 mt-5" style="max-height: 150px; object-fit: cover;">
</footer>


    {{-- Bootstrap Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    @stack('scripts')
</body>
</html>
