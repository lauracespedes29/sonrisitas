        <!-- FONTS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="/smileapp/css/fontawesome-free-6.6.0-web/css/all.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="/smileapp/css/adminlte.min.css">
    </head>
    <body class="sidebar-mini dark-mode layout-navbar-fixed layout-fixed layout-footer-fixed accent-lightblue" style="height: auto;">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand border-bottom-0 navbar-light bg-lightblue">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color: white;"></i></a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    
                        <a href="/smileapp/controlador/logOut.php" class="btn btn-danger">Cerrar Sesion</a>
                    
                </ul>
            </nav>
            <aside class="main-sidebar elevation-4 sidebar-light-lightblue">
                <a href="/smileapp/vista/adm.php" class="brand-link bg-lightblue">
                    <img src="/smileapp/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">ODONTOLOGIA</span>
                </a>
                <div class="sidebar os-theme-dark" style="overflow-y: auto;">
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="/smileapp/img/avatar.png" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="/smileapp/vista/adm.php" class="d-block">Administrador</a>
                        </div>
                    </div>
                <!-- Navegador -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true"> <!-- El data-accordion="true" es clave aquí -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                            <i class="fa-solid fa-user-tie"></i>
                            <p>
                            Usuarios
                            <i class="right fas fa-angle-left"></i>
                            </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="mostrarUsuarios.php" class="nav-link">
                                    <i class="fa-solid fa-users"></i>
                                    <p>Mostrar Usuarios</p>
                                    </a>
                                </li>
                                
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                            <i class="fa-solid fa-hospital-user"></i>
                            <p>
                            Pacientes
                            <i class="right fas fa-angle-left"></i>
                            </p>
                            </a>
                            <ul class="nav nav-treeview">
                               
                                <li class="nav-item">
                                    <a href="mostrar_paciente.php" class="nav-link">
                                    <i class="fa-solid fa-users"></i>
                                    <p>Mostrar Pacientes</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                            <i class="fa-solid fa-stethoscope"></i>
                            <p>
                            Doctores
                            <i class="right fas fa-angle-left"></i>
                            </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="agregarPaciente.php" class="nav-link">
                                    <i class="nav-icon far fa-image"></i>
                                    <p>Agregar Paciente</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="listaPacientes.php" class="nav-link">
                                    <i class="nav-icon far fa-image"></i>
                                    <p>Lista de Pacientes</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                            <i class="fa-solid fa-kit-medical"></i>
                            <p>
                            Catalogo
                            <i class="right fas fa-angle-left"></i>
                            </p>
                            </a>
                            <ul class="nav nav-treeview">
                                 <li class="nav-item">
                                     <a href="mostrar_articulos.php" class="nav-link">
                                    <i class="nav-icon fas fa-file-alt"></i>
                                    <p>Artículos</p>
                                     </a>
                                </li>

                                <li class="nav-item">
                                    <a href="listaPacientes.php" class="nav-link">
                                    <i class="nav-icon far fa-image"></i>
                                    <p>Lista de Pacientes</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                            <i class="fa-solid fa-tooth"></i>
                            <p>
                            Reservar
                            <i class="right fas fa-angle-left"></i>
                            </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="reservacion_cita.php" class="nav-link">
                                    <i class="nav-icon far fa-image"></i>
                                    <p>Reservar cita</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="calendario.php" class="nav-link">
                                    <i class="nav-icon far fa-image"></i>
                                    <p>Reservaciones</p>
                                    </a>
                                </li>
                               
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                            <i class="fa-solid fa-file-medical"></i>
                            <p>
                            tratamientos
                            <i class="right fas fa-angle-left"></i>
                            </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="tratamientos.php" class="nav-link">
                                    <i class="nav-icon far fa-image"></i>
                                    <p>Lista de tratamientos 
                                    </p>
                                    </a>
                                </li>
                                
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                            <i class="fa-solid fa-chart-line"></i>
                            <p>
                            Ingresos-Gastos
                            <i class="right fas fa-angle-left"></i>
                            </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="agregarPaciente.php" class="nav-link">
                                    <i class="nav-icon far fa-image"></i>
                                    <p>Agregar Paciente</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="listaPacientes.php" class="nav-link">
                                    <i class="nav-icon far fa-image"></i>
                                    <p>Lista de Pacientes</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                            <i class="fa-solid fa-gears"></i>
                            <p>
                            Backup
                            <i class="right fas fa-angle-left"></i>
                            </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="agregarPaciente.php" class="nav-link">
                                    <i class="nav-icon far fa-image"></i>
                                    <p>Agregar Paciente</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="listaPacientes.php" class="nav-link">
                                    <i class="nav-icon far fa-image"></i>
                                    <p>Lista de Pacientes</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                            <i class="fa-solid fa-calendar-days"></i>
                            <p>
                            Agenda
                            <i class="right fas fa-angle-left"></i>
                            </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="agregarPaciente.php" class="nav-link">
                                    <i class="nav-icon far fa-image"></i>
                                    <p>Agregar Paciente</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="listaPacientes.php" class="nav-link">
                                    <i class="nav-icon far fa-image"></i>
                                    <p>Lista de Pacientes</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
        </div>
            </aside>