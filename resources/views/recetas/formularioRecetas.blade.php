<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Nueva receta</title>
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
  <link href="/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/assets/css/main.css" rel="stylesheet">

      <!-- Incluir estilos y scripts de Select2 -->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
  
      <script>
          // Inicializar Select2 en el campo de etiquetas
          $(document).ready(function() {
              $('#etiquetas').select2({
                  tags: true,
                  tokenSeparators: [',', ' '], // Permitir separar etiquetas por coma o espacio
                  placeholder: "Selecciona o crea etiquetas",
              });
          });
      </script>

  <!-- =======================================================
  * Template Name: Yummy
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
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
  <br><br>
  <main id="main">
    <!-- ======= Book A Table Section ======= -->
    <section id="book-a-table" class="book-a-table">
      <div class="container">

        <div class="section-header">
          <h2>Nueva receta</h2>
          <p>Comparte tu <span>receta</span> con nosotros</p>
        </div>

        <div class="row g-0">

          <div class="col-lg-4 reservation-img" style="background-image: url(/assets/img/recetario/nuevareceta.jpg);"></div>

          <div class="col-lg-8 d-flex align-items-center reservation-form-bg">
            <form action="/recetas" method="POST" class="php-email-form" enctype="multipart/form-data">
                @csrf
                <div class="row gy-4">
                  <div class="col-lg-12">
                    <input type="text" name="titulo" class="form-control" placeholder="Nombre del platillo" >
                    <div class="validate"></div>
                  </div>

                  <div class="col-lg-12">
                    <input type="file" name="archivo" class="form-control">
                  </div>
                  
                  <div class="col-lg-12">
                    <select name="tipoComida" class="form-control" style="color: #595C5f; font-size: 14px;">
                      <option value="">Selecciona el tipo de platillo</option>
                      <option value="Desayuno">Desayuno</option>
                      <option value="Almuerzo">Almuerzo</option>
                      <option value="Comida">Comida</option>
                      <option value="Cena">Cena</option>
                      <option value="Postre">Postre</option>
                      <option value="Bebida">Bebida</option>
                    </select> 
                    <div class="validate"></div>
                  </div>
                  
                  <div class="form-group mt-3">
                    <textarea class="form-control" name="descripcion" rows="1" placeholder="Describe el platillo"></textarea>
                    <div class="validate"></div>
                  </div>

                  <div class="col-lg-12">
                    <label for="etiquetas">Etiquetas:</label>
                      <select id="etiquetas" name="etiqueta_id[]" multiple class="form-control">
                          <!-- Opciones de etiquetas existentes -->
                          @foreach ($etiquetas as $etiqueta)
                            <option value="{{ $etiqueta->id }}" @selected( array_search($etiqueta->id, old('etiqueta_id') ?? []) !== false )>
                              {{ $etiqueta->etiqueta }}
                            </option>
                          @endforeach
                      </select>
                  </div>

                  <div class="section-header ">
                    <p style="font-size:50px;">Agregar <span>Ingrediente</span></p>
                    <div class="text-center"><button type="button" id="btnAgregarIngredientes">Agregar ingredientes</button></div>
                  </div>

                  <div class="row gy-4 seccion-ingredientes">
                  
                  <input type="hidden" name="recetas_id" value="{{ $recetaId }}">
                  <div class="col-md-6 ingrediente-bloque">
                    <input type="text" name="nombre[]" class="form-control" id="nombre" placeholder="Nombre del Ingrediente">
                    @error('nombre')
                    <div class="error" style="color:#CE1212; margin-left: 15px; font-size:13px;">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="col-md-6">
                    <input type="number" class="form-control" name="cantidad[]" step="0.100" id="cantidad" placeholder="Cantidad">
                    @error('cantidad')
                    <div class="error" style="color:#CE1212; margin-left: 15px; font-size:13px;">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="col-md-6">
                    <select class="custom-select" name="unidadMedida[]" id="unidadMedida">
                        <option value="">Selecciona una unidad de medida</option>
                        <option value="Kg">Kilogramos (Kg)</option>
                        <option value="gr">Gramos (gr)</option>
                        <option value="ml">Mililitros (ml)</option>
                        <option value="L">Litros (L)</option>
                        <option value="lb">Libras (lb)</option>
                        <option value="oz">Onzas (oz)</option>
                        <option value="c/s">Cucharadas sopera (c/s)</option>
                        <option value="c/c">Cucharaditas de postre (c/c)</option>
                    </select>
                    <span class="text-muted"style="margin-left:5px; font-size:10px;">(deja en blanco si es necesario)</span>
                    @error('unidadMedida')
                    <div class="error" style="color:#CE1212; margin-left: 15px; font-size:13px;">{{ $message }}</div>
                    @enderror
                </div>
                <div class="text-center"><button type="button" id="btnAgregarOtroIngrediente">Agregar otro</button></div>

                </div>

                <div class="form-group mt-3">
                    <textarea class="form-control" name="procedimiento" rows="10" placeholder="Describe el procedimiento de elaboración del platillo"></textarea>
                    <div class="validate"></div>
                </div>
                
                  <div class="text-center"><button type="submit">Crear</button></div>

            </form>
          </div><!-- End Reservation Form -->

        </div>

      </div>
    </section><!-- End Book A Table Section -->

  </main><!-- End #main -->

</body>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  $(document).ready(function () {
    // Ocultar la sección de ingredientes al cargar la página
    $(".seccion-ingredientes").hide();

    // Manejar el clic en el botón "Agregar ingredientes"
    $("#btnAgregarIngredientes").click(function () {
      // Mostrar la sección de ingredientes
      $(".seccion-ingredientes").show();
    });

    // Manejar el clic en el botón "Agregar otro ingrediente"
    $("#btnAgregarOtroIngrediente").click(function () {
      // Clonar la última sección de ingredientes y agregarla después
      $(".seccion-ingredientes:last").clone().insertAfter(".seccion-ingredientes:last");
    });
  });
</script>

</html>