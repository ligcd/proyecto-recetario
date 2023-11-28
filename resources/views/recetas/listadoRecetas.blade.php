<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Denily</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="/assets/img/favicon.png" rel="icon">
  <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <link href="/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/assets/css/main.css" rel="stylesheet">

  <!---
  =======================================================
  * Template Name: Yummy
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <x-navbar/>
  
  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="recetas" class="about" style="background-color: #fbfbfb">
      <div class="container aos-init aos-animate" data-aos="fade-up">
        <br><br>
        <div class="section-header">
          <h2>Recetas</h2>
          <p>Conoce nuestras <span>Mejores recetas</span></p>
        </div>

        <form action="{{ route('recetas.index') }}" method="GET" class="mt-4">
          @csrf
      
          <div class="form-group">
              <label for="titulo">Buscar por título:</label>
              <input type="text" name="titulo" class="form-control">
          </div>
      
          <div class="form-group">
              <label for="tipoComida">Buscar por tipo de comida:</label>
              <select name="tipoComida" class="form-control">
                  <option value="">Todos</option>
                  <option value="Desayuno">Desayuno</option>
                  <option value="Almuerzo">Almuerzo</option>
                  <option value="Comida">Comida</option>
                  <option value="Cena">Cena</option>
                  <option value="Postre">Postre</option>
                  <option value="Bebida">Bebida</option>
              </select>
          </div>
      
          <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">Buscar</button>
            <a href="{{ route('recetas.index') }}" class="btn btn-secondary">Limpiar filtros</a>
          </div>
      </form>
      
      @if($noResultados)
          <p>No se encontraron resultados.</p>
      @else
        <ul class="row gy-4">
          @foreach($recetas as $receta)
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="150">
            <div class="call-us d-flex flex-column justify-content-center align-items-center" style="background-color: #ffffff; border-radius: 10px;">

              <div class="d-flex justify-content-between" style="margin-bottom:1em; border-bottom: 1px solid #efefef; padding-bottom: 1em;">
                <div style="margin-right: 5em;">
                  <i class="bi bi-person" 
                    style="background-color: #ce1212; color: #fff; padding:5px; padding-left: 8px; padding-right:8px; border-radius: 50%; font-size: 20px;"></i>
                    <a href="blog-single.html" style="color: black; margin-left: 3px; font-size: 18px">
                      <b>{{ $receta->user->name }}</b>
                  </a>
                </div>
                <div>
                  <a href="blog-single.html" style="color: black; margin-right: 5px; color: #9b9b9b;">{{$receta->created_at->format('d/m/Y H:i')}} <i class="bi bi-clock"></i></a>
                </div>
              </div>
              
              <h4 style="font-size: 25px">
                <a href="{{route('recetas.show', $receta->id)}}">
                  {{$receta->titulo}}
                </a>
              </h4><br>

              <div>
                <img src="{{\Storage::url($receta->archivo_ubicacion)}}" alt="{{$receta->titulo}}" class="img-fluid">
              </div>

              <div class="menu">
                <ul class="nav nav-tabs d-flex justify-content-center aos-init aos-animate">
                  <li class="nav-item" style="margin-right: 3em"><i class="fas fa-utensils"></i><a style="font-size:12px; margin-left:5px;">{{$receta->tipoComida}}</a>
                  <li class="nav-item" style="margin-right: 1em"><i class="far fa-comment"></i><a href="{{route('recetas.show', $receta->id)}}"style="font-size:12px; margin-left:5px; color:black;">Comentarios</a></li>
                  
                </ul>
              </div>
              
              <div class="content">
                <div class="text-center"></div><br>
                <div class="text-center"><p style="font-size: 14px; color: black;">{{$receta->descripcion}}</p><br></div>
              </div>

            </div>
          </div>
          @endforeach
        </ul>
      @endif
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="container">
      <div class="row gy-3">
        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-geo-alt icon"></i>
          <div>
            <h4>Address</h4>
            <p>
              A108 Adam Street <br>
              New York, NY 535022 - US<br>
            </p>
          </div>

        </div>

        <div class="col-lg-3 col-md-6 footer-links d-flex">
          <i class="bi bi-telephone icon"></i>
          <div>
            <h4>Reservations</h4>
            <p>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 footer-links d-flex">
          <i class="bi bi-clock icon"></i>
          <div>
            <h4>Opening Hours</h4>
            <p>
              <strong>Mon-Sat: 11AM</strong> - 23PM<br>
              Sunday: Closed
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 footer-links">
          <h4>Follow Us</h4>
          <div class="social-links d-flex">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Yummy</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>

  </footer><!-- End Footer -->
  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>