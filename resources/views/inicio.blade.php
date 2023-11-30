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
            @if(empty($recetas))
                <div class="alert alert-info mt-3" role="alert">
                    Aún no hay recetas disponibles.
                </div>
            @else
                <ul class="row gy-4">
                    @foreach($recetas as $receta)
                        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="150">
                            <div class="call-us d-flex flex-column justify-content-center align-items-center" style="background-color: #ffffff; border-radius: 10px;">
                                <div class="d-flex justify-content-between" style="margin-bottom:1em; border-bottom: 1px solid #efefef; padding-bottom: 1em;">
                                    <div style="margin-right: 5em;">
                                        <i class="bi bi-person" style="background-color: #ce1212; color: #fff; padding:5px; padding-left: 8px; padding-right:8px; border-radius: 50%; font-size: 20px;"></i>
                                        <a href="" style="color: black; margin-left: 3px; font-size: 18px">
                                            <b>{{ $receta->user->name }}</b>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="" style="color: black; margin-right: 5px; color: #9b9b9b;">{{$receta->created_at->format('d/m/Y H:i')}} <i class="bi bi-clock"></i></a>
                                    </div>
                                </div>
                                <h4 style="font-size: 25px">
                                    <a href="{{route('recetas.show', $receta->id)}}">
                                        {{$receta->titulo}}
                                    </a>
                                </h4><br>
                                <div>
                                    <a href="{{route('recetas.show', $receta->id)}}">
                                        <img src="{{\Storage::url($receta->archivo_ubicacion)}}" alt="{{$receta->titulo}}" class="img-fluid">
                                    </a>
                                </div>
                                <div class="menu">
                                    <ul class="nav nav-tabs d-flex justify-content-center aos-init aos-animate">
                                        <li class="nav-item" style="margin-right: 3em"><i class="fas fa-utensils"></i><a style="font-size:12px; margin-left:5px;">{{$receta->tipoComida}}</a>
                                        <li class="nav-item" style="margin-right: 1em"><i class="far fa-comment"></i><a href="" style="font-size:12px; margin-left:5px; color:black;">Comentarios</a></li>
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
            @endif
            <a href="{{ route('recetas.create') }}" class="crearmenu__btn">Crear Nueva Receta</a>
        </div>
    </section>
    
    <section>
        <div class="section-headerp">
            <h2>Menús</h2>
            <p>Menús <span>Creados</span></p>
        </div>
        <div class="container" data-aos="fade-up">
            <div class="row g-0">
                @if(empty($menus))
                <div class="alert alert-info mt-3" role="alert">
                    Aún no has creado menús semanales.
                </div>
            @else
                @foreach ($menus as $menu)
                    <a href="{{route('menus.show', $menu->id)}}" >
                        <h2 ><strong style="color:black" onmouseover="this.style.color='red'" onmouseout="this.style.color='black'">{{$menu->nombre}} </strong></h2>
                    </a>
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
                @endforeach    
            </div>
            @endif
            <a href="{{ route('menus.index') }}" class="crearmenu__btn">Administrar Menús</a>
        </div>
    </section>
</main>

</x-deliny-layout>