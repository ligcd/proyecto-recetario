<x-deliny-layout>
  
  <main id="main">
    <section id="recetas" class="about" style="background-color: #fbfbfb">
      <div class="container aos-init aos-animate" data-aos="fade-up">
  
        <div class="section-header text-center" style="margin-top:30px;">
          <h2>Recetas</h2>
          <p>Conoce nuestras <span>Mejores recetas</span></p>
        </div>

        <form action="{{ route('recetas.index') }}" method="GET" class="mt-4">
          @csrf
          
          <!--- =========== Buscador =========== --->
          <div class="search d-flex align-items-center justify-content-between">
            <div class="form-group col-lg-8" >
              <input type="text" name="titulo" class="form-control" placeholder="Busca el nombre del platillo">
            </div>
            <div class="form-group d-flex align-items-center col-lg-4" >
              <select name="tipoComida" class="form-control" style="margin:0 10px;">
                  <option value="">Selecciona el tipo de comida</option>
                  <option value="Desayuno">Desayuno</option>
                  <option value="Almuerzo">Almuerzo</option>
                  <option value="Comida">Comida</option>
                  <option value="Cena">Cena</option>
                  <option value="Postre">Postre</option>
                  <option value="Bebida">Bebida</option>
              </select>
              <div class="form-group">
                <button type="submit" class="btn btn-primary d-flex align-items-center" style="background-color:#CE1212; border:none; border-radius:20px;"><i class="bi bi-search" style="margin-right: 5px;"></i>Buscar</button>
              </div>
            </div>
          </div>
          <div class="d-flex align-items-center" style="margin-left: 7px; font-size:13px;">
            <a href="{{ route('recetas.index') }}" class="text-center">Limpiar filtros</a>
          </div>
        </form>

        <!--- =========== Listado de recetas =========== --->
        @if($noResultados)
          <p>No se encontraron resultados.</p>
        @else
        <div class="mt-5">
          <ul class="row gy-4">
            @foreach($recetas as $receta)
            
            <div class="d-flex justify-content-center col-lg-4" data-aos="fade-up" data-aos-delay="150" style="margin-top:none">
              <div class="call-us d-flex flex-column justify-content-center align-items-center" style="background-color: #ffffff; border-radius: 10px;">
                
                <!--- =========== Info de usuario y fecha =========== --->
                <div class="d-flex justify-content-between align-items-center user-date "style="margin-top:none">
                  <div class="user">
                    <a href="">
                      <b>{{ $receta->user->name }}</b>
                    </a>
                  </div>
                  <div class="date">
                    <a href="">{{$receta->created_at->format('d/m/Y')}} <i class="bi bi-clock"></i></a>
                  </div>
                </div>

                <h4>
                  <a href="{{route('recetas.show', $receta->id)}}">
                    {{$receta->titulo}}
                  </a>
                </h4>

                  <div class="img-receta">
                    <a href="{{route('recetas.show', $receta->id)}}">
                      <img src="{{\Storage::url($receta->archivo_ubicacion)}}" alt="{{$receta->titulo}}" class="img-fluid">
                    </a>
                    <div class="menu">
                      <ul class="nav nav-tabs d-flex justify-content-between aos-init aos-animate">
                        <li class="nav-item" style="margin-left: 3em;"><i class="fas fa-utensils"></i><a style="font-size:12px; margin-left:5px;">{{$receta->tipoComida}}</a>
                        <li class="nav-item" style="margin-right: 3em;"><i class="far fa-comment"></i><a style="font-size:12px; margin-left:5px; color:black;">Comentarios</a></li>
                      </ul>
                    </div>
                  </div>
                

                <div class="descrip-receta mt-5">
                  <div class="text-center fst-italic"><p>{{$receta->descripcion}}</p><br></div>
                </div>


              </div>
            </div>
            @endforeach
          </ul>
        </div>
        @endif

      </div>
    </section>
  </main>

</x-deliny-layout>