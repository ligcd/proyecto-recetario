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

    <!-- Incluir estilos y scripts de Select2 -->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
      <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

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
  <main id="main">
    <!-- ======= Book A Table Section ======= -->
    <section id="book-a-table" class="book-a-table">
      <div class="container">

        <div class="section-header">
          <h2>Edita tu receta</h2>
          <p>¿Tu receta de <span>{{$receta->titulo}}</span> necesita modificaciones?</p>
        </div>

        <form action="{{route('recetas.update', $receta)}}" method="POST" class="row g-0" enctype="multipart/form-data">
          @csrf
          @method('PATCH')
          <div class="col-lg-4 reservation-img" style="background-image: url('{{ \Storage::url($receta->archivo_ubicacion) }}');">
            <img id="imagenPrevia" src="#" alt="{{ $receta->titulo }}" style="display: none; width: 100%; height: 100%;">
          </div>
          <div class="col-lg-8 d-flex align-items-center reservation-form-bg php-email-form">
            <div class="row gy-4">
              
              <!--Cambiar titulo-->
              <div class="col-lg-12">
                <input type="text" name="titulo" class="form-control" placeholder="Nombre del platillo"value="{{$receta->titulo}}" >
                <div class="validate"></div>
              </div>
              
              <!--Cambiar imagen-->
              <div class="col-lg-12">
                <input type="file" name="archivo" class="form-control" onchange="mostrarImagen(this)">
              </div>  

              <!--Cambiar tipo de comida-->
              <div class="col-lg-12">
                <select name="tipoComida" class="form-control">
                    <option value="Desayuno" @if($receta->tipoComida === 'Desayuno') selected @endif>Desayuno</option>
                    <option value="Almuerzo" @if($receta->tipoComida === 'Almuerzo') selected @endif>Almuerzo</option>
                    <option value="Comida" @if($receta->tipoComida === 'Comida') selected @endif>Comida</option>
                    <option value="Cena" @if($receta->tipoComida === 'Cena') selected @endif>Cena</option>
                    <option value="Postre" @if($receta->tipoComida === 'Postre') selected @endif>Postre</option>
                    <option value="Bebida" @if($receta->tipoComida === 'Bebida') selected @endif>Bebida</option>
                </select>
              </div>

              <!--Cambiar descripcion--> 
              <div class="form-group mt-3">
                <textarea class="form-control" name="descripcion" rows="2" placeholder="Describe el platillo">{{$receta->descripcion}}</textarea>
                <div class="validate"></div>
              </div>

              <!--Cambiar etiquetas-->
              <div class="col-lg-12">
                  <select id="etiquetas" name="etiqueta_id[]" multiple class="form-control" required>
                  <!-- Opciones de etiquetas existentes -->
                  @foreach ($etiquetas as $etiqueta)
                    <option value="{{ $etiqueta->id }}" @if(in_array($etiqueta->id, old('etiqueta_id', $receta->etiquetas->pluck('id')->toArray()) ?? [])) selected @endif>
                      {{ $etiqueta->etiqueta }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <!--Editar ingredientes y procedimiento-->
          <div class="row gy-0 seccion-ingredientes php-email-form" id="ingredientes">
            <!--Ingredientes header-->
            <div class="section-header">
              <p style="font-size:50px;">Agregar <span>Ingrediente</span></p>
            </div>
            
            @foreach($receta->ingredientes as $ingrediente)
              <div class="row gy-0 ingrediente-bloque">
              
                <!--Nombre del ingrediente-->
                <div class="col-md-4">
                  <input type="text" name="nombre[]" class="form-control" id="nombre" placeholder="Nombre del Ingrediente" value="{{ $ingrediente->nombre }}" >
                  @error('nombre.*')
                    <div class="error" style="color:#CE1212; margin-left: 15px; font-size:13px;">{{ $message }}</div>
                  @enderror
                </div>

                <!--Cantidad del ingrediente-->
                <div class="col-md-4">
                  <input type="number" class="form-control" name="cantidad[]" step="0.100" id="cantidad" placeholder="Cantidad" value="{{ $ingrediente->cantidad }}">
                  @error('cantidad.*')
                    <div class="error" style="color:#CE1212; margin-left: 15px; font-size:13px;">{{ $message }}</div>
                  @enderror
                </div>
                
                <!--Unidad de medida-->
                <div class="col-md-4">
                  <select class="form-control" name="unidadMedida[]" id="unidadMedida">
                      <option value="">Selecciona una unidad de medida</option>
                      <option value="Kg" @if($ingrediente->unidadMedida === 'Kg') selected @endif>Kilogramos (Kg)</option>
                      <option value="gr" @if($ingrediente->unidadMedida === 'gr') selected @endif>Gramos (gr)</option>
                      <option value="ml" @if($ingrediente->unidadMedida === 'ml') selected @endif>Mililitros (ml)</option>
                      <option value="L" @if($ingrediente->unidadMedida === 'L') selected @endif>Litros (L)</option>
                      <option value="lb" @if($ingrediente->unidadMedida === 'lb') selected @endif>Libras (lb)</option>
                      <option value="oz" @if($ingrediente->unidadMedida === 'oz') selected @endif>Onzas (oz)</option>
                      <option value="c/s" @if($ingrediente->unidadMedida === 'c/s') selected @endif>Cucharadas sopera (c/s)</option>
                      <option value="c/c" @if($ingrediente->unidadMedida === 'c/c') selected @endif>Cucharaditas de postre (c/c)</option>
                  </select>
                  <span class="text-muted"style="margin-left:5px; font-size:10px;">(deja en blanco si es necesario)</span>
                </div>
              </div>
            @endforeach

            <!--Boton para agregar mas ingredientes-->
            <div class="add-ingredient"><button type="button" id="btnAgregarOtroIngrediente">
              <i class="bi bi-plus"></i>Agregar otro ingrediente</button></div>
            
            <!--Agregar procedimiento-->
            <div class="form-group mt-3">
              <div class="section-header">
                <p style="font-size:50px;">Agregar <span>Procedimiento</span></p>
              </div>
              <textarea class="form-control" name="procedimiento" rows="10" placeholder="Describe el procedimiento de elaboración del platillo">{{ $receta->procedimiento }}</textarea>
              <div class="validate"></div>
            </div>

              <div class="text-center"><button type="submit">Guardar</button></div>
            </div>
            </form>
          </div><!-- End Reservation Form -->

        </div>

      </div>
    </section><!-- End Book A Table Section -->

  </main><!-- End #main -->
</body>

<script>
  $(document).ready(function () {

    // Manejar el clic en el botón "Agregar otro ingrediente"
    $("#btnAgregarOtroIngrediente").click(function () {
      // Clonar la última sección de ingredientes y agregarla después
      $(".ingrediente-bloque:last").clone().insertAfter(".ingrediente-bloque:last");
    });

     // Inicializar Select2 en el campo de etiquetas
    $("#etiquetas").select2({
        tags: true,
        tokenSeparators: [',', ' '], // Permitir separar etiquetas por coma o espacio
        placeholder: "Selecciona o crea etiquetas",
    });
  });

  function mostrarImagen(input) {
      var imagenPrevia = document.getElementById('imagenPrevia');
      var archivoSeleccionado = input.files[0];

      if (archivoSeleccionado) {
          var lector = new FileReader();

          lector.onload = function(e) {
              imagenPrevia.src = e.target.result;
              imagenPrevia.style.display = 'block';
          }

          lector.readAsDataURL(archivoSeleccionado);
      } else {
          imagenPrevia.src = '#';
          imagenPrevia.style.display = 'none';
      }
  }
</script>
</html>