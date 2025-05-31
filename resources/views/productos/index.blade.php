<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DarkPan - Productos</title>
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

            <!-- Table Start -->
            <div class="container-fluid pt-4 px-4">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <h6 class="mb-4">Tabla de Productos</h6>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID Producto</th>
                            <th>Código</th>
                            <th>Estado</th>
                            <th>Precio</th>
                            <th>Descripción</th>
                            <th>Nombre Producto</th>
                            <th>Cantidad</th>
                            <th>Imagen</th>
                            <th>Categoría</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto)
                            <tr>
                                <td>{{ $producto->id }}</td>
                                <td>{{ $producto->codigo }}</td>
                                <td>{{ $producto->estado ? 'Activo' : 'Inactivo' }}</td>
                                <td>${{ number_format($producto->precio, 2) }}</td>
                                <td>{{ $producto->descripcion }}</td>
                                <td>{{ $producto->nombre_producto }}</td>
                                <td>{{ $producto->cantidad }}</td>
                                <td>
                                    @if ($producto->imagen && $producto->imagen->ruta_imagen)
                                        <img src="{{ asset($producto->imagen->ruta_imagen) }}" alt="{{ $producto->nombre_producto }}" style="width: 50px;">
                                    @else
                                        <span>Sin imagen</span>
                                    @endif
                                </td>
                                <td>{{ $producto->categoria ? $producto->categoria->nombre_categoria : 'Sin categoría' }}</td>
                                <td>
                                    <a href="{{ route('productos.show', $producto->id) }}" class="btn btn-info btn-sm">Ver</a>
                                    <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Table End -->
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