<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
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
    overflow: hidden; /* 👉 Cegah scroll */
    font-family: 'Segoe UI', sans-serif;
  }

    .container {
      display: flex;
      height: 100vh;
    }

    .left {
    width: 50%;
background: linear-gradient(140deg, #5e8c94, #7ba4ab);
color: white;
padding: 4rem 6rem 4rem 4rem; /* kanan ditambah */
display: flex;
flex-direction: column;
justify-content: center;
align-items: center;
border-top-right-radius: 100% 100%;
border-bottom-right-radius: 100% 100%;
overflow: hidden;

    }

    .left img.logo {
      position: absolute;
      top: 2rem;
      left: 2rem;
      height: 35px;
    }

    .left h2 {
      font-size: 1.8rem;
      font-weight: bold;
      margin-bottom: 2rem;
    }

    form label {
  display: block;
  margin-bottom: 0.3rem;
  font-size: 0.95rem;
  color: white;
  font-weight: 500;
}

form input {
  width: 100%;
  padding: 0.8rem;
  margin-bottom: 1rem;
  border-radius: 10px;
  border: none;
  font-size: 1rem;
}

form button {
  padding: 0.6rem 1.2rem;
  background-color: #f4a340;
  color: white;
  border: none;
  border-radius: 8px;
  font-size: 1rem;
  font-weight: bold;
  cursor: pointer;
  display: inline-block;
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
  font-size: 1.25rem;      /* lebih besar dari sebelumnya */
  color: #333;
  line-height: 1.8;
  margin-top: -2rem;     /* naikkan sedikit ke atas */
  margin-bottom: 1.8rem;   /* beri jarak bawah */
  margin-left: -15px; 
}


.right a button {
  padding: 0.7rem 1.8rem;
  background-color: #2da5f3;
  color: white;
  border: none;
  border-radius: 8px;
  font-size: 1rem;
  font-weight: bold;
  cursor: pointer;
  transition: background-color 0.3s ease;
  margin-left: -13px; 
  margin-top: -1rem;
}

.right a button:hover {
  background-color: #1e90e0;
}

.right img.maskot {
  width: 280px;
  max-width: 100%;
  position: absolute;
  bottom: 2rem;
  right: 2rem;
}



    @media (max-width: 768px) {
      .container {
        flex-direction: column;
      }

      .left, .right {
        width: 100%;
        padding: 2rem;
      }

      .right img.maskot {
        width: 180px;
        margin-top: 1rem;
      }
    }
  </style>
</head>
<body>

  <div class="container">
    <!-- LEFT: Login form -->
    <div class="left">
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
        <div>
          <label for="email">E-mail</label>
          <input id="email" type="email" name="email" placeholder="" value="{{ old('email') }}" required />
        </div>
        <div>
          <label for="password">Password</label>
          <input id="password" type="password" name="password" placeholder="" required />
        </div>
        <button type="submit">Sign In </button>
      </form>
    </div>

    <!-- RIGHT: Greeting and maskot -->
    <div class="right">
  <div class="text">
    <h2>Halo Kawan !</h2>
    <p>Masukkan detail pribadi Anda dan <br> mulailah perjalanan bersama kami</p>

    <a href="{{ route('signup') }}"><button>Sign Up</button></a>
  </div>
  <img src="/images/maskot1.png" alt="Maskot" class="maskot" style="position: absolute; bottom: -250px; left: 70%; transform: translateX(-50%); width: 720px; max-width: none;">

</div>


</body>
</html>
