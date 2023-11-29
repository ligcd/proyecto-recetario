<x-deliny-layout>
    @php
        $diasSemana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
        $tiposComida = ['Desayuno', 'Almuerzo', 'Comida', 'Cena', 'Bebida', 'Postre'];
    @endphp
    <main id="main">
        <div class="container" data-aos="fade-up">
            <div class="row g-0">
                @foreach ($menus as $menu)
                <h2>{{ $menu->nombre }}</h2>
                <a href="{{route('menus.show', $menu->id)}}" >
                    <h2 ><strong style="color:black" onmouseover="this.style.color='red'" onmouseout="this.style.color='black'">{{$menu->nombre}} </strong></h2>
                </a>
                <p> <a href="{{route('menus.edit', $menu)}}" ><strong>Editar</strong> </a> 
                    <div>
                        <form action="{{ route('menus.destroy', $menu) }}" method="POST" id="delete-form">
                            @csrf
                            @method('DELETE')
                            <br>
                            <button type="button" class="btn btn-danger" style="background-color:#CE1212;border-radius:20px;" onclick="mostrarConfirmacion()">
                                <i class="bi bi-trash"></i> Borrar
                            </button>
                        </form>                          
                        <script>
                            function mostrarConfirmacion() {
                                if (confirm('¿Estás seguro de que deseas borrar este menu?')) {
                                    document.getElementById('delete-form').submit();
                                }
                            }
                        </script>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                {{--Título columnas - Comida--}}
                                <th>Día</th>
                                @foreach ($tiposComida as $tipo)
                                    <th>{{$tipo}}</th> 
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($diasSemana as $dia) {{--Título filas - días--}}
                                @php
                                    $recetasDia = $menu->recetas->filter(function ($receta) use ($dia) {
                                        return $receta->pivot->dia === $dia;
                                    });
                                @endphp

                                @if ($recetasDia->isNotEmpty())
                                    <tr>
                                        <td>{{ $dia }}</td>
                                        @foreach ($tiposComida as $tipo) {{--Iteración sobre los días con tipo de comida --}}
                                            <td>
                                                @foreach ($menu->recetas as $receta)  {{-- Itera sobre las recetas asociadas al menú --}}
                                                    @if ($receta->pivot->dia === $dia && $receta->pivot->tipo_comida === $tipo)  {{-- Verifica si la receta coincide con el día y tipo de comida actuales(iteración) --}}
                                                        {{--Accediendo a datos de la tabla pivot--}}

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
                @endforeach
                
            </div>
        </div>
    </main>

</x-deliny-layout>
