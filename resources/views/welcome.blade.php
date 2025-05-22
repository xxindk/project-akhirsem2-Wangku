<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Wangku - Kelola Keuangan Pribadi</title>
    <style>
        /* Reset dan base */
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: url('/backgroundhalaman1.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            height: 100vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        /* Overlay gelap agar tulisan mudah dibaca */
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
            background: transparent;
        }
        header img {
            height: 40px;
            display: block;
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

        button {
            padding: 0.8rem 1.8rem;
            font-size: 1.1rem;
            cursor: pointer;
            border-radius: 6px;
            border: none;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .btn-signup {
            background-color: #28a745;
            color: white;
        }
        .btn-signup:hover {
            background-color: #218838;
        }

        .btn-signin {
            background: transparent;
            color: #0d6efd;
            font-weight: 700;
            border: 2px solid #0d6efd;
        }
        .btn-signin:hover {
            background: #0d6efd;
            color: white;
        }

        .btn-container img {
            height: 22px;
            filter: brightness(100%);
        }

        footer {
            position: fixed;
            bottom: 1rem;
            left: 3rem;
            display: flex;
            gap: 1.2rem;
            z-index: 10;
        }

        .icon {
            width: 26px;
            height: 26px;
            filter: brightness(100%);
            transition: filter 0.3s ease;
        }

        .icon:hover {
            filter: brightness(70%);
        }

        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <header>
        <img src="/darklogoandfont.png" alt="Logo Wangku" />
    </header>

    <main>
        <div class="left">
            <h1>Wangku</h1>
            <div class="subjudul">Kelola keuangan pribadi dengan mudah</div>
            <div class="deskripsi">
                Wangku membantu Anda mencatat pemasukan, pengeluaran, utang-piutang, dan target tabungan.
            </div>
            <div class="btn-container">
                <a href="{{ route('signup') }}">
                    <button class="btn-signup">
                        <img src="/signup.png" alt="Sign Up" />
                        Sign Up
                    </button>
                </a>
                <a href="{{ route('signin') }}">
                    <button class="btn-signin">
                        <img src="/signin.png" alt="Sign In" />
                        Sign In
                    </button>
                </a>
            </div>
        </div>
    </main>

    <footer>
        <a href="https://instagram.com" target="_blank"><img src="/icon-instagram.svg" alt="Instagram" class="icon" /></a>
        <a href="https://youtube.com" target="_blank"><img src="/icon-youtube.svg" alt="YouTube" class="icon" /></a>
        <a href="mailto:contact@wangku.com"><img src="/icon-email.svg" alt="Email" class="icon" /></a>
        <a href="https://linkedin.com" target="_blank"><img src="/icon-linkedin.svg" alt="LinkedIn" class="icon" /></a>
    </footer>
</body>
</html>
