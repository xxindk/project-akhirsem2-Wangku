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
      position: relative;
      overflow:visible;
    }

    .left img.logo {
      top: 2rem;
      left: 2rem;
      height: 35px;
    }

    ..left h2 {
  color: #f4a340;
  font-size: 2.8rem; /* Diperbesar agar selaras dengan kanan */
  font-weight: bold;
  margin-bottom: 1.2rem;
  position: relative;
  z-index: 4;
  
}


    .left p {
  color: #333;
  font-size: 1.3rem;   /* Diperbesar */
  max-width: 380px;    /* Disesuaikan untuk menampung teks lebih besar */
  line-height: 1.8;    /* Agar rapi dan enak dibaca */
  margin-bottom: 2rem;
  position: relative;
  z-index: 4;
}

<div class="maskot-wrapper">
  <img src="/images/maskot1.png" alt="Maskot" class="maskot" />
</div>

.maskot-wrapper {
  position: relative;
  width: 100%;
  height: auto;
}

.left img.maskot {
    position: relative;
  width: 700px;
  bottom: -1000rem;
  left: 3rem;
  z-index: 1;
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
      position: relative;
      z-index: 4;
    }

    .left img.maskot {
  width: 700px;              /* Diperbesar */
  bottom: 1rem;              /* Lebih ke bawah */
  left: 3rem;
  z-index: 1;
}


    .right {
  width: 50%;
  background: linear-gradient(140deg, #5e8c94, #7ba4ab);
  color: white;
  padding:4rem 4rem 4rem 6rem; /* kiri ditambah */
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center; /* GANTI */
  border-top-left-radius: 100% 100%;
  border-bottom-left-radius: 100% 100%;
  overflow: hidden;
}


   .left h2 {
  color: #f4a340;
  font-size: 3.8rem;
  font-weight: bold;
  margin-bottom: 1.5rem;
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
  padding: 0.6rem 1.5rem;        /* ukuran tombol sedikit lebih kecil */
  background-color: #f4a340;
  color: white;
  border: none;
  border-radius: 8px;
  font-size: 1rem;
  font-weight: bold;
  cursor: pointer;
  margin-top: 1rem;

  display: block;                /* agar bisa diatur margin */
  margin-left: auto;            /* mendorong tombol ke kanan */
  margin-right: 0;              /* pastikan margin kanan nol */
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
        max-width: 220px
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
      <img src="/images/darklogoandfont.png" alt="Wangku" class="logo">
      <h2>Selamat datang !</h2>
      <p>Untuk tetap terhubung dengan kami, silakan login dengan info pribadi Anda</p>
      <a href="{{ route('signin') }}"> <button class="btn-signin">Sign In</button></a>
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
          <input id="username" type="text" name="username" placeholder="" value="{{ old('username') }}" required />
        </div>
        <div>
          <label for="email">E-mail</label>
          <input id="email" type="email" name="email" placeholder="" value="{{ old('email') }}" required />
        </div>
        <div>
          <label for="password">Password</label>
          <input id="password" type="password" name="password" placeholder="" required />
        </div>
        <button type="submit">Sign Up</button>
      </form>
    </div>
  </div>
</body>
</html>
