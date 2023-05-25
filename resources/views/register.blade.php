<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>SIPDEh</title>
</head>
<body>
    <header>
        <nav></nav>
    </header>
    <main class="content">
        <div class="card">
            <form>
                <h2 class="my-3">Selamat Datang !</h2>
                <h4 class="mb-3">Buat Akun</h4>
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="inputNIK" class="form-label">NIK</label>
                    <input type="tel" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Status</label>
                    <select class="form-select" id="inputGroupSelect01">
                      <option selected value="1">Warga</option>
                      <option value="2">Bukan Warga</option>
                    </select>
                  </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <button type="submit" class="btn text-bg-dark border-0 d-grid col-6 mx-auto">Registrasi</button>
                <div class="mt-5">
                    <p>Sudah memiliki akun? <a class="text-link" href="/login">Login</a></p>
                </div>
            </form>
        </div>
        <div>
            <img src="./images/login-hero.png" alt="login-hero" style="height: 500px">
        </div>
    </main>
    <footer>

    </footer>
</body>
</html>
