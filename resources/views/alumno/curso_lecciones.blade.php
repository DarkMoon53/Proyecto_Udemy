@extends('alumno.layout_dashboard')

@section("contentwraper")
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h3>Lecciones de la sección {{$seccion->Nombre}}</h3>
        <h4>Leccion {{$seccion->Descripción}}</h4>
        <div class="row mt-1">
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Tiempo</th>
                        <th scope="col">Clase</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($lecciones as $l)
                    <tr>
                        <td>{{$l->Nombre}}</td>
                        <td>{{$l->Tiempo}}</td>
                        <td>
                            <div class="d-flex justify-content-start">
                                <a href="{{route('alumno.miscursos_ver_leccion', $l->id)}}">
                                    <button type="submit" class="btn btn-primary btn-sm me-2" style="width:150px;">ver clase</button>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center">
                            <p>Seccion {{$seccion->Nombre}} no cuenta con lecciones</p>
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