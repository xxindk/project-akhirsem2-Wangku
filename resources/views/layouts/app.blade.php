<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Wangku - Pengatur Keuangan Pribadi</title>

    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #ffffff;
        }
        .nav-item, .nav-link, .dropdown {
            display: flex;
            align-items: center;
        }
        .nav-link i {
            font-size: 1.25rem;
        }
        .nav-link {
            padding-top: 1rem;
            padding-bottom: 1rem;
        }
        .dropdown-toggle::after {
            display: none !important; 
        }
    </style>
</head>
<body class="p-0 m-0">
<div class="container-fluid p-0">
    <ul class="nav nav-underline align-items-center px-3 sticky-top bg-white shadow-sm">
        <li class="nav-item">
            <a href="#" class="nav">
                <img src="{{ asset('images/darklogoandfont.png') }}" alt="logo" class="img-fluid" style="max-height: 40px;">
            </a>
        </li>
        <li class="nav-item ms-auto">
            <span class="nav text-dark">Hello, User!</span>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                <i class="bi bi-person-fill"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">Akun Saya</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="{{ url('/logout') }}">Logout</a></li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="bi bi-list"></i>
            </a>
        </li>
    </ul>
</div>

<main class="container mt-3">
    @yield('content')
</main>

{{-- Bootstrap Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@stack('scripts')
</body>
</html>
