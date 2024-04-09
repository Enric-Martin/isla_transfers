<?php
// Sesión inciada
session_start();

// Incluir el archivo uso_de_usuario.php
require_once 'uso_de_usuario.php';

// Crear una instancia de la clase UsoUsuario
$userManager = new UsoUsuario($pdo);

// Preparar la consulta SQL para obtener los vehículos del conductor
$stmt = $pdo->prepare("SELECT * FROM transfer_reservas WHERE id_vehiculo = :id_conductor");

// Ejecutar la consulta con el correo electrónico del usuario actual
$stmt->execute(['id_conductor' => $userManager->obtenerDatosUsuario('id_vehiculo')]);

// Obtener todas las filas de resultado
$reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Accede a los datos del usuario desde la sesión.... ¿Borrar?
//$email = $_SESSION['userData']['email'];

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Isla Transfer - Panel conductor</title>
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
                <h3 class="display-4 text-white text-uppercase">Panel conductor</h3>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Seleccionar carreras -->
    <form action="registrar_reserva_viajero.php" method="post">
        <div class="container-fluid booking mt-5 pb-5">
            <div class="container pb-5">
                <div class="bg-light shadow" style="padding: 40px;">
                    <div class="row align-items-center" style="min-height: 60px;">
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3 mb-md-0">
                                        <select class="custom-select px-4" style="height: 47px; width: 200px" onchange="mostrarCampos(this)" name="tipo_reserva">
                                            <option selected>Periodo busqueda</option>
                                            <option value="1">Por día</option>
                                            <option value="1">Por semana</option>
                                            <option value="2">Por mes</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary btn-block" type="submit" style="height: 47px; margin-top: -2px; display: none;" id='boton_submit'>Enviar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        function mostrarCampos(select) {
            var reservaSeleccionada = select.value;
            // Mostrar u ocultar campos según la opción seleccionada
            if (reservaSeleccionada === '1') {
                document.getElementById('boton_submit').style.display = 'block';
            } else if (reservaSeleccionada === '2') {
                document.getElementById('boton_submit').style.display = 'block';
            } else if (reservaSeleccionada === '3') {
                document.getElementById('boton_submit').style.display = 'block';
            } else {
                // Si no se selecciona ninguna opción, ocultar todos los campos
                document.getElementById('boton_submit').style.display = 'none';
            }
        }
    </script>
    <!-- Booking End -->

    <!-- Incio Reservas -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h2>Mis trayectos</h2>
            <div class="row">
                <div class="col-lg-8">
                    <div class="row pb-3">
                        <div class="col-md-6 mb-4 pb-2">
                            <div class="blog-item">
                                <?php if(empty($reservas)): ?>
                                    <p>No tienes reservas realizadas.</p>
                                <?php else: ?>    
                                    <?php foreach ($reservas as $reserva): ?>
                                        <div class="position-relative">
                                            <img class="img-fluid w-100" src="img/blog-1.jpg" alt="">
                                            <div class="blog-date">
                                                <h6 class="font-weight-bold mb-n1">01</h6>
                                                <small class="text-white text-uppercase">Jan</small>
                                            </div>
                                        </div>
                                        <div class="bg-white p-4">
                                            <div class="d-flex mb-2">
                                                </br>
                                            </div>
                                            <a class="h5 m-0 text-decoration-none"><?php echo $reserva['fecha_reserva']; ?></a>
                                            <a class="h5 m-0 text-decoration-none"><?php echo $reserva['numero_vuelo_entrada']; ?></a>
                                            <a class="h5 m-0 text-decoration-none"><?php echo $reserva['origen_vuelo_entrada']; ?></a>
                                        </div>
                                    <? endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-5 mt-lg-0">
        <!-- Fin Reservas -->
        <!-- Mi perfil -->
        <div class="d-flex flex-column text-center bg-white mb-5 py-5 px-4">
            <h2>MI PERFIL</h2>
            <h3 class="text-primary mb-3"><?php echo $userManager->obtenerDatosUsuario('descripcion'); ?></h3>
            <h3 class="text-primary mb-3"><?php echo $userManager->obtenerDatosUsuario('email'); ?></h3>
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