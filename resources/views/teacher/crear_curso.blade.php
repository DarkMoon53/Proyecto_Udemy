@extends('teacher.layout_dashboard')

@section("contentwraper")
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h3 class="text-center">Registrar Curso</h3>

        <div class="row">
            <div class="col-sm-5 mx-auto">
                @if (Session::get('success'))
                <div class="alert alert-primary" role="alert">
                    {{ Session::get('success') }}
                </div>
                @endif
                <form action="{{route('profesor.registrar_curso')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Categoria</label>
                        <select class="form-select" aria-label="Default select example" name="id_categoria">
                            @forelse ($categorias as $c)
                            <option value="{{$c->id}}">{{$c->Nombre}}</option>
                            @empty
                            <option value="">No hay Cursos registrados</option>
                            @endforelse
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="Nombre" value="{{old('Nombre')}}">
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Descripción</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="Descripcion" value="{{old('Descripcion')}}">
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Precio</label>
                        <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="" name="Precio" value="{{old('Precio')}}" step="0.01">
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Idioma</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="Idioma" value="{{old('Idioma')}}">
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Requistos</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="Requisitos" value="{{old('Requisitos')}}">
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Objetivos</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="Objetivos" value="{{old('Objetivos')}}">
                    </div>

                    <input type="submit" name="" id="" class="btn btn-primary" value="registrar">
                </form>

                @if($errors->any())
                @foreach($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    {{$error}}
                </div>
                @endforeach
                @endif
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