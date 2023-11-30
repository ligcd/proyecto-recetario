<x-deliny-layout>
  <main id="main">
    <!-- ======= Book A Table Section ======= -->
    <section id="book-a-table" class="book-a-table">
      <div class="container" style="margin-top:50px">

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
                <input type="text" name="titulo" class="form-control" placeholder="Nombre del platillo"value="{{$receta->titulo}}" required>
              </div>
              
              <!--Cambiar imagen-->
              <div class="col-lg-12">
                <input type="file" name="archivo" class="form-control" onchange="mostrarImagen(this)">
              </div>  

              <!--Cambiar tipo de comida-->
              <div class="col-lg-12">
                <select name="tipoComida" class="form-control" style="color: #595C5f; font-size: 14px;" required>
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
                <textarea style="resize: none;" class="form-control" name="descripcion" rows="2" placeholder="Describe el platillo" required>{{$receta->descripcion}}</textarea>
              </div>

              <!--Cambiar etiquetas-->
              <div class="col-lg-12">
                  <select id="etiquetas" name="etiqueta_id[]" multiple class="form-control" required>
                  <!-- Opciones de etiquetas existentes -->
                  @foreach ($etiquetas as $etiqueta)
                    <option style="width: 100%;" value="{{ $etiqueta->id }}" @if(in_array($etiqueta->id, old('etiqueta_id', $receta->etiquetas->pluck('id')->toArray()) ?? [])) selected @endif>
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
                  <input type="text" name="nombre[]" class="form-control" id="nombre" placeholder="Nombre del Ingrediente" value="{{ $ingrediente->nombre }}" required>
                  @error('nombre.*')
                    <div class="error" style="color:#CE1212; margin-left: 15px; font-size:13px;">{{ $message }}</div>
                  @enderror
                </div>

                <!--Cantidad del ingrediente-->
                <div class="col-md-4">
                  <input type="number" class="form-control" name="cantidad[]" step="0.100" id="cantidad" placeholder="Cantidad" value="{{ $ingrediente->cantidad }}" required>
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
              @foreach($receta->procedimientos as $procedimiento)
                <div class="row gy-0 procedimiento-bloque php-email-form" style="padding:0;">
                  <p>Paso</p>
                  <textarea class="form-control" name="procedimiento[]" rows="5" placeholder="Describe el procedimiento de elaboración del platillo" required>{{ $procedimiento->procedimiento }}</textarea>
                  <div class="add-ingredient row gy-0">   
                    <div class="option-procedimiento">
                      <div>               
                        <label style="font-size: 12px; color: #ce1212;">Ilustra tu paso con una imagen</label>
                        <input type="file" name="archivoProcedimiento[]" class="form-control"  onchange="mostrarImagen(this)" required>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="add-ingredient">
                  <button type="button"  id="btnAgregarOtroProce">
                    <i class="bi bi-plus"></i>Agregar otro paso</button>
                </div>
              @endforeach
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
</x-deliny-layout>
