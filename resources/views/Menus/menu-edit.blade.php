<x-deliny-layout>


    <main id="main">
        <!-- ======= Book A Table Section ======= -->
            <div class="container" style="margin-top: 100px; padding:auto" data-aos="fade-up">
      
              <div class="menus g-0">
         
                <div class="col-lg-8 d-flex">
                  <form action="{{ route('menus.update', $menu) }}" method="POST" role="form" class="php-email-form" data-aos="fade-up" data-aos-delay="100">
                    @csrf
                    @method('PATCH')
                    <div class="row gy-4" style="justify-content: center;">
                      <div class="section-header">
                        <p style="font-size:50px;">Crear <span>Menu</span></p>
                    </div>
                    <div class="col-lg-12">
                        <input type="text" name="nombre" class="form-control" placeholder="Nombre del menú" value="{{$menu->nombre}}">
                        @error('nombre')
                            <div class="error" style="color:#CE1212; margin-left: 15px; font-size:13px;">{{ $message }}</div>
                        @enderror
                        <div class="validate"></div>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Día</th>
                                    <th>Desayuno</th>
                                    <th>Almuerzo</th>
                                    <th>Comida</th>
                                    <th>Cena</th>
                                    <th>Bebida</th>
                                    <th>Postre</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $diasSemana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
                                    $tiposComida = ['Desayuno', 'Almuerzo', 'Comida', 'Cena', 'Bebida', 'Postre'];
                                @endphp
                    
                                @foreach ($diasSemana as $dia)
                                <tr>
                                    <td>{{ $dia }}</td>
                                    @foreach ($tiposComida as $tipo)
                                    <td>
                                        <select name="recetas[{{ $dia }}][{{ $tipo }}]" class="form-select">
                                            <option value="">{{ $tipo }}s</option>
                                            @foreach(${'recetas' . $tipo} as $receta)
                                            <option value="{{ $receta->id }}"
                                                @foreach ($menu->recetas as $recetaMenu)
                                                    @if ($recetaMenu->pivot->dia === $dia && $recetaMenu->pivot->tipo_comida === $tipo && $receta->id === $recetaMenu->id)
                                                        selected
                                                    @endif
                                                @endforeach                                            >
                                                {{ $receta->titulo }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    
                    </div>
                    <div class="text-center"><button type="submit" class="menu__btn">Guardar</button></div>
                  </form>

                </div>
      
              </div>

            </div>

      </main>

</x-deliny-layout>
