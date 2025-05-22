<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register - WangKu</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #1e1e1e;
      height: 100vh;
    }

    .container {
      display: flex;
      width: 100%;
      height: 100vh;
      background-color: #fff;
    }

    .left {
      width: 50%;
      background-color: white;
      padding: 4rem;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
      position: relative;
    }

    .left img.logo {
      position: absolute;
      top: 2rem;
      left: 2rem;
      height: 35px;
    }

    .left h2 {
      color: #f4a340;
      font-size: 2.2rem;
      font-weight: bold;
      margin-bottom: 1rem;
    }

    .left p {
      color: #333;
      font-size: 1.1rem;
      max-width: 320px;
      line-height: 1.5;
      margin-bottom: 2rem;
    }

    .btn-signin {
      padding: 0.7rem 2rem;
      background-color: #2da5f3;
      color: white;
      border: none;
      border-radius: 8px;
      font-weight: bold;
      font-size: 1rem;
      cursor: pointer;
      margin-bottom: 2rem;
    }

    .left img.maskot {
      width: 220px;
      position: absolute;
      bottom: 2rem;
      left: 4rem;
    }

    .right {
      width: 50%;
      background: linear-gradient(140deg, #5e8c94, #7ba4ab);
      color: white;
      padding: 4rem;
      display: flex;
      flex-direction: column;
      justify-content: center;
      position: relative;
      border-top-left-radius: 50% 100%;
      border-bottom-left-radius: 50% 100%;
    }

    .right h2 {
      font-size: 2rem;
      font-weight: bold;
      margin-bottom: 2rem;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 1.2rem;
    }

    form label {
      font-size: 1rem;
      margin-bottom: 0.3rem;
    }

    form input {
      padding: 0.8rem;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
    }

    form input::placeholder {
      color: #aaa;
    }

    form button {
      padding: 0.8rem;
      background-color: #f4a340;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: bold;
      cursor: pointer;
      margin-top: 1rem;
    }

    ul {
      padding-left: 1rem;
      color: #ffdddd;
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
        height: auto;
      }

      .left, .right {
        width: 100%;
        border-radius: 0;
      }

      .left img.maskot {
        position: static;
        margin-top: 2rem;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- KIRI -->
    <div class="left">
      <img src="/images/darklogoandfont.png" alt="Wangku" class="logo">
      <h2>Selamat datang !</h2>
      <p>Untuk tetap terhubung dengan kami, silakan login dengan info pribadi Anda</p>
      <a href="{{ route('signin') }}">
        <button class="btn-signin">Sign In</button>
      </a>
      <img src="/images/maskot1.png" alt="Maskot" class="maskot" />
    </div>

    <!-- KANAN -->
    <div class="right">
      <h2>Buat Akun</h2>
      @if ($errors->any())
        <div style="color: #ffdddd; margin-bottom: 1rem;">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <form method="POST" action="{{ route('signup.process') }}">
        @csrf
        <div>
          <label for="username">Username</label>
          <input id="username" type="text" name="username" placeholder="Masukkan Username" value="{{ old('username') }}" required />
        </div>
        <div>
          <label for="email">E-mail</label>
          <input id="email" type="email" name="email" placeholder="Masukkan E-mail" value="{{ old('email') }}" required />
        </div>
        <div>
          <label for="password">Password</label>
          <input id="password" type="password" name="password" placeholder="Masukkan Password" required />
        </div>
        <button type="submit">Sign Up</button>
      </form>
    </div>
  </div>
</body>
</html>
