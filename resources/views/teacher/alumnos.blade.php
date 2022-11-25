@extends('teacher.layout_dashboard')

@section("contentwraper")
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between">
            <h3>Alumnos Matriculados Por Curso</h3>
        </div>

        <div class="row">
            <div class="mb-4">
                <form action="{{route('profesor.mostrar_alumnos')}}" method="post" class="d-flex justify-content-between">
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
                    <input type="submit" name="" id="" class="btn btn-primary" value="buscar alumnos">
                </form>
            </div>

            @isset($curso)
            <div class="alert alert-danger">Mostrando alumnos del curso {{$curso->Nombre}}</div>
            @endisset

            <table class="table table-responsive mt-3">
                <thead>
                    <tr>

                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Teléfono</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($alumnos as $a)
                    <tr>
                        <td>{{$a->name}}</td>
                        <td>{{$a->apellido}}</td>
                        <td>{{$a->email}}</td>
                        <td>{{$a->Dirección}}</td>
                        <td>{{$a->telefono}}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <p>Seleccione un curso para mostrar alumnos</p>
                        </td>
                    </tr>
                    @endforelse

                </tbody>
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

    <div class="content-backdrop fade"></div>
</div>
@endsection