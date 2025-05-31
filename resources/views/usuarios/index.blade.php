<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DarkPan - Bootstrap 5 Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/admin/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/admin/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="/" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Ferreteria</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Administrador</h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                   
                    <div class="nav-item dropdown">
                       
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="button.html" class="dropdown-item">Buttons</a>
                            <a href="typography.html" class="dropdown-item">Typography</a>
                            <a href="element.html" class="dropdown-item">Other Elements</a>
                        </div>
                    </div>
           
                     <div class="navbar-nav w-100">
                     <a href="{{route('usuarios.index')}}" class="nav-item nav-link active"><i class="fa fa-keyboard me-2"></i>Formularios</a>
                    <a href="{{route('productos.index')}}" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Productos</a>
                    <a href="{{route('categorias.index')}}" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Categorias</a>
                    <a href="{{route('usuarios.lista')}}" class="nav-item nav-link"><i class="fa fa-table me-2"></i>usuarios</a>
                    <a href="{{route('imagenes.index')}}" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Imagenes</a>
                </div>
                     
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="signin.html" class="dropdown-item">Sign In</a>
                            <a href="signup.html" class="dropdown-item">Sign Up</a>
                            <a href="404.html" class="dropdown-item">404 Error</a>
                            <a href="blank.html" class="dropdown-item">Blank Page</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control bg-dark border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                       
                      
                    </div>
                    <div class="nav-item dropdown">
                      
                      
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
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
    <div class="row g-4">
<!-- Formulario de Productos -->
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Formulario de Productos</h6>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('productos.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="codigo" class="form-label">Código</label>
                                    <input type="text" class="form-control" name="codigo" value="{{ old('codigo') }}" required>
                                    @error('codigo')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="estado" class="form-label">Estado</label>
                                    <select class="form-select" name="estado" required>
                                        <option value="1" {{ old('estado') == 1 ? 'selected' : '' }}>Activo</option>
                                        <option value="0" {{ old('estado') == 0 ? 'selected' : '' }}>Inactivo</option>
                                    </select>
                                    @error('estado')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="precio" class="form-label">Precio</label>
                                    <input type="number" class="form-control" name="precio" value="{{ old('precio') }}" step="0.01" required>
                                    @error('precio')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="descripcion" class="form-label">Descripción</label>
                                    <input type="text" class="form-control" name="descripcion" value="{{ old('descripcion') }}" required>
                                    @error('descripcion')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="nombre_producto" class="form-label">Nombre del Producto</label>
                                    <input type="text" class="form-control" name="nombre_producto" value="{{ old('nombre_producto') }}" required>
                                    @error('nombre_producto')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="cantidad" class="form-label">Cantidad</label>
                                    <input type="number" class="form-control" name="cantidad" value="{{ old('cantidad') }}" required>
                                    @error('cantidad')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="id_imagen" class="form-label">ID de Imagen</label>
                                    <select class="form-select" name="id_imagen" required>
                                        @foreach ($imagenes as $imagen)
                                            <option value="{{ $imagen->id }}" {{ old('id_imagen') == $imagen->id ? 'selected' : '' }}>
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
                                            <option value="{{ $categoria->id }}" {{ old('id_categoria') == $categoria->id ? 'selected' : '' }}>
                                                {{ $categoria->id }} - {{ $categoria->nombre_categoria }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_categoria')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Guardar Producto</button>
                            </form>
                        </div>
                    </div>
        
<!-- Formulario de Categorías -->
<div class="col-sm-12 col-xl-6">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Formulario de Categorías</h6>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('categorias.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nombre_categoria" class="form-label">Nombre de la Categoría</label>
                <input type="text" class="form-control" name="nombre_categoria" value="{{ old('nombre_categoria') }}" required>
                @error('nombre_categoria')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="logo" class="form-label">Logo (Imagen)</label>
                <input type="file" class="form-control" name="logo" accept="image/*" required>
                @error('logo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Guardar Categoría</button>
        </form>
    </div>
</div>

           <!-- Formulario de Usuarios -->
<div class="col-sm-12 col-xl-6">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Formulario de Usuarios</h6>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('usuarios.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" required>
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
                <input type="text" class="form-control" name="telefono" value="{{ old('telefono') }}" required>
                @error('telefono')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="fecha_registro" class="form-label">Fecha de Registro</label>
                <input type="date" class="form-control" name="fecha_registro" value="{{ old('fecha_registro') }}" required>
                @error('fecha_registro')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input type="email" class="form-control" name="correo" value="{{ old('correo') }}" required>
                @error('correo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="tipo_usuario" class="form-label">Tipo de Usuario</label>
                <select class="form-select" name="tipo_usuario" required>
                    <option value="" {{ old('tipo_usuario') == '' ? 'selected' : '' }} disabled>Seleccione un tipo</option>
                    <option value="1" {{ old('tipo_usuario') == '1' ? 'selected' : '' }}>Administrador</option>
                    <option value="2" {{ old('tipo_usuario') == '2' ? 'selected' : '' }}>Cliente</option>
                </select>
                @error('tipo_usuario')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="ruta_imagen_usuario" class="form-label">Imagen de Usuario</label>
                <input type="file" class="form-control" name="ruta_imagen_usuario" accept="image/*" required>
                @error('ruta_imagen_usuario')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Guardar Usuario</button>
        </form>
    </div>
</div>


       <!-- Formulario de Imágenes -->
<div class="col-sm-12 col-xl-6">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Formulario de Imágenes de Productos</h6>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('imagenes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo</label>
                <input type="number" class="form-control" name="tipo" value="{{ old('tipo') }}">
                @error('tipo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="ruta_imagen" class="form-label">Imagen</label>
                <input type="file" class="form-control" name="ruta_imagen" accept="image/*" required>
                @error('ruta_imagen')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Guardar Imagen</button>
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
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/admin/main.js"></script>
</body>

</html>