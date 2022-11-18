@extends('teacher.layout_dashboard')

@section("contentwraper")
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between">
            <h3>Secciones</h3>
        </div>


        <div class="row">
            <div class="mb-4">
                <form action="{{route('profesor.ver_secciones')}}" method="post" class="d-flex justify-content-between">
                    @csrf
                    <select class="form-select" aria-label="Default select example" name="id_curso">
                        @forelse ($cursos as $c)
                        @if($c->id == $idCurso)
                        <option value="{{$c->id}}" selected>{{$c->Nombre}} | {{$c->Descripcion}}</option>
                        @else
                        <option value="{{$c->id}}">{{$c->Nombre}} | {{$c->Descripcion}}</option>
                        @endif
                        @empty
                        <option value="">No tienes cursos</option>
                        @endforelse
                    </select>
                    <input type="submit" name="" id="" class="btn btn-primary" value="buscar">
                </form>
            </div>

            @if($idCurso != null)
            <a href="{{route('profesor.crear_seccion', $idCurso)}}" class="btn btn-secondary">
                Registrar Seccion
            </a>
            @endif

            @if (Session::get('success'))
            <div class="alert alert-primary" role="alert">
                {{ Session::get('success') }}
            </div>
            @endif

            @if (Session::get('error'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('error') }}
            </div>
            @endif

            @isset($secciones)
            <table class="table table-responsive">
                <thead>
                    <tr>

                        <th scope="col">Nombre</th>
                        <th scope="col">Desripción</th>
                        <th scope="col">Tiempo</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($secciones as $c)
                    <tr>
                        <td>{{$c->Nombre}}</td>
                        <td>{{$c->Descripción}}</td>
                        <td>{{$c->Tiempo}}</td>
                        <td>
                            <div class="d-flex justify-content-start">
                                <a href="{{route('profesor.lecciones', $c->id)}}" class="me-1">
                                    <button class="btn btn-success btn-sm" style="width:80px;">lecciones</button>
                                </a>

                                <a href="{{route('profesor.editar_seccion', $c->id)}}" class="me-1">
                                    <button class="btn btn-primary btn-sm" style="width:60px;">editar</button>
                                </a>

                                <form method="post" action="{{route('profesor.eliminar_seccion')}}">
                                    @method('delete')
                                    @csrf
                                    <input type="hidden" value="{{$c->id}}" name="id_seccion">
                                    <button type="submit" class="btn btn-danger btn-sm" style="width:60px;">eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">
                            <p>Cursos no cuenta con secciones</p>
                        </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
            @endisset
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