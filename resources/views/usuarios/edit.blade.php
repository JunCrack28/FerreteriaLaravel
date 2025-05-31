<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DarkPan - Editar Usuario</title>
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
                     <a href="{{route('productos.index')}}" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Productos</a>
                    <a href="{{ route('categorias.index') }}" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Categorías</a>
                    <a href="{{ route('usuarios.lista') }}" class="nav-item nav-link active"><i class="fa fa-table me-2"></i>Usuarios</a>
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
                    <h6 class="mb-4">Editar Usuario</h6>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('usuarios.update', $usuario) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $usuario->nombre) }}" required>
                            @error('nombre')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="contrasena" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" name="contrasena" required>
                            @error('contrasena')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" name="telefono" value="{{ old('telefono', $usuario->telefono) }}" required>
                            @error('telefono')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="fecha_registro" class="form-label">Fecha de Registro</label>
                            <input type="date" class="form-control" name="fecha_registro" value="{{ old('fecha_registro', $usuario->fecha_registro) }}" required>
                            @error('fecha_registro')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo</label>
                            <input type="email" class="form-control" name="correo" value="{{ old('correo', $usuario->correo) }}" required>
                            @error('correo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tipo_usuario" class="form-label">Tipo de Usuario</label>
                            <select class="form-select" name="tipo_usuario" required>
                                <option value="1" {{ old('tipo_usuario', $usuario->tipo_usuario) == '1' ? 'selected' : '' }}>Administrador</option>
                                <option value="2" {{ old('tipo_usuario', $usuario->tipo_usuario) == '2' ? 'selected' : '' }}>Cliente</option>
                            </select>
                            @error('tipo_usuario')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="ruta_imagen_usuario" class="form-label">Imagen de Usuario</label>
                            <input type="file" class="form-control" name="ruta_imagen_usuario" accept="image/*">
                            @error('ruta_imagen_usuario')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            @if ($usuario->ruta_imagen_usuario)
                                <p>Imagen actual: <img src="{{ asset($usuario->ruta_imagen_usuario) }}" alt="{{ $usuario->nombre }}" style="width: 50px;"></p>
                            @else
                                <p>Imagen actual: <span>Sin imagen</span></p>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
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