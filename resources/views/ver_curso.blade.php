@extends('layouts.app')

@section('content')
<div class="row w-100">
    <div class="mb-4 ms-5 me-5 d-flex justify-content-start">
    </div>
</div>

<div class="container d-flex justify-content-center mt-50 mb-50">

    <div class="row">

        <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="d-flex justify-content-center">
                    <h1 class="text-center">{{$curso->Nombre}}</h1>
                    <a href="{{route('alumno.comprar_curso', $curso->id)}}">
                        <button type="button" class="btn bg-cart"><i class="fa fa-cart-plus mr-2"></i> Comprar</button>
                    </a>
                </div>

                @if (Session::get('success'))
                <div class="alert alert-primary" role="alert">
                    {{ Session::get('success') }}
                </div>
                @endif

                <div class="row mt-3">
                    <h4>Secciones</h4>
                    <ul class="list-group">
                        @foreach($secciones as $sec)
                        <li class="list-group-item">
                            <div>
                                <p>{{$sec->Nombre}}</p>
                            </div>
                            <ul class="list-group">
                                <h5>Lecciones</h5>
                                @foreach($sec->lecciones as $lec)
                                <li class="list-group-item">
                                    <div>
                                        <p>{{$lec->Nombre}}, tiempo: {{$lec->Tiempo}}</p>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        @endforeach
                    </ul>
                </div>

            </div>
            <!-- / Content -->
        </div>
    </div>
</div>

@endsection