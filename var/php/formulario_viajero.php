<?php
    session_start();
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

    <!-- Registration Start -->
    <div class="container-fluid bg-registration py-5">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="card border-0">
                        <div class="card-header bg-primary text-center p-4">
                            <h1 class="text-white m-0">Resgítrate Viajero</h1>
                        </div>
                        <div class="card-body rounded-bottom bg-white p-5">
                            <form action="registrar_viajero.php" method="POST">
                                <div class="form-group">
                                    <input type="text" id="nombre" name="nombre" class="form-control p-4" placeholder="Nombre" required="required" />
                                </div>
                                <div class="form-group">
                                    <input type="text" id="apellido1" name="apellido1" class="form-control p-4" placeholder="Apellido 1" required="required" />
                                </div>
                                <div class="form-group">
                                    <input type="text" id="apellido2" name="apellido2" class="form-control p-4" placeholder="Apellido 2" required="required" />
                                </div>
                                <div class="form-group">
                                  <input type="text" id="direccion" name="direccion" class="form-control p-4" placeholder="Dirección" required="required" />
                                </div>
                                <div class="form-group">
                                  <input type="text" id="codigoPostal" name="codigoPostal" class="form-control p-4" placeholder="Código Postal" required="required" />
                                </div>
                                <div class="form-group">
                                  <input type="text" id="ciudad" name="ciudad" class="form-control p-4" placeholder="Ciudad" required="required" />
                                </div>
                                <div class="form-group">
                                  <input type="text" id="pais" name="pais" class="form-control p-4" placeholder="País" required="required" />
                                </div>
                                <div class="form-group">
                                  <input type="email" id="email" name="email" class="form-control p-4" placeholder="Email" required="required" />
                                </div>
                                <div class="form-group">
                                  <input type="password" id="password" name="password" class="form-control p-4" placeholder="Contraseña" required="required" />
                                </div>
                                <div>
                                    <button class="btn btn-primary btn-block py-3" type="submit" value="Registrar">Resgístrate ahora</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Área para mostrar mensajes de error -->
                <div class="col-lg-7">
                    <?php
                    // Mostrar mensajes de error si existen
                    if (isset($_SESSION['error_message'])) {
                        echo '<div class="alert alert-danger mt-4" role="alert" style="width:350px">' . $_SESSION['error_message'] . '</div>';
                        // Una vez mostrado el mensaje, eliminarlo para que no se muestre nuevamente
                        unset($_SESSION['error_message']);
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Registration End -->

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
  </body>
</html>