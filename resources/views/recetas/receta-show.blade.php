<x-deliny-layout>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS (Popper.js is required for Bootstrap) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero d-flex align-items-center section-bg">
        <div class="container">
        <div class="row justify-content-between gy-5">

          <!-- ======== Nombre, descripción y etiquetas de la receta ======== -->
          <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center align-items-center align-items-lg-start text-center text-lg-start">
            <h2 data-aos="fade-up" class="aos-init aos-animate">{{$receta->titulo}}</h2>
            <p data-aos="fade-up" data-aos-delay="100" class="aos-init aos-animate">{{$receta->descripcion}}</p>
            <div class="etiquetas">
              <ul>
                  @foreach ($receta->etiquetas as $etiqueta)
                      <li>{{ $etiqueta->etiqueta }}</li>
                  @endforeach
              </ul>
            </div>
          </div>
          
          <!-- ======== Imgen de la receta ======== -->
          <div class="col-lg-5 order-1 order-lg-2 text-center text-lg-start">
            <a href="{{ route('recetaimg.descarga', $receta) }}">
              <img src="{{ \Storage::url($receta->archivo_ubicacion) }}" alt="{{ $receta->titulo }}" class="img-fluid aos-init aos-animate" data-aos="zoom-out" data-aos-delay="300">
            </a>
          </div>
          
        </div>
      </div>
    </section>

    <section id="ingrediente-procedimiento" class="about">
      <a href="{{ route('recetas.descargar-pdf', $receta) }}" class="btn btn-primary">Descargar PDF</a>
      <div class="container aos-init aos-animate" data-aos="fade-up">
        <div class="section-header">
          <p>Ingredientes<span>:</span></p>
          <ul>
              @foreach ($receta->ingredientes as $ingrediente)
                  <h2><li><i class="bi bi-check2-all"></i>{{ $ingrediente->cantidad}} {{ $ingrediente->unidadMedida}} de {{ $ingrediente->nombre}}</li></h2>
              @endforeach
          </ul>
        </div>
      </div>
      <div class="container aos-init aos-animate" data-aos="fade-up">
        <div class="section-header">
          <p>Preparación de <span>{{$receta->titulo}}:</span></p>
        </div>
        <div class="proce">
          <ol>
            @foreach ($receta->procedimientos as $proce)
              <div style="display: flex; flex-direction: column; align-items: center;">
              <li>{{ $proce->procedimiento}} <br><br></li>
              <img src="{{ \Storage::url($proce->archivo_ubicacion) }}" alt="{{ $receta->titulo }}" style="width: 50%; height: 50%;">
              <br><br>
              </div>
            @endforeach
          </ol>
        </div>
      </div>
    </section>

    <!-- Mostrar el promedio de calificaciones sin fondo de imagen -->
    <div class="container" data-aos="zoom-out">
    <div class="row gy-4">
        <div class="text-center">
            <span style="font-weight: bold; font-size: 30px; color: #ffffff;">Promedio y Estrellas</span>
        </div>
    </div>

    <div style="padding: 20px; border-radius: 10px; margin-top: 20px; background-color: #333; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);">
        <p style="color: white; font-size: 24px; font-weight: bold;">Calificación promedio según usuarios: {{ $promedio }}</p>
        <p style="color: white; font-size: 24px; font-weight: bold;">
            @for ($i = 1; $i <= 5; $i++)
                @if ($i <= $promedio)
                    <i class="fas fa-star" style="color: goldenrod;"></i>
                @else
                    <i class="far fa-star" style="color: goldenrod;"></i>
                @endif
            @endfor
        </p>
    </div>
</div>

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
  </section>
