@extends('teacher.layout_dashboard')

@section("contentwraper")
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between">
            <h3>Cursos mas vendidos</h3>
        </div>

        <div class="row">
            <table class="table table-responsive mt-3">
                <thead>
                    <tr>

                        <th scope="col">Nombre Curso</th>
                        <th scope="col">Precio Individual</th>
                        <th scope="col">Cantidad Vendidos</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($masVendidos as $mv)
                    <tr>
                        <td>{{$mv->curso->Nombre}}</td>
                        <td>{{$mv->curso->Precio}}</td>
                        <td>{{$mv->cantidad}}</td>
                        <td>{{$mv->total}}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <p>No cuenta con cursos vendidos</p>
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