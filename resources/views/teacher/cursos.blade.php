@extends('teacher.layout_dashboard')

@section("contentwraper")
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between">
            <h3>Cursos Registrados</h3>
            <a href="{{route('profesor.crear_curso')}}"><button type="button" class="btn btn-primary">Agregar</button></a>
        </div>

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

        <div class="row">
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">img</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Desripción</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Idioma</th>
                        <th scope="col">Requisitos</th>
                        <th scope="col">Objetivos</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cursos as $c)
                    <tr>
                        <th scope="row">{{$c->id}}</th>
                        <th scope="row">
                            @if($c->img != null)
                            <img src="{{URL::asset("images/$c->img")}}" alt="" width="100">
                            @else
                            <img src="{{URL::asset("img/general.jpg")}}" alt="" width="100">
                            @endif

                        </th>
                        <td>{{$c->Nombre}}</td>
                        <td>{{$c->Descripcion}}</td>
                        <td>{{$c->Precio}}</td>
                        <td>{{$c->Idioma}}</td>
                        <td>{{$c->Requisitos}}</td>
                        <td>{{$c->Objetivos}}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="{{route('profesor.editar_curso', $c->id)}}">
                                    <button type="submit" class="btn btn-primary btn-sm" style="width:60px;">editar</button>
                                </a>
                                <form method="post" action="{{route('profesor.eliminar_curso', $c->id)}}">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm" style="width:60px;">eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">
                            <p>Sin Cursos Registrados</p>
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

    <div class="content-backdrop fade"></div>
</div>
@endsection