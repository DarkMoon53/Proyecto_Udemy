@extends('teacher.layout_dashboard')

@section("contentwraper")
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between">
            <h3>Lecciones de la sección con nombre: {{$seccion->Nombre}}</h3>
            <a href="{{route('profesor.crear_leccion', $seccion->id)}}">
                <button type="button" class="btn btn-primary">Agregar leccion</button>
            </a>
        </div>

        @if (Session::get('success'))
        <div class="alert alert-primary" role="alert">
            {{ Session::get('success') }}
        </div>
        @endif

        <div class="row mt-3">
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Tiempo</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($lecciones as $l)
                    <tr>
                        <th scope="row">{{$l->id}}</th>
                        <td>{{$l->Nombre}}</td>
                        <td>{{$l->Tiempo}}</td>
                        <td>
                            <div class="d-flex justify-content-start">
                                <a href="{{route('profesor.ver_leccion', $l->id)}}">
                                    <button type="submit" class="btn btn-secondary btn-sm me-2" style="width:60px;">ver</button>
                                </a>
                                <a href="{{route('profesor.editar_leccion', $l->id)}}">
                                    <button type="submit" class="btn btn-primary btn-sm me-2" style="width:60px;">editar</button>
                                </a>
                                <form method="post" action="{{route('profesor.eliminar_leccion', $l->id)}}">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm" style="width:60px;">eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center">
                            <p>Sin Lecciones Registradas</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            </table>
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