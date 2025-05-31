<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DarkPan - Editar Producto</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="{{ asset('img/favicon.ico') }}" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/admin/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/style.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="/" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Ferreteria</h3>
                </a>
                <div class="navbar-nav w-100">
                    <a href="{{ route('usuarios.index') }}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Formularios</a>
                    <a href="{{ route('productos.index') }}" class="nav-item nav-link active"><i class="fa fa-table me-2"></i>Productos</a>
                    <a href="{{ route('categorias.index') }}" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Categorías</a>
                    <a href="{{ route('usuarios.lista') }}" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Usuarios</a>
                    <a href="{{ route('imagenes.index') }}" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Imágenes</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="{{ asset('img/user.jpg') }}" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">John Doe</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="#" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

            <!-- Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">Editar Producto</h6>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('productos.update', $producto->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="codigo" class="form-label">Código</label>
                            <input type="text" class="form-control" name="codigo" value="{{ old('codigo', $producto->codigo) }}" required>
                            @error('codigo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" name="estado" required>
                                <option value="1" {{ old('estado', $producto->estado) == 1 ? 'selected' : '' }}>Activo</option>
                                <option value="0" {{ old('estado', $producto->estado) == 0 ? 'selected' : '' }}>Inactivo</option>
                            </select>
                            @error('estado')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="number" class="form-control" name="precio" value="{{ old('precio', $producto->precio) }}" step="0.01" required>
                            @error('precio')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <input type="text" class="form-control" name="descripcion" value="{{ old('descripcion', $producto->descripcion) }}" required>
                            @error('descripcion')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nombre_producto" class="form-label">Nombre del Producto</label>
                            <input type="text" class="form-control" name="nombre_producto" value="{{ old('nombre_producto', $producto->nombre_producto) }}" required>
                            @error('nombre_producto')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="cantidad" class="form-label">Cantidad</label>
                            <input type="number" class="form-control" name="cantidad" value="{{ old('cantidad', $producto->cantidad) }}" required>
                            @error('cantidad')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="id_imagen" class="form-label">ID de Imagen</label>
                            <select class="form-select" name="id_imagen" required>
                                @foreach ($imagenes as $imagen)
                                    <option value="{{ $imagen->id }}" {{ old('id_imagen', $producto->id_imagen) == $imagen->id ? 'selected' : '' }}>
                                        {{ $imagen->id }} - {{ $imagen->ruta_imagen }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_imagen')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="id_categoria" class="form-label">ID de Categoría</label>
                            <select class="form-select" name="id_categoria" required>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" {{ old('id_categoria', $producto->id_categoria) == $categoria->id ? 'selected' : '' }}>
                                        {{ $categoria->id }} - {{ $categoria->nombre_categoria }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_categoria')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar Producto</button>
                    </form>
                </div>
            </div>
            <!-- Form End -->
        </div>
        <!-- Content End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('js/admin/main.js') }}"></script>
</body>

</html>