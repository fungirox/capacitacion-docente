<?php 
// Motrar todos los errores de PHP
//error_reporting(E_ALL);
//ini_set('error_reporting', E_ALL);
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/FontAwesome.css" rel="stylesheet">
    <link href="css/master.css" rel="stylesheet">
    <link rel="icon" href="imgs/icono-itesca.png">
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <title>Instituto Tecnológico Superior de Cajeme</title>
</head>
<body class="bg-light">

    <div class="container-fluid my-3">
        <div class="alert alert-light border" style="font-size:12px;" role="alert">
            <strong>
                Inicio
                <i class="fas fa-chevron-right"></i>
            </strong>
            <span class="text-tec">
                <strong>Sistema 2023</strong>
            </span>
        </div><!-- breadcumbs -->

        <div class="offcanvas offcanvas-start text-tec" tabindex="-1" id="lkSideBar" aria-labelledby="lkSideBarLabel">
            <div class="offcanvas-header">
            	<a href="#" class="text-decoration-none" onClick="location.reload();">
                    <h5 class="offcanvas-title mb-0 text-vw text-center" id="lkSideBarLabel">
                        <span class="text-tec">
                            <strong>Desarrollo de</strong>
                        </span>
                        <i class="fa-solid fa-microchip mx-1" style="color:#BC955A;"></i>
                        <span style="color:#942240;">
                            <strong>Software</strong>
                        </span>
                    </h5>
                </a>
    	        <button type="button" class="btn-close me-2" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
			<hr class="m-1">
			<ul class="nav flex-column py-2 h-100">
                <li class="nav-item">
                    <a class="nav-link link-tec" href="#" onClick="showContenido('modulos/crud/vwRegistro.php');" data-bs-dismiss="offcanvas">
						<i class="far fa-folder-open"></i>
                       Registrar usuario
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-tec" href="#" onClick="showContenido('modulos/crud/vwListarUsuarios.php');" data-bs-dismiss="offcanvas">
                        <i class="far fa-address-card"></i>
                        Listado de usuarios
                    </a>
                </li>
			</ul>

            <div class="sticky-bottom pb-4">
            	<div align="center">
	            	ITESCA @2023
                </div>
            </div>
        </div><!-- side menu -->

        <div id="dvContenedorMenu" class="mt-3">
            <div align="left">
                <div class="btn-group flex-wrap" role="group" aria-label="Opciones">
                    <a class="btn btn-itesca rounded-pill me-2 mb-2 shadow-sm" data-bs-toggle="offcanvas" href="#lkSideBar" role="button" aria-controls="lkSideBar">
                        <i class="fa-solid fa-bars"></i>
                    </a>
                </div>
            </div>    
        </div><!-- container mnu -->

		<div id="dvContenedorPpal" class="mt-3">
            <div align="center">
                <span class="fs-4 me-3">Para comenzar, use el botón menú</span>
                <i class="fa-solid fa-bars text-itesca fa-2x"></i>
            </div>       
        </div>
    </div><!-- container ppal -->

	<div class="modal fade" id="dvModalPDF" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-fullscreen">
			<div class="modal-content">
				<div class="modal-header bg-tec text-light">
					<h5 class="modal-title" id="exampleModalLabel">
						ITESCA - 
					</h5>
                	<button class="btn btn-outline-light float-end" data-bs-dismiss="modal">
                    	<i class="fas fa-xmark"></i> Cerrar
                    </button>
				</div>

				<div class="modal-body" id="dvModalBody"></div>
			</div>
		</div>
	</div>

    <div class="modal fade" id="dvModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-tec">
                    <span class="modal-title text-light" id="exampleModalLabel">ITESCA</span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body" id="dvModalBody"></div>
            </div>
        </div>
    </div>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/fontAwesome.min.js"></script>
    <script src="js/index.js"></script>
</body>
</html>