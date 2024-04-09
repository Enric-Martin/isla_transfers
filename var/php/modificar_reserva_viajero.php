<?php
// Sesión inciada
session_start();

// Incluir el archivo uso_de_usuario.php
require_once 'uso_de_usuario.php';

// Crear una instancia de la clase UsoUsuario
$userManager = new UsoUsuario($pdo);

$id_admin = $userManager->obtenerDatosUsuario('id_admin'); // Obtén el ID del admin
$_SESSION['id_admin'] = $id_admin; // Asigna el ID del admin a la sesión

// Obtener el ID de la reserva enviado desde el formulario
$id_reserva = $_POST['id_reserva'];

// Preparar la consulta para obtener los detalles de la reserva por su ID
$stmt = $pdo->prepare("SELECT * FROM transfer_reservas WHERE id_reserva = :id_reserva");

// Ejecutar la consulta con el ID de la reserva
$stmt->execute(['id_reserva' => $id_reserva]);

// Obtener los detalles de la reserva
$reserva = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>TRAVELER - Free Travel Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-light pt-3 d-none d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 text-center text-lg-left mb-2 mb-lg-0">
                    <div class="d-inline-flex align-items-center">
                        <p><i class="fa fa-envelope mr-2"></i>info@islatransfer.com</p>
                        <p class="text-body px-3">|</p>
                        <p><i class="fa fa-phone-alt mr-2"></i>+930 000 512</p>
                    </div>
                </div>
                <div class="col-lg-6 text-center text-lg-right">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-primary px-3" href="https://www.facebook.com/">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-primary px-3" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-primary px-3" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-primary px-3" href="">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="text-primary pl-3" href="">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <div class="container-fluid position-relative nav-bar p-0">
        <div class="container-lg position-relative p-0 px-lg-3" style="z-index: 9;">
            <nav class="navbar navbar-expand-lg bg-light navbar-light shadow-lg py-3 py-lg-0 pl-3 pl-lg-5">
                <a href="index.html" class="navbar-brand">
                    <h1 class="m-0 text-primary"><span class="text-dark">ISLA</span>TRANSFER</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                    <div class="navbar-nav ml-auto py-0">
                        <a href="index.html" class="nav-item nav-link active">Home</a>
                        <a href="sobre_nosotros.html" class="nav-item nav-link">Sobre nosotros</a>
                        <a href="formulario_viajero.php" class="nav-item nav-link">Reguístrate</a>
                        <a href="log_in.html" class="nav-item nav-link">Log in</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Header Start -->
    <div class="container-fluid page-header">
        <div class="container">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                <h3 class="display-4 text-white text-uppercase">Modifica la reserva</h3>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Booking Start -->
    <form action="registrar_modificacion_reserva_viajero.php" method="post">
        <div class="container-fluid booking mt-5 pb-5">
            <div class="container pb-5">
                <div class="bg-light shadow" style="padding: 40px;">
                    <div class="row align-items-center" style="min-height: 60px;">
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3 mb-md-0">
                                        <select class="custom-select px-4" style="height: 47px; width: 200px" name="tipo_reserva" required>
                                            <option selected>Tipo reserva</option>
                                            <option value="1">Aeropuerto a hotel</option>
                                            <option value="2">Hotel a aeropuerto</option>
                                            <option value="3">Ida y vuelta</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3" id="email_viajero" style="display: block;">
                                    <div class="mb-3 mb-md-0">
                                        <input type="text" class="form-control p-4" placeholder="Email del Viajero" name="email_cliente" value="<?php echo $reserva['email_cliente']; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 mb-md-0">
                                        <select class="custom-select px-4" style="height: 47px; width: 200px; display: block;" id='hotel' name="hotel" required>
                                            <option selected>Hotel</option>
                                            <option value="1">Hotel Backend</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3" id="fecha_entrada" style="display: block;">
                                    <div class="mb-3 mb-md-0">
                                        <input type="text" class="form-control p-4" placeholder="Fecha de Entrada" name="fecha_entrada" value="<?php echo $reserva['fecha_entrada']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3" id="hora_entrada" style="display: block;">
                                    <div class="mb-3 mb-md-0">
                                        <input type="text" class="form-control p-4" placeholder="Hora de Entrada" name="hora_entrada" value="<?php echo $reserva['hora_entrada']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3" id="numero_vuelo_entrada" style="display: block;">
                                    <div class="mb-3 mb-md-0">
                                        <input type="text" class="form-control p-4" placeholder="Numero vuelo entrada" name="numero_vuelo_entrada" value="<?php echo $reserva['numero_vuelo_entrada']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3" id="origen_vuelo_entrada" style="display: block;">
                                    <div class="mb-3 mb-md-0">
                                        <input type="text" class="form-control p-4" placeholder="Origen vuelo entrada" name="origen_vuelo_entrada" value="<?php echo $reserva['origen_vuelo_entrada']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3" id="hora_vuelo_salida" style="display: block;">
                                    <div class="mb-3 mb-md-0">
                                        <input type="text" class="form-control p-4" placeholder="Hora vuelo salida" name="hora_vuelo_salida" value="<?php echo $reserva['hora_vuelo_salida']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3" id="fecha_salida" style="display: block;">
                                    <div class="mb-3 mb-md-0">
                                        <input type="text" class="form-control p-4" placeholder="Fecha Salida" name="fecha_salida" value="<?php echo $reserva['fecha_vuelo_salida']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3" id="num_viajeros" style="display: block;">
                                    <div class="mb-3 mb-md-0">
                                        <input type="text" class="form-control p-4" placeholder="Número viajeros" name="num_viajeros" required value="<?php echo $reserva['num_viajeros']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 mb-md-0">
                                        <select class="custom-select px-4" style="height: 47px; width: 200px; display: block;" id='vehiculo'placeholder="vehiculo" name="tipo_vehiculo" required>
                                            <option selected>Vehiculo</option>
                                            <option value="1">Toyota Pryus</option>
                                            <option value="2">Honda Accord</option>
                                            <option value="3">Nissan Skyline</option>
                                        </select>
                                    </div>
                                </div>
                                <div style="display: none;">
                                    <input type="text" name="id_reserva" value="<?php echo $id_reserva; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary btn-block" type="submit" style="height: 47px; margin-top: -2px; display: block;" id='boton_submit' name="accion" value="modificar">Modificar</button>
                            <button class="btn btn-primary btn-block" type="submit" style="height: 47px; margin-top: 10px; display: block;" id='boton_submit' name="accion" value="cancelar">Anular Reserva</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Booking End -->

    <!-- Mi perfil -->
    <div class="d-flex flex-column text-center bg-white mb-5 py-5 px-4">
            <h2>MI PERFIL</h2>

            <h3 class="text-primary mb-3"><?php echo $userManager->obtenerDatosUsuario('nombre'); ?></h3>
            <h3 class="text-primary mb-3"><?php echo $userManager->obtenerDatosUsuario('email'); ?></h3>


            <!-- Formulario modificación perfil-->
            <!-- Agrega un formulario de modificación de perfil con campos ocultos -->
            <form id="formModificarPerfil" action="modificar_perfil_admin.php" method="post">
                <div id="camposModificacion" style="display: none;">
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre"><br><br>
                    <input type="text" id="email" name="email" placeholder="Email"><br><br>
                    <input type="password" id="contrasena" name="contrasena" placeholder="Contraseña"><br><br>
                    <input type="submit" value="Guardar cambios">
                </div>
            </form>

            <div class="d-flex justify-content-center">
                <button class="btn btn-primary btn-block justify-content-center" type="submit" id="botonModificarPerfil" style="width: 200px; ">Modificar perfil</button>
            </div>          

            <!-- Fin Formulario modificación perfil-->

            <!-- Script Formulario modificación perfil -->
            <script>

                // Obtén referencia al botón y a los campos de modificación
                var botonModificarPerfil = document.getElementById('botonModificarPerfil');
                var camposModificacion = document.getElementById('camposModificacion');

                // Verifica si los campos de modificación deben mostrarse o no
                function verificarCamposModificacion() {
                    if (camposModificacion.style.display === 'none') {
                        // Los campos de modificación están ocultos, muestra el botón
                        botonModificarPerfil.style.display = 'block';
                    } else {
                        // Los campos de modificación están visibles, oculta el botón
                        botonModificarPerfil.style.display = 'none';
                    }
                }

                // Agrega un event listener al botón
                botonModificarPerfil.addEventListener('click', function() {
                    // Muestra u oculta los campos de modificación según su estado actual
                    if (camposModificacion.style.display === 'none') {
                        camposModificacion.style.display = 'block';
                        // Oculta el botón de modificar perfil
                        botonModificarPerfil.style.display = 'none';
                    } else {
                        camposModificacion.style.display = 'none';
                        // Verifica si se deben mostrar los campos de modificación
                        erificarCamposModificacion();
                    }
                });

                // Llama a la función para verificar si se deben mostrar los campos de modificación
                verificarCamposModificacion();
            </script>
            <!-- Fin Script Formulario modificación perfil-->
        </div>
