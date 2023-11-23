<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$receta->titulo}}</title>

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
                <img src="{{ \Storage::url($receta->archivo_ubicacion) }}" alt="{{ $receta->titulo }}" class="img-fluid">
              </a>
            </div>
          </div>
          <div>
            <h1>Ingredientes</h1>
            <ol>
                @foreach ($receta->ingredientes as $ingrediente)
                    <li>{{ $ingrediente->nombre}}</li>
                @endforeach
            </ol>
          </div>
          <div>
            <h1>Procedimiento</h1>
            <p>{{$receta->procedimiento}}</p>
          </div>
          <div>
            <h1>Comentarios</h1>
            <ul>
                @foreach ($receta->comentarios as $c)
                    <li>{{ $c->comentario }}</li>
                @endforeach
            </ul>
          </div>
          <div>
            <h1>Etiquetas</h1>
            <ul>
                @foreach ($receta->etiquetas as $etiqueta)
                    <li>{{ $etiqueta->etiqueta }}</li>
                @endforeach
            </ul>
          </div>
        </div>
        
        <!--<h4>Usuario que creó:  $receta->user->name }}</h4>-->
    </section><!-- End Hero Section -->
</body>
</html>