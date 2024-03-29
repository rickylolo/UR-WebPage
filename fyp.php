<?php
include_once 'php\Usuario.php';
session_start(); // Inicio mi sesion PHP

?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8" />
	<title>UNI-Rest | Inicio</title>
	<link rel="icon" href="./imagenes/logo.png" />
	<script src="js/jquery-3.6.0.js"></script>
	<script src="js/fyp.js"></script>
	<script src="js/main.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/popper.min.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/fyp.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
</head>

<body>
	    <?php
    if ($_SESSION != NULL) { // Si mi sesion no es nula significa que un usuario inicio sesion
        echo '<input type="hidden" value="' . $_SESSION['Usuario_id'] . '" id="miUserIdActual">'; // Valor del id del usuario en un campo invisible
    }
    ?>
	<nav class="navbar sticky-top navbar-expand-lg navbar-light">
		<div class="container">
			<div>
				<img src="imagenes/logo.png " width="100px" />
				<a class="navbar-brand fs-3 p-4 text-white" href="fyp.php">UNI-Rest</a>
			</div>
			<div class="collapse navbar-collapse d-flex justify-content-end" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				</ul>
				<div id="perfil">
					<div class="d-flex flex-column dropstart misDatosUsuario">
						<div class="miImagen dropdown p-2 mx-auto" id="DatosUser" data-bs-toggle="dropdown"
							aria-expanded="false">
							<img src="" id="pfp" class="pfp rounded-circle">
						</div>
						<ul class="dropdown-menu p-3" aria-labelledby="DatosUser">
							<li>
								<div class="d-flex flex-row miImagen">
									<div class="p-1">
										<img src="" id="pfp2" class="pfp rounded-circle">

									</div>
									<p class="fw-bold fs-5 pt-2" id="userNav">
									</p>
								</div>
							</li>
							<div class="dropdown-divider"></div>
							<li>
								<a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#miModalPerfil">
									<i class="bi bi-person-circle"></i> Perfil</a>
							</li>
							<li>
								<a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#miModalMensaje">
									<i class="bi bi-chat-square-text"></i> Mensajes</a>
							</li>

							<li>
								<a class="dropdown-item" href="alojamiento.php">
									<i class="bi bi-house-door-fill"></i> Alojamiento</a>
							</li>
							<div class="dropdown-divider"></div>
							<li>
								<a class="dropdown-item" href="index.php?logout=true"><i class="bi bi-box-arrow-left"></i> Cerrar Sesión</a>
							</li>
					</div>
				</div>

			</div>
		</div>
	</nav>
	<input type="hidden" id="miAlojamientoSeleccionado">
	<!--                 Alojamientos        -->
	<div class="container" id="detalleAlojamiento">
		
	</div>
	<div class="container" id="misAlojamientos">
		<hr class="solid" />
		<div class="row fs-4 product-title">
			<b>Alojamientos cercanos a tu ubicación</b>
		</div>
		<hr class="solid" />
		<div class="d-flex justify-content-end">
			<div class="d-flex">
				<input class="form-control" type="search" id="miTextoSearch" placeholder="Buscar alojamiento" aria-label="Search" />
				<button class="btn btn-outline-success" id="buscarAlojamientoSearch" type="button">
					<i class="bi bi-search"></i>
				</button>
			</div>
		</div>
		<section class="post-list">
			<div class="content" id="AlojamientosFYP">

			</div>
		</section>
	</div>

    <!--  >MODAL WINDOW MENSAJES<-->
    <div class="modal fade" id="miModalMensaje" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle" data-bs-backdrop="static">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitle">Chat</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <input type="hidden" id="miCursoSeleccionadoMensajes">
                <div class="modal-body" id="miBodyMensajes">
                
                    <div class="d-flex flex-row justify-content-between">
     
                        <div class="list-group" id="misChats">
                           
                        </div>
                        <div id="miMensaje" class="ps-2 flex-fill">

                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Aqui apareceran tus mensajes</h4>
                            <p>Aqui iran el contenido de tus mensajes selecciona un chat de el lado izquierdo para continuar</p>
                            <hr>               
                        </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer" id="miFooterMensajes">
                </div>
            </div>
        </div>
    </div>



	<!--  >MODAL WINDOW PERFIL<-->
	<div class="modal fade" id="miModalPerfil" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle"
		data-bs-backdrop="static">
		<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="modalTitle">Perfil</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">

					<div class="d-flex flex-row justify-content-center ps-4 pfpPerfil">
						<div class="p-1">
							<img src="imagenes/imagen-dario.png" id="miImagenPerfil" class="rounded-circle" />
						</div>
						<div class="p-3" id="misDatosPerfil">

						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
						Regresar
					</button>
				</div>
			</div>
		</div>
	</div>



	<!--  >MODAL WINDOW EDITAR PERFIL<-->
	<div class="modal fade" id="miModalEditarPerfil" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle"
		data-bs-backdrop="static">
		<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="modalTitle">Perfil</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body p-4">
					<form>

						<div class="image-upload d-flex justify-content-center pt-4 pb-4">
							<label for="editarAvatar">
								<img src="" alt="" id="E_imgFoto" width="250px" height="250px">
							</label>
							<input type="file" onchange="vista_preliminarEdit(event)" accept="image/jpeg"
								class="form-control" id="editarAvatar" name="editarAvatar" placeholder="Foto de perfil"
								aria-label="Username" aria-describedby="basic-addon1">


						</div>
						<div class="row pb-2">
							<div class="col-md-6">
								<div class="form-outline">
									<input type="text" id="editarNombres" class="form-control" />
									<label class="form-label" for="editarNombres">Nombre(s)</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-outline">
									<input type="text" id="editarApellidos" class="form-control" />
									<label class="form-label" for="editarApellidos">Apellido(s)</label>
								</div>
							</div>
						</div>

						<div class="row pb-2">
							<div class="col-md-6">
								<div class="form-outline">
									<input type="text" id="editarOcupacion" class="form-control" />
									<label class="form-label" for="editarOcupacion">Ocupación</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-outline">
									<input type="number" id="editarEdad" class="form-control" />
									<label class="form-label" for="editarEdad">Edad</label>
								</div>
							</div>
						</div>

						<div class="form-outline pb-2">
							<input type="email" id="editarCorreo" class="form-control" />
							<label class="form-label" for="editarCorreo">Correo</label>
						</div>

						<div class="form-outline pb-2">
							<input type="text" id="editarNombreUsuario" class="form-control" />
							<label class="form-label" for="editarNombreUsuario">Nombre de usuario</label>
						</div>

						<div class="form-outline pb-2">
							<input type="password" id="editarPassword" class="form-control" />
							<label class="form-label" for="editarPassword">Contraseña</label>
						</div>

						<div class="form-outline pb-2">
							<input type="password" id="editarConfirmarPassword" class="form-control" />
							<label class="form-label" for="editarConfirmarPassword">Confirmar contraseña</label>
						</div>

						<div class="form-outline pb-2">
							<textarea class="form-control" rows="10" id="editarDescripcion" aria-label="descripcion"></textarea>
							<label class="form-label" for="editarDescripcion">Descripción</label>
						</div>

						<div class="form-outline pb-2">
							<input type="text" id="editarDireccion" class="form-control" />
							<label class="form-label" for="editarDireccion">Dirección</label>
						</div>

						<div class="form-outline pb-2">
							<input type="number" id="editarTelefono" class="form-control" />
							<label class="form-label" for="editarTelefono">Telefono</label>
						</div>


					</form>

				</div>
				<div class="modal-footer">
					<button type="button" id="BtnEditarPerfil" class="btn btn-primary btn-block mt-4 mb-4">
						Actualizar
					</button>
					<button type="button" data-bs-dismiss="modal" class="btn btn-secondary btn-block mt-4 mb-4">
						Cancelar
					</button>
				</div>
			</div>
		</div>
	</div>
</body>

</html>