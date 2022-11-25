@extends('admin.layout_dashboard')

@section("contentwraper")
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h2>Categorias
        </h2>

        @if (Session::get('success'))
        <div class="alert alert-primary" role="alert">
            {{ Session::get('success') }}
        </div>
        @endif

        <div class="row">
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Actividad</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($usuarios as $u)
                    <tr>
                        <td>{{$u->name}}</td>
                        <td>{{$u->email}}</td>
                        <td>{{$u->apellido}}</td>
                        <td>{{$u->Dirección}}</td>
                        <td>{{$u->telefono}}</td>
                        <td>
                            @if($u->estado == 1)
                            <div class="alert alert-success">activo</div>
                            @else
                            <div class="alert alert-danger">inactivo</div>
                            @endif
                        </td>
                        <td>{{$u->role->Nombre}}</td>
                        <td>
                            @if($u->estado == 1)
                            <form method="post" action="{{route('admin.dar_baja_usuario')}}">
                                @csrf
                                <input type="hidden" name="id_usuario" value="{{$u->id}}">
                                <button type="submit" class="btn btn-danger btn-sm" style="width:70px;">dar baja</button>
                            </form>
                            @else
                            <form method="post" action="{{route('admin.activar_usuario')}}">
                                @csrf
                                <input type="hidden" name="id_usuario" value="{{$u->id}}">
                                <button type="submit" class="btn btn-success btn-sm" style="width:70px;">activar</button>
                            </form>
                            @endif

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">
                            <p>Usuarios no registrados</p>
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