</div>


                </div>
            </div>
        </div>
    </div>
    <!-- Blog End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white-50 py-5 px-sm-3 px-lg-5" style="margin-top: 90px;">
        <div class="row pt-5">
            <div class="col-lg-3 col-md-6 mb-5">
                <a href="" class="navbar-brand">
                    <h1 class="text-primary"><span class="text-white">ISLA</span>TRANSFER</h1>
                </a>
                <p>
                    Bienvenido a tu página de transfers online.
                </p>
                <h6 class="text-white text-uppercase mt-4 mb-3" style="letter-spacing: 5px;">Siguenos</h6>
                <div class="d-flex justify-content-start">
                    <a class="btn btn-outline-primary btn-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-primary btn-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-primary btn-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-outline-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h5 class="text-white text-uppercase mb-4" style="letter-spacing: 5px;">Nuestros servicios</h5>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Transfers</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Hotel a Aeropuerto</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Aeropuerto a Hotel</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Ida y Vuelta</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h5 class="text-white text-uppercase mb-4" style="letter-spacing: 5px;">Links de intrés</h5>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-white-50 mb-2" href="formulario_viajero.php"><i class="fa fa-angle-right mr-2"></i>Reguístrate</a>
                    <a class="text-white-50 mb-2" href="log_in.html"><i class="fa fa-angle-right mr-2"></i>Acceso</a>
                    <a class="text-white-50 mb-2" href="sobre_nosotros.html"><i class="fa fa-angle-right mr-2"></i>Sobre nosotros</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h5 class="text-white text-uppercase mb-4" style="letter-spacing: 5px;">Contactanos</h5>
                <p><i class="fa fa-map-marker-alt mr-2"></i>Calle Aribau 80</p>
                <p><i class="fa fa-phone-alt mr-2"></i>+930 000 512</p>
                <p><i class="fa fa-envelope mr-2"></i>info@islatransfer.com</p>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-white border-top py-4 px-sm-3 px-md-5" style="border-color: rgba(256, 256, 256, .1) !important;">
        <div class="row">
            <div class="col-lg-6 text-center text-md-left mb-3 mb-md-0">
                <p class="m-0 text-white-50">Copyright &copy; <a href="#">Isla Transfers</a>. Todos los derechos reservados</a>
                </p>
            </div>
            <div class="col-lg-6 text-center text-md-right">
                <p class="m-0 text-white-50">Creado por Rocket Team</p>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>