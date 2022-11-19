@extends('alumno.layout_dashboard')

@section("contentwraper")
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between">
            <h3>Cursos Adquiridos</h3>
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
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Idioma</th>
                        <th scope="col">Requisitos</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cursos as $c)
                    <tr>
                        <td>{{$c->Nombre}}</td>
                        <td>{{$c->Descripcion}}</td>
                        <td>{{$c->Precio}}</td>
                        <td>{{$c->Idioma}}</td>
                        <td>{{$c->Requisitos}}</td>
                        <td>
                            <div class="d-flex justify-content-start">
                                <a href="{{route('alumno.miscursos_secciones', $c->id)}}">
                                    <button type="submit" class="btn btn-primary btn-sm me-2" style="width:60px;">iniciar</button>
                                </a>
                                <form method="post" action="{{route('alumno.darbaja_curso')}}">
                                    @method('delete')
                                    @csrf
                                    <input type="hidden" value="{{$c->id}}" name="id_curso">
                                    <button type="submit" class="btn btn-danger btn-sm" style="width:90px;">dar de baja</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center">
                            <p>No cuenta con cursos adquiridos</p>
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