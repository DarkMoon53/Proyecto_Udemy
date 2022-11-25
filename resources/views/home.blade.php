@extends('layouts.app')

@section('content')
<div class="row w-100">
    <div class="mb-4 ms-5 me-5 d-flex justify-content-start">
        <form action="{{route('cursos.categoria')}}" method="post" class="d-flex justify-content-between">
            @csrf
            <select class="form-select" aria-label="Default select example" name="id_categoria">
                <option value="0" selected>Todos</option>
                @forelse ($categorias as $c)
                @if($c->id == $idCategoria)
                <option value="{{$c->id}}" selected>{{$c->Nombre}}</option>
                @else
                <option value="{{$c->id}}">{{$c->Nombre}}</option>
                @endif
                @empty
                <option value="">No hay secciones</option>
                @endforelse
            </select>
            <input type="submit" name="" id="" class="btn btn-primary" value="filtrar">
        </form>
    </div>
</div>

<div class="container d-flex justify-content-center mt-50 mb-50">

    <div class="row">

        @forelse($cursos as $cur)
        <div class="col-md-4 mt-2">


            <div class="card">
                <div class="card-body">
                    <div class="card-img-actions">

                        <img src="{{URL::asset('img/general.jpg')}}" class="card-img img-fluid" width="96" height="350" alt="">


                    </div>
                </div>

                <div class="card-body bg-light text-center">
                    <div class="mb-2">
                        <h6 class="font-weight-semibold mb-2">
                            <a href="{{route('ver_curso_general', $cur->id)}}" class="text-default mb-2" data-abc="true">{{$cur->Nombre}}</a>
                        </h6>
                        <p class="tex">{{$cur->Descripcion}}</a>
                    </div>

                    <h3 class="mb-0 font-weight-semibold">S/. {{$cur->Precio}}</h3>

                    <div>
                        <i class="fa fa-star star"></i>
                        <i class="fa fa-star star"></i>
                        <i class="fa fa-star star"></i>
                        <i class="fa fa-star star"></i>
                    </div>

                    <a href="{{route('curso.comprar', $cur->id)}}">
                        <button type="button" class="btn bg-cart"><i class="fa fa-cart-plus mr-2"></i> Comprar</button>
                    </a>
                </div>
            </div>

        </div>
        @empty
        <div class="alert alert-primary">
            Aun no hay cursos registrados
        </div>
        @endforelse
    </div>
</div>

@endsection