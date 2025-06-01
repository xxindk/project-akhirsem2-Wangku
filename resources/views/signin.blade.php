<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign In - WangKu</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    html, body {
      height: 100%;
      overflow: hidden;
      font-family: 'Poppins', sans-serif;
    }

    .container {
      display: flex;
      height: 100vh;
    }

    .left {
      width: 50%;
      background: linear-gradient(140deg, #5e8c94, #7ba4ab);
      color: white;
      padding: 4rem 6rem 4rem 4rem;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      border-top-right-radius: 100% 100%;
      border-bottom-right-radius: 100% 100%;
      overflow: hidden;
      opacity: 0;
      transform: translateX(-100%);
    }

    .left.animate-slide-in {
      animation: slide-in-left 0.8s ease-out forwards;
    }

    @keyframes slide-in-left {
      0% {
        opacity: 0;
        transform: translateX(-100%);
      }
      100% {
        opacity: 1;
        transform: translateX(0);
      }
    }

    .left img.logo {
      position: absolute;
      top: 2rem;
      left: 2rem;
      height: 35px;
    }

    .left h2 {
      font-size: 2.5rem;
      font-weight: bold;
      margin-bottom: 2rem;
    }

    form label {
      font-size: 0.95rem;
      color: white;
      font-weight: 500;
      display: block;
      margin-bottom: 0.3rem;
    }

    form input {
      width: 100%;
      padding: 0.8rem;
      margin-bottom: 1rem;
      border-radius: 8px;
      border: none;
      font-size: 1rem;
    }

    form button {
      padding: 0.7rem 1.8rem;
      background-color: #f4a340;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: bold;
      cursor: pointer;
    }

    .right {
      width: 50%;
      background-color: white;
      padding: 3rem 4rem;
      display: flex;
      flex-direction: column;
      justify-content: center;
      position: relative;
    }

    .right .text {
      text-align: left;
      margin-bottom: 2rem;
      max-width: 380px;
    }

    .right h2 {
      color: #f4a340;
      font-size: 3rem;
      font-weight: bold;
      margin-bottom: 2rem;
      margin-top: -2rem;
      margin-left: -17px;
    }

    .right p {
      font-size: 1.25rem;
      color: #333;
      line-height: 1.8;
      margin-top: -2rem;
      margin-bottom: 1.8rem;
      margin-left: -15px;
    }

    .right a div {
      padding: 0.7rem 1.8rem;
      background-color: #2da5f3;
      color: white;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: bold;
      text-align: center;
      width: fit-content;
      cursor: pointer;
      transition: background-color 0.3s ease;
      margin-left: -13px;
      margin-top: -1rem;
    }

    .right img.maskot {
      width: 720px;
      position: absolute;
      bottom: -300px;
      left: 80%;
      transform: translateX(-50%);
      pointer-events: none;
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
      }

      .left, .right {
        width: 100%;
        padding: 2rem;
        border-radius: 0;
      }

      .right img.maskot {
        width: 180px;
        margin-top: 1rem;
      }
    }

    /* TRANSISI LINGKARAN */
    .circle-transition {
      position: fixed;
      top: 50%;
      left: 0;
      width: 1700px;
      height: 1000px;
      background-color: #5e8c94;
      border-radius: 0 100% 100% 0;
      transform: translate(-100%, -50%);
      transition: transform 0.8s ease-in-out;
      z-index: 9999;
      pointer-events: none;
    }

    .circle-transition.expand-right {
      transform: translate(0, -50%);
    }
  </style>
</head>
<body>
  <div class="circle-transition" id="circle-transition"></div>

  <div class="container" id="page">
    <div class="left" id="left-panel">
      <img src="/images/lightlogoandfont.png" alt="Wangku Logo" class="logo" />
      <h2>Sign in ke Website</h2>

      @if ($errors->any())
        <div style="color: #ffdddd; margin-bottom: 1rem;">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('signin.process') }}">
        @csrf
        <label for="email">E-mail</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required />

        <label for="password">Password</label>
        <input id="password" type="password" name="password" required />

        <button type="submit">Sign In</button>
      </form>
    </div>

    <div class="right">
      <div class="text">
        <h2>Halo Kawan !</h2>
        <p>Masukkan detail pribadi Anda dan <br> mulailah perjalanan bersama kami</p>
        <a href="{{ route('signup') }}" style="text-decoration: none;">
          <div>Sign Up</div>
        </a>
      </div>
      <img src="/images/maskot1.png" alt="Maskot" class="maskot">
    </div>
  </div>

  <script>
    // Jalankan animasi slide-in saat halaman dimuat
    window.addEventListener('DOMContentLoaded', () => {
      document.getElementById('left-panel').classList.add('animate-slide-in');
    });

    // Transisi lingkaran kanan saat klik Sign Up
    document.querySelector('a[href*="{{ route('signup') }}"]').addEventListener('click', function(e) {
      e.preventDefault();
      const circle = document.getElementById('circle-transition');
      circle.classList.add('expand-right');
      setTimeout(() => {
        window.location.href = this.getAttribute('href');
      }, 800);
    });
  </script>
</body>
</html>
