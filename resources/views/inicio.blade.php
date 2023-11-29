@php
    $diasSemana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
    $tiposComida = ['Desayuno', 'Almuerzo', 'Comida', 'Cena', 'Bebida', 'Postre'];
@endphp

<x-deliny-layout>
<main>
    <section id="recetas" class="about" style="background-color: #fbfbfb">
        <div class="container aos-init aos-animate" data-aos="fade-up">
            <br><br>
            <div class="section-headerp">
                <h2>Recetas</h2>
                <p>Recetas <span>Creadas</span></p>
            </div>
    
            <ul class="row gy-4">
                @foreach($recetas as $receta)
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="150">
                <div class="call-us d-flex flex-column justify-content-center align-items-center" style="background-color: #ffffff; border-radius: 10px;">
    
                    <div class="d-flex justify-content-between" style="margin-bottom:1em; border-bottom: 1px solid #efefef; padding-bottom: 1em;">
                    <div style="margin-right: 5em;">
                        <i class="bi bi-person" 
                        style="background-color: #ce1212; color: #fff; padding:5px; padding-left: 8px; padding-right:8px; border-radius: 50%; font-size: 20px;"></i>
                        <a href="blog-single.html" style="color: black; margin-left: 3px; font-size: 18px">
                            <b>{{ $receta->user->name }}</b>
                        </a>
                    </div>
                    <div>
                        <a href="blog-single.html" style="color: black; margin-right: 5px; color: #9b9b9b;">{{$receta->created_at->format('d/m/Y H:i')}} <i class="bi bi-clock"></i></a>
                    </div>
                    </div>
                    
                    <h4 style="font-size: 25px">
                    <a href="{{route('recetas.show', $receta->id)}}">
                        {{$receta->titulo}}
                    </a>
                    </h4><br>
    
                    <div>
                    <img src="{{\Storage::url($receta->archivo_ubicacion)}}" alt="{{$receta->titulo}}" class="img-fluid">
                    </div>
    
                    <div class="menu">
                    <ul class="nav nav-tabs d-flex justify-content-center aos-init aos-animate">
                        <li class="nav-item" style="margin-right: 3em"><i class="fas fa-utensils"></i><a style="font-size:12px; margin-left:5px;">{{$receta->tipoComida}}</a>
                        <li class="nav-item" style="margin-right: 1em"><i class="far fa-comment"></i><a href="blog-single.html" style="font-size:12px; margin-left:5px; color:black;">Comentarios</a></li>
                    </ul>
                    </div>
                    
                    <div class="content">
                    <div class="text-center"></div><br>
                    <div class="text-center"><p style="font-size: 14px; color: black;">{{$receta->descripcion}}</p><br></div>
                    </div>
    
                    <div style="display: flex">
                    <a href="{{route('recetas.edit', $receta->id)}}" class="btn btn-danger" style="background-color:#CE1212; font-size:12px; border-radius: 20px; margin-right:20px;">
                        <i class="bi bi-pencil-square"></i>Editar
                    </a>
                    <form action="{{route('recetas.destroy', $receta)}}" method=POST>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="background-color:#CE1212; font-size:12px; border-radius: 20px;">
                        <i class="bi bi-trash"></i>Borrar
                        </button>
                    </form>
                    </div>
                </div>
                </div>
                @endforeach
            </ul>
            <div class="section-headerp">
                <h2>Menús</h2>
                <p>Menús <span>Creados</span></p>
            </div>
            <div class="container" data-aos="fade-up">
                <div class="row g-0">
                    @foreach ($menus as $menu)
                    <h2>{{ $menu->nombre }}</h2>
                    <a href="{{route('menus.show', $menu->id)}}" >
                        <h2 ><strong style="color:black" onmouseover="this.style.color='red'" onmouseout="this.style.color='black'">{{$menu->nombre}} </strong></h2>
                    </a>
                    <p> <a href="{{route('menus.edit', $menu)}}" ><strong>Editar</strong> </a> 
                        <div>
                                    {{--<form action="{{ route('ingredientes.destroy', $ingrediente) }}" method="POST" id="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <br>
                                    <button type="button" class="btn btn-danger" style="background-color:#CE1212;border-radius:20px;" onclick="mostrarConfirmacion()">
                                        <i class="bi bi-trash"></i> Borrar
                                    </button>
                                </form>--}}
                              
                                <script>
                                    function mostrarConfirmacion() {
                                        if (confirm('¿Estás seguro de que deseas borrar este ingrediente?')) {
                                            document.getElementById('delete-form').submit();
                                        }
                                    }
                                </script>
                            </a>
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
        </div>
    </section>
</main>
</x-deliny-layout>