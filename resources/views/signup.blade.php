<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register - WangKu</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body, html {
      height: 100%;
      font-family: 'Poppins', sans-serif;
      overflow: hidden;
    }

    .container {
      display: flex;
      width: 100%;
      height: 100vh;
      transition: transform 0.6s ease-in-out;
    }

    .left {
      width: 50%;
      background-color: white;
      padding: 4rem;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
    }

    .left img.logo {
      top: 2rem;
      left: 6rem;
      height: 35px;
    }

    .left img.maskot {
      position: relative;
      width: 700px;
      bottom: 1rem;
      left: 10%;
      z-index: 1;
    }

    .btn-signin {
      display: none;
    }

    .right {
      width: 50%;
      background: linear-gradient(140deg, #5e8c94, #7ba4ab);
      color: white;
      padding: 4rem 4rem 4rem 6rem;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      border-top-left-radius: 100% 100%;
      border-bottom-left-radius: 100% 100%;
      overflow: hidden;
      opacity: 0;
      transform: translateX(100%);
    }

    .right h2 {
      font-size: 2.5rem;
      font-weight: bold;
      margin-bottom: 2rem;
      padding-left: 1rem;
    }

    .right form {
      display: flex;
      flex-direction: column;
      gap: 1.2rem;
      width: 100%;
      max-width: 320px;
    }

    .right label {
      font-size: 0.95rem;
      font-weight: 500;
      color: white;
      margin-bottom: 0.3rem;
      display: block;
    }

    .right input {
      padding: 0.8rem;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      color: #333;
      background-color: white;
      width: 100%;
    }

    .right button {
      padding: 0.7rem 1.8rem;
      background-color: #f4a340;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: bold;
      cursor: pointer;
      margin-top: 1rem;
      display: block;
      margin-left: auto;
      margin-right: 0;
    }

    ul {
      padding-left: 1rem;
      color: #ffdddd;
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
      }

      .left, .right {
        width: 100%;
        border-radius: 0;
      }

      .left img.maskot {
        max-width: 220px;
        position: static;
        margin-top: 3rem;
      }

      .right {
        border-radius: 0;
      }
    }

    /* ANIMASI SLIDE IN UNTUK .right */
    @keyframes slide-in-right {
      0% {
        opacity: 0;
        transform: translateX(100%);
      }
      100% {
        opacity: 1;
        transform: translateX(0);
      }
    }

    .animate-slide-in {
      animation: slide-in-right 0.8s ease-out forwards;
      animation-delay: 0s; /* Sinkron dengan lingkaran expand */
    }

    /* TRANSISI LINGKARAN DARI KANAN KE KIRI */
    .circle-transition {
      position: fixed;
      top: 50%;
      right: 0;
      width: 1700px;
      height: 1000px;
      background-color: #5e8c94;
      border-radius: 100% 0 0 100%;
      transform: translate(100%, -50%);
      transition: transform 0.8s ease-in-out;
      z-index: 9999;
      pointer-events: none;
    }

    .circle-transition.expand-left {
      transform: translate(0, -50%);
    }
  </style>
</head>
<body>
  <div class="circle-transition" id="circle-transition"></div>

  <div class="container" id="page">
    <div class="left">
      <div class="w-100 d-flex justify-content-start align-items-start">
        <img src="/images/darklogoandfont.png" alt="Logo WangKu" class="logo" style="position: absolute; top: 30px; left: 30px;">
      </div>

      <div style="margin-top: -100px; max-width: 420px;">
        <h2 style="color: #f4a340; font-size: 45px; font-weight: bold; margin-bottom: 20px;">Selamat datang !</h2>
        <p style="margin-bottom: 50px; font-size: 1.25rem; color: #333;">
          Untuk tetap terhubung dengan kami,<br>
          silakan login dengan info pribadi Anda
        </p>

 <a href="{{ route('login') }}"
   class="btn"
   style="background-color: #339af0; color: white; font-weight: bold; padding: 12px 28px; border-radius: 8px; text-decoration: none; font-size: 16px; position: relative; top: -30px;">
   Sign In
</a>


      </div>

<img src="/images/maskot1.png" alt="Maskot" class="maskot" style="position: absolute; bottom: -250px; left: 30%; transform: translateX(-30%); width: 720px;">
    </div>

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
          <input id="username" type="text" name="username" value="{{ old('username') }}" required />
        </div>
        <div>
          <label for="email">E-mail</label>
          <input id="email" type="email" name="email" value="{{ old('email') }}" required />
        </div>
        <div>
          <label for="password">Password</label>
          <input id="password" type="password" name="password" required />
        </div>
        <button type="submit">Sign Up</button>
      </form>
    </div>
  </div>

  <script>
    // Transisi lingkaran saat klik "Sign In"
    document.querySelector('a[href*="{{ route('login') }}"]').addEventListener('click', function(e) {
      e.preventDefault();
      const circle = document.getElementById('circle-transition');
      circle.classList.add('expand-left');
      setTimeout(() => {
        window.location.href = this.getAttribute('href');
      }, 800);
    });

    // Animasi slide-in untuk .right saat halaman dimuat
    window.addEventListener('DOMContentLoaded', () => {
      document.querySelector('.right').classList.add('animate-slide-in');
    });
  </script>
</body>
</html>
