@extends('alumno.layout_dashboard')

@section("contentwraper")
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row">
            <div class="col-sm-5 mx-auto">
                @if (Session::get('success'))
                <div class="alert alert-primary" role="alert">
                    {{ Session::get('success') }}
                </div>
                @endif
                @if($errors->any())
                @foreach($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    {{$error}}
                </div>
                @endforeach
                @endif
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Nombre curso: {{$curso->Nombre}}</h5>
                                <p class="mt-2">
                                    <span>Descripción:</span>
                                    {{$curso->Descripcion}}
                                </p>

                                <p class="mt-2">
                                    <span>Precio:</span>
                                   S/. {{$curso->Precio}}
                                </p>

                                <form action="{{route('alumno.procesarCompra_curso')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id_curso" value="{{$curso->id}}">
                                    <input type="submit" value="comprar curso" class="btn btn-primary">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

    <div class="content-backdrop fade"></div>
</div>
@endsection