<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>SIPDEh</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('admin/assets/img/avatars/stamp.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('admin/assets/img/avatars/stamp.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin/assets/img/avatars/stamp.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('admin/assets/img/avatars/stamp.png') }}">
    <link rel="manifest" href="{{ asset('user/assets/img/favicons/manifest.json') }}">
    <meta name="msapplication-TileImage" content="{{ asset('admin/assets/img/avatars/stamp.png') }}">
    <meta name="theme-color" content="#ffffff">


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="{{ asset('user/assets/css/theme.css') }}" rel="stylesheet" />

    <style>
      details{
        background-color: rgb(255, 255, 255);
        color: #000000;
        font-size: 1.1rem;
      }

      summary {
        padding: .5em 1.3rem;
        list-style: none;
        display: flex;
        justify-content: space-between;  
        transition: height 1s ease;
      }

      summary::-webkit-details-marker {
        display: none;
      }

      summary:after{
        content: "\002B";
      }

      details[open] summary {
          border-bottom: 1px solid #aaa;
          margin-bottom: .5em;
      }

      details[open] summary:after{
        content: "\00D7";
      }

      details[open] div{
        padding: .5em 1em;
      }
    </style>
  </head>


  <body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
      <nav class="navbar navbar-expand-lg navbar-light sticky-top" data-navbar-on-scroll="data-navbar-on-scroll">
        <div class="container"><a class="navbar-brand" href="/"><img src="{{ asset('user/assets/img/logo.svg')}}" height="40" alt="logo" /></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"> </span></button>
          <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item"><a class="nav-link" aria-current="page" href="#home">Home</a></li>
              <li class="nav-item"><a class="nav-link" aria-current="page" href="#tentang">Tentang</a></li>
              <li class="nav-item"><a class="nav-link" aria-current="page" href="#fitur">Fitur</a></li>
              <li class="nav-item"><a class="nav-link" aria-current="page" href="#faq">FAQ</a></li>
              <li class="nav-item"><a class="nav-link" aria-current="page" href="#kontak">Kontak</a></li>
            </ul>
            <div class="d-flex ms-lg-4">
              <a class="btn btn-secondary-outline" href="/login">Masuk</a>
              <a class="btn btn-warning ms-3" href="/register">Register</a></div>
          </div>
        </div>
      </nav>
      <section class="pt-7" id="home">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-6 text-md-start text-center py-5">
              <h1 class="mb-4 fs-9 fw-bold">Sistem Informasi Pengajuan Dokumen Elektronik</h1>
              <p class="mb-6 lead text-secondary">Anda dapat dengan mudah melakukan proses pengajuan dokumen secara online, menjadikannya lebih efisien dan praktis.</p>
              <div class="text-center text-md-start"><a class="btn btn-warning me-3 btn-lg" href="/register" role="button">Coba Sekarang!</a></div>
            </div>
            <div class="col-md-6 text-end"><img class="pt-7 pt-md-0 img-fluid" src="{{ asset('user/assets/img/hero/hero-img.png') }}" alt="" /></div>
          </div>
        </div>
      </section>

      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="pt-10" id="tentang">

        <div class="container">
          <div class="row">
            <div class="col-lg-6"><img class="img-fluid" src="{{ asset('user/assets/img/manager/manager.png') }}" alt="" /></div>
            <div class="col-lg-6">
              <h5 class="text-secondary">Tentang</h5>
              <p class="fs-7 fw-bold mb-2">SIPDEh</p>
              <p class="mb-4 fw-medium text-secondary">
                Sistem Informasi Pengajuan Dokumen Elektronik Berbasis Website (SIPDEH) merupakan sebuah sistem informasi yang dapat membantu masyarakat Banjar Bekul atau masyarakat yang memiliki kepentingan untuk melakukan kegiatan di lingkungan Banjar Bekul dapat mengajukan dokumen dengan mudah.
              </p>
              <div class="d-flex align-items-center mb-3"> <img class="me-sm-4 me-2" src="{{ asset('user/assets/img/manager/tick.png') }}" width="35" alt="tick" />
                <p class="fw-medium mb-0 text-secondary"><span class="fw-bold">Cepat</span> (Pengajuan dokumen dapat dilakukan secara online)</p>
              </div>
              <div class="d-flex align-items-center mb-3"> <img class="me-sm-4 me-2" src="{{ asset('user/assets/img/manager/tick.png') }}" width="35" alt="tick" />
                <p class="fw-medium mb-0 text-secondary"><span class="fw-bold">Efisien</span> (Masyarakat tidak perlu datang ke kepala lingkungan)</p>
              </div>
              <div class="d-flex align-items-center mb-3"><img class="me-sm-4 me-2" src="{{ asset('user/assets/img/manager/tick.png') }}" width="35" alt="tick" />
                <p class="fw-medium mb-0 text-secondary"><span class="fw-bold">Efektif</span> (Masyarakat dapat dengan mudah untuk melakukan pengajuan dokumen)</p>
              </div>
            </div>
          </div>
        </div><!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->

      
      <!-- ============================================-->
      <!-- <section> begin ============================-->
        <section class="pt-5 pt-md-9" id="fitur">

          <div class="bg-holder z-index--1 bottom-0 d-none d-lg-block" style="background-image:url(./user/assets/img/category/shape.png); opacity:.5;">
          </div>
          <!--/.bg-holder-->
  
          <div class="container">
            <h5 class="text-secondary text-center mb-3">Fitur</h5>
            <h1 class="fs-9 fw-bold mb-4 text-center">Fitur yang Dapat Anda Gunakan</h1>
            <div class="row pt-3">
              <div class="col-lg-3 col-sm-6 mb-2"> <img class="mb-3 ms-n3" src="{{ asset('user/assets/img/category/icon1.png') }}" width="75" alt="Feature" />
                <h4 class="mb-3">Login & Register</h4>
                <p class="mb-0 fw-medium text-secondary">Masyarakat harus membuat akun untuk bisa menggunakan platform.</p>
              </div>
              <div class="col-lg-3 col-sm-6 mb-2"> <img class="mb-3 ms-n3" src="{{ asset('user/assets/img/category/icon2.png') }}" width="75" alt="Feature" />
                <h4 class="mb-3">Pengajuan Dokumen</h4>
                <p class="mb-0 fw-medium text-secondary">Masyarakat dapat mengajukan dokumen secara online.</p>
              </div>
              <div class="col-lg-3 col-sm-6 mb-2"> <img class="mb-3 ms-n3" src="{{ asset('user/assets/img/category/icon4.png') }}" width="75" alt="Feature" />
                <h4 class="mb-3">Status Dokumen</h4>
                <p class="mb-0 fw-medium text-secondary">Masyarakat dapat melihat status dokumen.</p>
              </div>
              <div class="col-lg-3 col-sm-6 mb-2"> <img class="mb-3 ms-n3" src="{{ asset('user/assets/img/category/icon3.png') }}" width="75" alt="Feature" />
                <h4 class="mb-3">Histori Pengajuan</h4>
                <p class="mb-0 fw-medium text-secondary">Masyarakat dapat melihat histori pengajuan dokumen.</p>
              </div>
            </div>
            <div class="text-center pt-6"><a class="btn btn-warning" href="/register" role="button">Coba Sekarang!</a></div>
          </div><!-- end of .container-->
  
        </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->

      <!-- ============================================-->
      <!-- <section> begin ============================-->
        <section class="py-md-8 mt-4" id="faq">
          <!--/.bg-holder-->
          <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
              <h5 class="text-secondary mb-3">FAQ</h5>
              <h1 class="fw-bold mb-4 fs-7">Pertanyaan yang Sering Diajukan</h1>
              <p class="mb-5 text-info fw-medium">Silahkan lihat pertanyaan yang sering diajukan Masyarakat.</p>
              <details>
                <summary>Bagaimana cara pengajuan dokumen?</summary>
                <div>
                  The tags <em>details</em> and <em>summary</em> have you covered.
                </div>
              </details>
            </div>
          </div>
          </div>
        </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->

      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="py-md-10" id="kontak">
        <div class="bg-holder z-index--1 bottom-0 d-none d-lg-block background-position-top" style="background-image:url(./user/assets/img/superhero/oval.png); opacity:.5; background-position: top !important ;">
        </div>
        <!--/.bg-holder-->
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
              <h1 class="fw-bold mb-4 fs-7">Apakah Ada Pertanyaan?</h1>
              <p class="mb-5 text-info fw-medium">Silahkan ajukan pertanyaan dengan menekan tombol dibawah ini. Pertanyaan akan diajukan melalui Whatsapp.</p>
              <a href="https://wa.me/089123456789" class="btn btn-warning btn-md">Hubungi KaLing</a>
            </div>
          </div>
        </div><!-- end of .container-->
      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->

      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="text-center py-0">
        <div class="container">
          <div class="container border-top py-3">
            <div class="row justify-content-between">
              <div class="col-12 col-md-auto mb-1 mb-md-0">
                <p class="mb-0">&copy; 2023 Sistem Informasi Pengajuan Dokumen Elektronik </p>
              </div>
              <div class="col-12 col-md-auto">
                <p class="mb-0">SIPDEh</p>
              </div>
            </div>
          </div>
        </div><!-- end of .container-->
      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->

    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->

    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="{{ asset('user/vendors/@popperjs/popper.min.js') }}"></script>
    <script src="{{ asset('user/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('user/vendors/is/is.min.js') }}"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="{{ asset('user/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/theme.js') }}"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&amp;family=Volkhov:wght@700&amp;display=swap" rel="stylesheet">
  </body>

</html>