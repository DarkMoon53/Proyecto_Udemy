@extends('alumno.layout_dashboard')

@section("contentwraper")
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex flex-column bd-highlight mb-3">
            <h3>Curso {{$curso->Nombre}}</h3>
            <div class="p-2 bd-highlight">
                <p><span>Profesor:</span> {{$profesor->name}} {{$profesor->apellido}}</p>
                <p><span>Correo:</span> {{$profesor->email}}</p>
            </div>
        </div>


        @if (Session::get('success'))
        <div class="alert alert-primary" role="alert">
            {{ Session::get('success') }}
        </div>
        @endif
        <h3>Secciones</h3>
        <div class="row mt-1">
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Tiempo</th>
                        <th scope="col">Actualizado</th>
                        <th scope="col">Empezar sección</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($secciones as $s)
                    <tr>
                        <td>{{$s->Nombre}}</td>
                        <td>{{$s->Descripción}}</td>
                        <td>{{$s->Tiempo}}</td>
                        <td>{{$s->updated_at}}</td>
                        <td>
                            <div class="d-flex justify-content-start">
                                <a href="{{route('alumno.miscursos_lecciones', $s->id)}}">
                                    <button type="submit" class="btn btn-primary btn-sm me-2" style="width:150px;">empezar</button>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center">
                            <p>Curso {{$curso->Nombre}} no cuenta con secciones</p>
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