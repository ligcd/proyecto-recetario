<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Realiza tu comentario</title>
  <meta content="" name="description">
  <meta content="" name="keywords">



  <!-- Favicons -->
  <!--  <link href="assets/img/favicon.png" rel="icon"> -->
 <!-- <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->
 <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
 <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
 


  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
  

  <!--        ======
  * Template Name: Yummy
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
           -->
</head>



<!-- INICIO DE PÁGINA DE COMENTARIOS -->

<body>


 <!--   Header   -->


 <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-lg-0">
        
        <img src="{{ asset('assets/img/favicon.jpeg') }}" alt="Logo">
        <h1>Deliny<span>.</span></h1>
      </a>


      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="#why-us">Envía tu comentario</a></li>
          <li><a href="#stats-counter">Todos los comentarios</a></li>
          <li><a href="#gallery">Más recetas</a></li>
        </ul>
      </nav><!-- .navbar -->

      

    </div>
  </header><!-- End Header -->




<section id="why-us" class="why-us section-bg">
<div class="section-header">
          <p>Nos importa tu <span>opinión</span></p>
        </div>


        <!--INICIO NOS IMPORTA -->

  
  <div class="container" data-aos="fade-up">
    <div class="row gy-4">
      <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
        <div class="why-box">
          <h3>¿Qué te ha parecido la receta?</h3>
          <p>
            ¡Tu opinión importa! Para nosotros es importante verificar que 
            las recetas sean deliciosas, por ello puedes opinar sobre 
            cada una de ellas ¿Estuvo salado? ¿Demasiado dulce? ¿Es tu receta favorita? 
            Hazlo saber en los comentarios.
          </p>
        </div>
      </div><!-- End Why Box -->

      <!-- Agrega una imagen a la derecha -->
      <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
       <figure class="why-image">
           <img src="{{ asset('assets/img/menu/probando-comida.jpg') }}" alt="Hombre comiendo">
        </figure>
      </div>
    </div>
  </div>

  <div class="text-center">
    <a href="{{ route('comentarios.create') }}" style="display: inline-block; padding: 10px 20px; background-color: red; color: white; border-radius: 20px; text-decoration: none;">Da click para comentar</a>
</div>


  
</section><!-- End Why Us Section -->





<!--   Stats Counter Section   -->
<section id="stats-counter" class="stats-counter">

  <div class="container" data-aos="zoom-out">

    <div class="row gy-4">

    <div class="text-center">
    <span style="font-weight: bold; font-size: 30px; color: #ffffff;">COMENTARIOS</span>
    </div>   

    </div>

  </div>
<!-- End Stats Counter Section -->


<!-- INICIO DE COMENTARIOS LISTADO -->
<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@if (count($allcomentarios) > 0)
    <ul class="comment-list">
        @foreach ($allcomentarios as $comentario)
            <a href="{{ route('comentarios.show', $comentario->id)}}" style="color: white">
                ID: {{$comentario->id}} (Click para más información)
            </a>
            <li class="comment-item">
                <div style="background-color: white; border-radius: 10px; padding: 20px; margin: 10px; text-align: center;">
                    <div class="testimonial-content">
                        <p>
                            <i class="bi bi-quote quote-icon-left"></i>
                            {{ $comentario->comentario }}
                            <i class="bi bi-quote quote-icon-right"></i>
                        </p>

                        <!-- Agrega estrellas basadas en la calificación -->
                        <div class="stars">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $comentario->calificacion)
                                    <i class="fas fa-star" style="color: goldenrod;"></i>
                                @else
                                    <i class="far fa-star" style="color: goldenrod;"></i>
                                @endif
                            @endfor
                            <p>Calificación: {{ $comentario->calificacion }} estrellas</p>
                        </div>
                    </div>
                    <!-- Agrega enlaces para editar y eliminar -->
                    <div class="actions">
                        <a href="{{ route('comentarios.edit', $comentario->id) }}" class="edit-link">Editar Comentario</a>
                        <form action="{{ route('comentarios.destroy', $comentario->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-button">Borrar comentario</button>
                        </form>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
@else
<center>
    <h1>-</h1>
    <p>Aún no existen comentarios.</p>
</center>
@endif


</section> <!--FINAL DE SECCIÓN -->



    <!--   Gallery Section   -->
    <section id="gallery" class="gallery section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Recetas</h2>
          <p>Encuentra más recetas en <span> DELINY </span></p>
        </div>

        <div class="gallery-slider swiper">
          <div class="swiper-wrapper align-items-center">

          <div class="swiper-slide">
    <a class="glightbox" data-gallery="images-gallery" href="{{ asset('assets/img/menu/menu-item-1.png') }}">
        <img src="{{ asset('assets/img/menu/menu-item-1.png') }}" class="menu-img img-fluid" alt="">
    </a>
</div>
<div class="swiper-slide">
    <a class="glightbox" data-gallery="images-gallery" href="{{ asset('assets/img/menu/menu-item-2.png') }}">
        <img src="{{ asset('assets/img/menu/menu-item-2.png') }}" class="menu-img img-fluid" alt="">
    </a>
</div>
<div class="swiper-slide">
    <a class="glightbox" data-gallery="images-gallery" href="{{ asset('assets/img/menu/menu-item-3.png') }}">
        <img src="{{ asset('assets/img/menu/menu-item-3.png') }}" class="menu-img img-fluid" alt="">
    </a>
</div>
<div class="swiper-slide">
    <a class="glightbox" data-gallery="images-gallery" href="{{ asset('assets/img/menu/menu-item-4.png') }}">
        <img src="{{ asset('assets/img/menu/menu-item-4.png') }}" class="menu-img img-fluid" alt="">
    </a>
</div>
<div class="swiper-slide">
    <a class="glightbox" data-gallery="images-gallery" href="{{ asset('assets/img/menu/menu-item-5.png') }}">
        <img src="{{ asset('assets/img/menu/menu-item-5.png') }}" class="menu-img img-fluid" alt="">
    </a>
</div>
<div class="swiper-slide">
    <a class="glightbox" data-gallery="images-gallery" href="{{ asset('assets/img/menu/menu-item-6.png') }}">
        <img src="{{ asset('assets/img/menu/menu-item-6.png') }}" class="menu-img img-fluid" alt="">
    </a>
</div>


           
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Gallery Section -->




    
  </main><!-- End #main -->

  <!--   Footer   -->
  <footer id="footer" class="footer">

    <div class="container">
      <div class="row gy-3">
        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-geo-alt icon"></i>
          <div>
            <h4>Dirección</h4>
            <p>
              Guadalajara, Jalisco <br>
              México<br>
            </p>
          </div>

        </div>

        <div class="col-lg-3 col-md-6 footer-links d-flex">
          <i class="bi bi-telephone icon"></i>
          <div>
            <h4>Contáctanos</h4>
            <p>
              <strong>Teléfono:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>
          </div>
        </div>

       

        <div class="col-lg-3 col-md-6 footer-links">
          <h4>Siguenos en redes</h4>
          <div class="social-links d-flex">
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
           
          </div>
        </div>

      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Deliny</span></strong>. All Rights Reserved
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
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>