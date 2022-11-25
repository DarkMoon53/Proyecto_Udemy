@extends('alumno.layout_dashboard')

@section("contentwraper")
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
            <h4>Profesor</h4>
            <div>
                <p>{{$profesor->name}} {{$profesor->apellido}}, contacto: "{{$profesor->email}}"</p>
            </div>
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

    <!-- Footer -->
    <footer class="content-footer footer bg-footer-theme">
        <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
            <div class="mb-2 mb-md-0">
                ©
                <script>
                    document.write(new Date().getFullYear());
                </script>
                , made with ❤️ by
                <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
            </div>
            <div>
                <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

                <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/" target="_blank" class="footer-link me-4">Documentation</a>

                <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues" target="_blank" class="footer-link me-4">Support</a>
            </div>
        </div>
    </footer>
    <!-- / Footer -->
</div>
@endsection