<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Wangku - Kelola Keuangan Pribadi</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: url('/images/backgroundhalaman1.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            height: 100vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            z-index: 0;
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            z-index: 10;
        }

        header img {
            height: 40px;
        }

        main {
            flex: 1;
            display: flex;
            align-items: center;
            padding-left: 4rem;
            z-index: 1;
            position: relative;
        }

        .left {
            max-width: 500px;
            text-shadow: 1px 1px 6px rgba(0, 0, 0, 0.9);
        }

        h1 {
            font-size: 4rem;
            margin: 0;
            font-weight: 700;
        }

        .subjudul {
            font-size: 1.8rem;
            margin-top: 0.5rem;
            color: #ddd;
        }

        .deskripsi {
            margin-top: 1rem;
            font-size: 1.2rem;
            color: #ccc;
            line-height: 1.5;
        }

        .btn-container {
            margin-top: 2.5rem;
            display: flex;
            gap: 1.2rem;
            align-items: center;
        }

        .btn-signup {
            background-color: rgb(167, 118, 40);
            color: white;
        }

        .btn-signup:hover {
            background-color: white;
            color: black;
        }

        .btn-signin {
            background-color: white;
            color: black;
        }

        .btn-signin:hover {
            background-color:rgb(167, 118, 40);
            color: white;
        }

        footer {
            position: fixed;
            bottom: 1rem;
            left: 3rem;
            display: flex;
            gap: 1.2rem;
            z-index: 10;
            font-size: 1.5rem;
        }

        footer a {
            color: white;
        }

        footer a:hover {
            color: #aaa;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <header>
        <img src="/images/lightlogoandfont.png" alt="Logo Wangku" />
    </header>

    <main>
        <div class="left">
            <h1>Wangku</h1>
            <div class="subjudul">Kelola keuanganmu, capai mimpimu</div>
            <div class="deskripsi">
                Wangku membantu Anda mencatat, mengingat, dan melacak keuangan pribadi Anda—dari pendapatan hingga utang-piutang. Semuanya di satu tempat.
            </div>
            <div class="btn-container">
                <a href="{{ route('signup') }}">
                    <button class="btn btn-signup fw-semibold">
                        <i class="bi bi-person-plus-fill me-1"></i> Sign Up
                    </button>
                </a>
                <a href="{{ route('login') }}">
                    <button class="btn btn-signin fw-semibold">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Sign In
                    </button>
                </a>
            </div>
        </div>
    </main>

    <footer>
        <a href="https://instagram.com" target="_blank"><i class="bi bi-instagram"></i></a>
        <a href="https://youtube.com" target="_blank"><i class="bi bi-youtube"></i></a>
        <a href="mailto:contact@wangku.com"><i class="bi bi-envelope-fill"></i></a>
        <a href="https://linkedin.com" target="_blank"><i class="bi bi-linkedin"></i></a>
    </footer>
</body>
</html>