<!-- ======= Form comentarios ======= -->
<section id="contact" class="contact">
  <div class="container" data-aos="fade-up">
    <form method="POST" action="{{ route('comentarios.store') }}">
        @csrf 
        <h2 style="font-weight: bold; font-size: 30px; color: #ffffff;" >Ingresa tu opinión</h2>
            <div class="col-xl-12 form-group">
                <input type="textarea" name="comentario" class="form-control" placeholder="Tu Comentario" rows="5" required></textarea>
            </div>
        <div class="form-group">
            <label style="font-weight: bold; color: #ffffff;" for="calificacion">Calificación:</label>
            <select name="calificacion" id="calificacion" class="form-control">
              <option value="5">Excelente</option>
              <option value="4">Muy bueno</option>
              <option value="3">Bueno</option>
              <option value="2">Regular</option>
              <option value="1">Malo</option>
            </select>
        </div>
        <input type="hidden" name="recetas_id" value="{{ $receta->id }}">
    <button type="submit" style="display: inline-block; padding: 10px 20px; background-color: red; color: white; border: none; border-radius: 20px; cursor: pointer;">Enviar comentario</button>
    </form>
  </div>
</section><!-- End COMENTARIOS -->
     
    </div>
  
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


<ul class="comment-list">
    @foreach ($receta->comentarios as $c)
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
                            <i class="bi bi-star-fill"></i>
                          @else
                            <i class="bi bi-star"></i>
                          @endif
                        @endfor
                        <p>Calificación: {{ $c->calificacion }} estrellas</p>
                    </div>

                    <!-- Muestra el nombre del usuario -->
                    <p>Usuario: {{ $c->user->name }}</p>
                </div>

                <!-- Agrega enlaces para editar y eliminar -->
                <div class="actions">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editarComentarioModal" data-id="{{ $c->id }}">
                    Editar Comentario
                  </button>
                  <div class="modal fade" id="editarComentarioModal" tabindex="-1" role="dialog" aria-labelledby="editarComentarioModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="editarComentarioModalLabel">Editar Comentario</h5>
                          <div class="modal-body">
                            <form id="formComentario" method="POST" action="{{ route('comentarios.update', '') }}">             
                              @csrf
                              @method('PATCH')
                              <div class="form-group">
                                <textarea name="comentario" class="form-control" rows="5" required>{{ $c->comentario }}</textarea>
                              </div>
                              <div class="form-group">
                                <label for="calificacion">Calificación:</label>
                                <select name="calificacion" id="calificacion" class="form-control">
                                  <option value="5">Excelente</option>
                                  <option value="4">Muy bueno</option>
                                  <option value="3">Bueno</option>
                                  <option value="2">Regular</option>
                                  <option value="1">Malo</option>
                                </select>
                              </div>
                              <div class="text-center">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                              </div>
                            </form>
                          </div>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Modal -->
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

<script>
  $('#editarComentarioModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var comentarioId = button.data('id');
    
    // Asignar el ID del comentario al campo oculto dentro del modal
    $('#comentarioId').val(comentarioId);
    console.log(comentarioId);

    // Modificar el action del formulario con el nuevo ID del comentario
     $('#formComentario').attr('action', '{{ route('comentarios.update', '') }}/' + comentarioId);
  });
</script>

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
              <strong>Email:</strong> contactodeliny@gmail.com<br>
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
    </div>

  </footer><!-- End Footer -->
  <!-- End Footer -->
  <div class="modal fade" id="editarComentarioModal" tabindex="-1" role="dialog" aria-labelledby="editarComentarioModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editarComentarioModalLabel">Editar Comentario</h5>
          <div class="modal-body">
            <form id="formComentario" method="POST" action="{{ route('comentarios.update', $c->id) }}">
              @csrf
              @method('PATCH')
              <div class="form-group">
                <textarea name="comentario" class="form-control" value="{{$c->comentario}}" rows="5" required></textarea>
              </div>
              <div class="form-group">
                <label for="calificacion">Calificación:</label>
                <select name="calificacion" id="calificacion" class="form-control">
                  <option value="5">Excelente</option>
                  <option value="4">Muy bueno</option>
                  <option value="3">Bueno</option>
                  <option value="2">Regular</option>
                  <option value="1">Malo</option>
                </select>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary">Actualizar</button>
              </div>
            </form>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</x-deliny-layout>

