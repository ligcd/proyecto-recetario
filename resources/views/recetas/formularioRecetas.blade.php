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
      <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

  <!-- =======================================================
  * Template Name: Yummy
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  
  <main id="main">

    <section id="book-a-table" class="book-a-table">
      <div class="container">
        <!---Header--->
        <div class="section-header">
          <h2>Nueva receta</h2>
          <p>Comparte tu <span>receta</span> con nosotros</p>
        </div>
        <!--Inicio del cuadro del formulario-->
        <form action="/recetas" method="POST" class="row g-0" enctype="multipart/form-data">
          <div class="col-lg-4 reservation-img" style="background-image: url(/assets/img/recetario/nuevareceta.jpg);">
            <img id="imagenPrevia" src="#" alt="Vista previa de la imagen" style="display: none; width: 100%; height: 100%; "/>
          </div>
          <!---Formulario información general de la receta-->
          <div class="col-lg-8 d-flex align-items-center reservation-form-bg php-email-form">
            @csrf
            <div class="row gy-4">  
              <!--Nombre del platillo-->
              <div class="col-lg-12">
                <input type="text" name="titulo" class="form-control" placeholder="Nombre del platillo" required>
                @error('titulo')
                  <div class="error" style="color:#CE1212; margin-left: 15px; font-size:13px;">{{ $message }}</div>
                @enderror
              </div>
                
              <!--Subir imagen-->
              <div class="col-lg-12">
                <input type="file" name="archivo" class="form-control" required onchange="mostrarImagen(this)">
                @error('archivo')
                  <div class="error" style="color:#CE1212; margin-left: 15px; font-size:13px;">{{ $message }}</div>
                @enderror
              </div>  

              <!--Tipo de comida-->
              <div class="col-lg-12">
                <select name="tipoComida" class="form-control" style="color: #595C5f; font-size: 14px;" required>
                  <option value="">Selecciona el tipo de platillo</option>
                  <option value="Desayuno">Desayuno</option>
                  <option value="Almuerzo">Almuerzo</option>
                  <option value="Comida">Comida</option>
                  <option value="Cena">Cena</option>
                  <option value="Postre">Postre</option>
                  <option value="Bebida">Bebida</option>
                </select> 
                @error('tipoComida')
                  <div class="error" style="color:#CE1212; margin-left: 15px; font-size:13px;">{{ $message }}</div>
                @enderror
              </div>

              <!--Descripcion del platillo-->
              <div class="form-group mt-3">
                <textarea style="resize: none;" class="form-control" name="descripcion" rows="2" placeholder="Describe el platillo" required></textarea>
                @error('descripcion')
                  <div class="error" style="color:#CE1212; margin-left: 15px; font-size:13px;">{{ $message }}</div>
                @enderror
              </div>

              <!--Etiquetas-->
              <div class="col-lg-12">
                  <select id="etiquetas" name="etiqueta_id[]" multiple class="form-control" required>
                  <!-- Opciones de etiquetas existentes -->
                  @foreach ($etiquetas as $etiqueta)
                    <option value="{{ $etiqueta->id }}" @selected( array_search($etiqueta->id, old('etiqueta_id') ?? []) !== false )>
                      {{ $etiqueta->etiqueta }}
                    </option>
                  @endforeach
                  @error('etiqueta_id[]')
                    <div class="error" style="color:#CE1212; margin-left: 15px; font-size:13px;">{{ $message }}</div>
                  @enderror
                </select>
              </div>

              <!--Agregar ingredientes-->
              <div class="text-center add"><a href="#ingredientes" id="btnAgregarIngredientes">Agregar ingredientes y procedimiento</a></div>
            </div>
          </div>

          <!--Formulario-->
          <div class="row gy-0 seccion-ingredientes php-email-form" id="ingredientes">
            <!--Ingredientes header-->
            <div class="section-header">
              <p style="font-size:50px;">Agregar <span>Ingrediente</span></p>
            </div>
            <!--<input type="hidden" name="recetas_id" value="{{ $recetaId }}">-->
            
            <div class="row gy-0 ingrediente-bloque">
            
              <!--Nombre del ingrediente-->
              <div class="col-md-4">
                <input type="text" name="nombre[]" class="form-control" id="nombre" placeholder="Nombre del Ingrediente" >
                @error('nombre.*')
                  <div class="error" style="color:#CE1212; margin-left: 15px; font-size:13px;">{{ $message }}</div>
                @enderror
              </div>

              <!--Cantidad del ingrediente-->
              <div class="col-md-4">
                <input type="number" class="form-control" name="cantidad[]" step="0.100" id="cantidad" placeholder="Cantidad" >
                @error('cantidad.*')
                  <div class="error" style="color:#CE1212; margin-left: 15px; font-size:13px;">{{ $message }}</div>
                @enderror
              </div>
              
              <!--Unidad de medida-->
              <div class="col-md-4">
                <select class="form-control" name="unidadMedida[]" id="unidadMedida">
                    <option value="">Selecciona una unidad de medida</option>
                    <option value="Kilogramos">Kilogramos (Kg)</option>
                    <option value="Gramos">Gramos (gr)</option>
                    <option value="Militros">Mililitros (ml)</option>
                    <option value="Litros">Litros (L)</option>
                    <option value="Libras">Libras (lb)</option>
                    <option value="Onzas">Onzas (oz)</option>
                    <option value="c/s">Cucharadas sopera (c/s)</option>
                    <option value="c/c">Cucharaditas de postre (c/c)</option>
                    <option value="Tazas">Tazas (tz)</option>
                </select>
                <span class="text-muted"style="margin-left:5px; font-size:10px;">(deja en blanco si es necesario)</span>
              </div>
            </div>
            <!--Boton para agregar mas ingredientes-->
            <div class="add-ingredient"><button type="button" id="btnAgregarOtroIngrediente">
              <i class="bi bi-plus"></i>Agregar otro ingrediente</button></div>
            
            <!--Agregar procedimiento-->
            <div class="form-group mt-3">
              <div class="section-header">
                <p style="font-size:50px;">Agregar <span>Procedimiento</span></p>
              </div>
              <div class="row gy-0 procedimiento-bloque php-email-form" style="padding:0;">
                <p>Paso numero </p>
                <textarea class="form-control" name="procedimiento[]" rows="5" placeholder="Describe el procedimiento de elaboración del platillo"></textarea>
                <div class="add-ingredient row gy-0">   
                  <div class="option-procedimiento">
                    <div>               
                      <label style="font-size: 12px; color: #ce1212;">Ilustra tu paso con una imagen</label>
                      <input type="file" name="archivoProcedimiento[]" class="form-control"  onchange="mostrarImagen(this)">
                    </div>
                  </div>
                </div>
              </div>
              <div class="add-ingredient">
                <button type="button"  id="btnAgregarOtroProce">
                  <i class="bi bi-plus"></i>Agregar otro paso</button>
              </div>
            </div>
            <div class="text-center php-email-form"><button type="submit">Publicar receta</button></div>
          </div>
        </form>
      </div>
    </section>
    
  </main>

</body>

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
      $(".ingrediente-bloque:last").clone().insertAfter(".ingrediente-bloque:last");
    });

    // Manejar el clic en el botón "Agregar otro paso"
    $("#btnAgregarOtroProce").click(function () {
      // Clonar la última sección de procedimientos y agregarla después
      $(".procedimiento-bloque:last").clone().insertAfter(".procedimiento-bloque:last");
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