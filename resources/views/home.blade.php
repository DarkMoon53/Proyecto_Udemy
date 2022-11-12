@extends('layouts.app')

@section('content')
<!--<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Bienvenido a Udemy 2.0') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Cursos Mostrar') }}
                </div>
            </div>
        </div>
    </div>
</div>-->

<div class="container-fluid">
<nav class="navbar navbar-expand-md navbar-light bg-light border-3 border-bottom border-primary">
<div class="container-fluid">
    <a href="#" class="navbar-brand">Probando</a>
</div>
</nav>
</div>


@endsection