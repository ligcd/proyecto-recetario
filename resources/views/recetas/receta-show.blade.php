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
  <link href="{{ asset('assets/css/main2.css') }}" rel="stylesheet">
  

  <!-- =======================================================
  * Template Name: Yummy
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>



<!-- INICIO DE PÁGINA DE COMENTARIOS -->

<body>

<header id="header" class="header fixed-top d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">

        <div class="container d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1>Denily<span>.</span></h1>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="{{route('recetas.index')}}">Recetas</a></li>
          <li><a href="#">Desayunos</a></li>
          <li><a href="#">Comidas</a></li>
          <li><a href="#">Cenas</a></li>
          <li><a href="#">Postres</a></li>
          <li><a href="#">Bebidas</a></li>
          <li><a href="#">Planificador</a></li>
        </ul>
      </nav><!-- .navbar -->

      <a class="btn-book-a-table" href="{{route('recetas.create')}}">Agregar nueva receta</a>
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

        </div>
    </header><!-- End Header -->


<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center section-bg">
        <div class="container">
        <div class="row justify-content-between gy-5">
            <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center align-items-center align-items-lg-start text-center text-lg-start">
            <h2>{{$receta->titulo}}</h2>
            <p>{{$receta->descripcion}}</p>
            </div>
            <div class="col-lg-5 order-1 order-lg-2 text-center text-lg-start">
              <a href="{{ route('recetaimg.descarga', $receta) }}">
              <a href="{{ route('recetas.descargar-pdf', $receta) }}" class="btn btn-primary">Descargar PDF</a>

                <img src="{{ \Storage::url($receta->archivo_ubicacion) }}" alt="{{ $receta->titulo }}" class="img-fluid">
              </a>
              
            </div>
          </div>
          <div>
            <ul>
                @foreach ($receta->ingredientes as $ingrediente)
                    <li>{{ $ingrediente->nombre}}</li>
                @endforeach
            </ul>
          </div>
          
          <ul>
              @foreach ($receta->etiquetas as $etiqueta)
                  <li>{{ $etiqueta->etiqueta }}</li>
              @endforeach
          </ul>
        </div>
        
        
        <!--<h4>Usuario que creó:  $receta->user->name }}</h4>-->
    </section><!-- End Hero Section -->












    <section id="why-us" class="why-us section-bg">
    <div class="section-header">
        <p>Nos importa tu <span>opinión</span></p>
    </div>

    <!-- INICIO NOS IMPORTA -->
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
        <a href="{{ route('comentarios.create') }}" class="comment-button">Da click para comentar</a>
    </div>
</section>
<!--SOLO PARA EL BOTÓN SOLO PARA EL BOTÓN-->
<style>
   
    .comment-button {
        display: inline-block;
        padding: 20px 40px;
        background-color: red;
        color: white;
        border-radius: 40px;
        font-size: 20px;
        text-decoration: none;
        transition: background-color 0.3s, color 0.3s;
    }

    .comment-button:hover {
        background-color: darkred;
        color: ivory;
    }
</style>
  
</section><!-- End Why Us Section -->





<!-- ======= Stats Counter Section ======= -->
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
<link rel="stylesheet" href="{{ asset('assets/css/main2.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">



<ul class="comment-list">
    @foreach ($receta->comentarios as $c)
        <a href="{{ route('comentarios.show', $c->id)}}" style="color: white">
            ID: {{$c->id}} (Click para más información)
        </a>
        <li class="comment-item">
            <div style="background-color: white; border-radius: 10px; padding: 20px; margin: 10px; text-align: center;">
                <div class="testimonial-content">
                    <p>
                        <i class="bi bi-quote quote-icon-left"></i>
                        {{ $c->comentario }}
                        <i class="bi bi-quote quote-icon-right"></i>
                    </p>

                    <!-- Agrega estrellas basadas en la calificación -->
                    <div class="stars">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $c->calificacion)
                                <i class="fas fa-star" style="color: goldenrod;"></i>
                            @else
                                <i class="far fa-star" style="color: goldenrod;"></i>
                            @endif
                        @endfor
                        <p>Calificación: {{ $c->calificacion }} estrellas</p>
                    </div>
                </div>
                <!-- Agrega enlaces para editar y eliminar -->
                <div class="actions">
                    <a href="{{ route('comentarios.edit', $c->id) }}" class="edit-link">Editar Comentario</a>
                    <form action="{{ route('comentarios.destroy', $c->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-button">Borrar comentario</button>
                    </form>
                </div>
            </div>
        </li>
    @endforeach
</ul>

<!-- FIN DE COMENTARIOS LISTADO -->



</section> <!--FINAL DE SECCIÓN -->



   



    
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
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