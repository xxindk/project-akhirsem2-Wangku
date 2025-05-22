<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sign In - Wangku</title>
    <style>
        body { margin: 0; font-family: Arial, sans-serif; display: flex; height: 100vh; }
        header { position: fixed; top: 1rem; left: 1rem; font-weight: bold; font-size: 1.5rem; display: flex; align-items: center; gap: 0.5rem; }
        header img { height: 30px; }
        .container { margin: auto; display: flex; width: 900px; border: 1px solid #ccc; border-radius: 10px; overflow: hidden; box-shadow: 0 0 10px #ccc; }
        .left, .right { flex: 1; padding: 3rem; }
        .right { background: #f5f5f5; }
        h2 { margin-top: 0; }
        form input {
            width: 100%; padding: 0.8rem; margin: 0.5rem 0 1rem 0; border-radius: 5px; border: 1px solid #ccc;
        }
        form button {
            width: 100%; padding: 0.8rem; background-color: #007bff; color: white; border: none; border-radius: 5px;
            font-size: 1rem; cursor: pointer;
        }
        .btn-link {
            margin-top: 1rem; background: none; border: none; color: #28a745; cursor: pointer; font-weight: bold;
        }
    </style>
</head>
<body>
    <header>
        <img src="/logo-wangku.png" alt="Logo Wangku" />
        <span>Wangku</span>
    </header>

    <div class="container">
        <div class="left">
            <h2>Sign In</h2>
            @if ($errors->any())
                <div style="color: red; margin-bottom: 1rem;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('signin.process') }}">
                @csrf
                <input type="email" name="email" placeholder="E-mail" value="{{ old('email') }}" required />
                <input type="password" name="password" placeholder="Password" required />
                <button type="submit">Masuk</button>
            </form>
        </div>
        <div class="right">
            <h2>Selamat datang!</h2>
            <p>Kelola keuangan pribadimu dengan Wangku. Jika belum punya akun, buat akun baru sekarang!</p>
            <a href="{{ route('signup') }}"><button class="btn-link">Buat Akun</button></a>
        </div>
    </div>
</body>
</html>
