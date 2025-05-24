<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
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
      font-family: 'Segoe UI', sans-serif;
      overflow: hidden;
    }

    .container {
      display: flex;
      width: 100%;
      height: 100vh;
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
      left: 2rem;
      height: 35px;
    }

    .left img.maskot {
      position: relative;
      width: 700px;
      bottom: 1rem;
      left: 3rem;
      z-index: 1;
    }

    .btn-signin {
      display: none; /* disembunyikan karena teks/sign-in dihapus */
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
    }

    .right h2 {
      font-size: 1.8rem;
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
      display: block;
      margin-bottom: 0.3rem;
      font-size: 0.9rem;
      font-weight: 500;
      color: white;
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

    .right input::placeholder {
      color: #aaa;
    }

    .right button {
      padding: 0.6rem 1.5rem;
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
  </style>
</head>
<body>
  <div class="container">
    <!-- KIRI -->
   <div class="left">
  <div class="w-100 d-flex justify-content-start align-items-start">
    <img src="/images/darklogoandfont.png" alt="Logo WangKu" class="logo" style="position: absolute; top: 30px; left: 30px; height: 35px;">
  </div>

  <div style="margin-top: -80px; max-width: 420px;">
    <h2 style="color: #f4a340; font-size: 40px; font-weight: bold; margin-bottom: 20px;">Selamat datang !</h2>
    <p style="margin-bottom: 28px; font-size: 18px; color: #333;">
  Untuk tetap terhubung dengan kami,<br>
  silakan login dengan info pribadi Anda
</p>


    <a href="{{ route('signin') }}" 
       class="btn" 
       style="background-color: #339af0; color: white; font-weight: bold; padding: 12px 28px; border-radius: 8px; text-decoration: none; font-size: 16px;">
       Sign In
       
    </a>
  </div>

  <img src="/images/maskot1.png" alt="Maskot" class="maskot" style="position: absolute; bottom: -250px; left: 40%; transform: translateX(-50%); width: 720px;">
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
</body>
</html>
