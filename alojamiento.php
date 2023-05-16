<?php
include_once 'php\Usuario.php';
session_start(); // Inicio mi sesion PHP

?>


<!DOCTYPE html>
<html lang="ES">

<head>
	<meta charset="UTF-8" />
	<title>UNI-Rest | Alojamiento</title>
	<link rel="icon" href="./imagenes/logo.png" />
	<script src="js/jquery-3.6.0.js"></script>
	<script src="js/alojamiento.js"></script>
	<script src="js/main.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/popper.min.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/fyp.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
</head>

<body>
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

	<!--                 Alojamientos        -->
	<div class="container">
		<hr class="solid" />
		<div class="d-flex justify-content-between">
			<div class="row fs-4"><b>Mis alojamientos</b></div>
			<div class="d-flex">
				<input class="form-control" type="search" placeholder="Buscar alojamiento" aria-label="Search" />
				<button class="btn btn-outline-success" type="button">
					<i class="bi bi-search"></i>
				</button>
			</div>
		</div>

		<hr class="solid" />
		<div class="d-flex justify-content-center">
			<div>
				<ul class="nav nav-tabs justify-content-end">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" id="misAlojamientosVer">Mis alojamientos</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="misRentasVer">Mis rentas</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-success" id="añadirAlojamiento" data-bs-toggle="modal"
							data-bs-target="#miModalAlojamiento">Añadir alojamiento</a>
					</li>
				</ul>
			</div>
		</div>
		<div id="misAlojamientos">
		<section class="post-list">
			<div class="content" id="misAlojamientosContenido">

			</div>
		</section>
		</div>

		<div id="misRentas">
		<section class="post-list">
			<div class="content" id="misRentasContenido">
					
			</div>
		</section>
		</div>
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

					<div class="d-flex ps-4 pfpPerfil">
					
						<div class="p-1">
							<img src="" id="miImagenPerfil" class="rounded-circle" />
						</div>
						<div class="p-3 flex-grow-1 " id="misDatosPerfil">

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


		<!--  >MODAL WINDOW MULTIMEDIA<-->
	<div class="modal fade" id="miModalMultimedia" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle"
		data-bs-backdrop="static">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="modalTitle">Multimedia</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="idAlojamientoMultimedia">
					<div id="miMultimediaAlojamiento">

					</div>

				</div>
				<div class="modal-footer">
				
							<input type="file" accept="image/jpeg"
								class="form-control" id="añadirMultimedia" name="añadirMultimedia" placeholder="Foto de alojamiento"
								aria-label="Username" aria-describedby="basic-addon1">


					<button type="button" class="btn btn-success" id="BtnRegistroMultimedia">
								Añadir 
							</button>
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
					<form class="p-4">

						<div class="image-upload d-flex justify-content-center pb-4">
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

	<!--  >MODAL ALOJAMIENTO<-->
	<div class="modal fade" id="miModalAlojamiento" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle"
		data-bs-backdrop="static">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalTitle">Alojamiento</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form method="post">
					<div class="modal-body p-5">
						<div class="fs-5 text-center fw-bold pb-4">
							Ingresa los datos:
						</div>
						<div class="form-outline">
							<label class="form-label" for="registroNombreAlojamiento">Nombre del alojamiento</label>
							<input type="text" id="registroNombreAlojamiento" class="form-control" />
						</div>

						<div class="form-outline pt-4">
							<label class="form-label" for="registroCaracteristicasAlojamiento">Características</label>
							<textarea class="form-control" rows="5" id="registroCaracteristicasAlojamiento"
								aria-label="caracts"></textarea>
						</div>
						<hr class="solid" />
						<div class="fs-6 text-center fw-bold pb-4">Imagen:</div>

						<div class="form-outline">
							<input type="file" id="registroImagenAlojamiento" class="form-control"
								aria-label="imagen" />
						</div>

						<hr class="solid" />
						<div class="fs-6 text-center fw-bold pb-4">Dirección:</div>

						<div class="form-outline">
							<input type="text" id="registroDireccionAlojamiento" class="form-control" />
						</div>

					    <div class="fs-6 text-center fw-bold pb-4">Costo Renta Mensual:</div>

						<div class="form-outline">
							<input type="number" id="registroRentaAlojamiento" class="form-control" />
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-success" id="BtnRegistroAlojamiento">
							Añadir Alojamiento
						</button>
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
							Cancelar
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!--  >MODAL EDITAR ALOJAMIENTO<-->
	<div class="modal fade" id="miModalEditarAlojamiento" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle"
		data-bs-backdrop="static">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalTitle">Editar</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form method="post">
					<input type="hidden" id="miAlojamientoSeleccionado">
					<div class="modal-body p-5">
						<div class="fs-5 text-center fw-bold pb-4">
							Actualizar Alojamiento:
						</div>
						<div class="form-outline">
							<label class="form-label" for="editarNombreAlojamiento">Nombre</label>
							<input type="text" id="editarNombreAlojamiento" value="Alojamiento San Nicolás"
								class="form-control" />
						</div>

						<div class="form-outline pt-4">
							<label class="form-label" for="editarCaracteristicasAlojamiento">Características</label>
							<textarea class="form-control" id="editarCaracteristicasAlojamiento" rows="5" aria-label="caracts">
							</textarea>
						</div>
						<hr class="solid" />
						<div class="fs-6 text-center fw-bold pb-4">Dirección:</div>

						<div class="form-outline">
							<input type="text" id="editarDireccionAlojamiento" class="form-control" />
						</div>
						<div class="fs-6 text-center fw-bold pb-4">Imagen:</div>

						<div class="form-outline">
							<input type="file" id="editarImagenAlojamiento" class="form-control"
								aria-label="imagen" />
						</div>

						    <div class="fs-6 text-center fw-bold pb-4">Costo Renta Mensual:</div>

						<div class="form-outline">
							<input type="text" id="editarRentaAlojamiento" class="form-control" />
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" id="BtnActualizarAlojamiento"	>
							Actualizar Alojamiento
						</button>
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
							Cancelar
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

</html>