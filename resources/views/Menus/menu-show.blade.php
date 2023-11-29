<x-deliny-layout>
    @php
        $diasSemana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
        $tiposComida = ['Desayuno', 'Almuerzo', 'Comida', 'Cena', 'Bebida', 'Postre'];
    @endphp
    <main id="main">
        <!-- ======= Book A Table Section ======= -->
        <section id="book-a-table" class="book-a-table">
            <div class="container" data-aos="fade-up">
      
            <div class="row g-0">
                <div class="section-headerp">
                    <p>{{ $menu->nombre }}</p>
                </div>
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
                    @foreach ($diasSemana as $dia) {{--Título filas - días--}}
                        @php
                            $recetasDia = $menu->recetas->filter(function ($receta) use ($dia) {
                                return $receta->pivot->dia === $dia;
                            });
                        @endphp
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
                    @endforeach
                </tbody>
            </table>
            </div>
            <form action="{{ route('menus.destroy', $menu) }}" method="POST" id="delete-form">
                @csrf
                @method('DELETE')
                <br>
                <button type="button" class="btn btn-danger" style="background-color:#CE1212;border-radius:20px;" onclick="mostrarConfirmacion()">
                    <i class="bi bi-trash"></i> Borrar Menu
                </button>
            </form>
        </div>
    </section>
</main>

    <script>
        function mostrarConfirmacion() {
            if (confirm('¿Realmente deseas borrar este menú?')) {
                document.getElementById('delete-form').submit();
            }
        }
    </script>

</x-deliny-layout>