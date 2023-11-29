<x-deliny-layout>
    @php
        $diasSemana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
        $tiposComida = ['Desayuno', 'Almuerzo', 'Comida', 'Cena', 'Bebida', 'Postre'];
    @endphp
    <main id="main">
        <section>
            <div class="section-headerp" style="margin-top: 70px">
                <h2>Menús</h2>
                <p>Menús <span>Creados</span></p>
            </div>
            <div class="container" data-aos="fade-up">
                <div class="row g-0">
                @if(count($menus) === 0)
                    <div class="alert alert-info mt-3" role="alert">
                        Aún no has creado menús semanales.
                    </div>
                @else
                    @foreach ($menus as $menu)
                        <a href="{{route('menus.show', $menu->id)}}" >
                            <h2 ><strong style="color:black" onmouseover="this.style.color='red'" onmouseout="this.style.color='black'">{{$menu->nombre}} </strong></h2>
                        </a>
                        <div style="overflow-x: auto; background-color:#fdfdfd;">
                            <a href="{{route('menus.show', $menu->id)}}" >
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Día</th>
                                            @foreach ($tiposComida as $tipo)
                                                <th>{{$tipo}}</th> 
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($diasSemana as $dia)
                                            @php
                                                $recetasDia = $menu->recetas->filter(function ($receta) use ($dia) {
                                                    return $receta->pivot->dia === $dia;
                                                });
                                            @endphp
            
                                            @if ($recetasDia->isNotEmpty())
                                                <tr>
                                                    <td>{{ $dia }}</td>
                                                    @foreach ($tiposComida as $tipo)
                                                        <td>
                                                            @foreach ($menu->recetas as $receta)
                                                                @if ($receta->pivot->dia === $dia && $receta->pivot->tipo_comida === $tipo)
                                                                    <a href="{{ route('recetas.show', $receta->id) }}">{{ $receta->titulo }}</a>
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </a>
                            <div class="menu__acciones">
                                <p style="margin-right: 10px;"> 
                                    <a href="{{ route('menus.edit', $menu) }}"><strong>Editar</strong></a>
                                </p>
                                <form action="{{ route('menus.destroy', $menu) }}" method="POST" id="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger" style="background-color:#CE1212;border-radius:20px;" onclick="mostrarConfirmacion()">
                                        <i class="bi bi-trash"></i> Borrar
                                    </button>
                                </form>
                            </div>
                            <script>
                                function mostrarConfirmacion() {
                                    if (confirm('¿Estás seguro de que deseas borrar este menu?')) {
                                        document.getElementById('delete-form').submit();
                                    }
                                }
                            </script>
                        </div>
                    @endforeach    
                </div>
                @endif
                <a href="{{ route('menus.create') }}" class="crearmenu__btn">Crear Nuevo Menú</a>
            </div>
        </section>
    </main>

    

</x-deliny-layout>
