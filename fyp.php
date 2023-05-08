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
				<input class="form-control" type="search" placeholder="Buscar alojamiento" aria-label="Search" />
				<button class="btn btn-outline-success" type="button">
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
	<div class="modal fade" id="miModalMensaje" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle"
		data-bs-backdrop="static">
		<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="modalTitle">Chat</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="d-flex flex-row justify-content-between">
						<div id="misChats">
							<div class="list-group">
								<a href="" class="list-group-item list-group-item-action" aria-current="true">
									<div class="d-flex flex-row miImagen chat">
										<div class="p-2"><img src="imagenes/img1.jpg" /></div>
										<div class="p-2">
											<div class="d-flex flex-column">
												<p class="fs-5 p-1 fw-bold">Alojamiento Encinos</p>
												<p class="text-muted fs-6 fw-light" id="vendedor">
													Propietario: Brandon Dylan Regil Llovera
												</p>
											</div>
										</div>
									</div>
								</a>
								<a href="" class="list-group-item list-group-item-action" aria-current="true">
									<div class="d-flex flex-row miImagen chat">
										<div class="p-2"><img src="imagenes/img2.jpg" /></div>
										<div class="p-2">
											<div class="d-flex flex-column">
												<p class="fs-5 p-1 fw-bold">Alojamiento Anahuac</p>
												<p class="text-muted fs-6 fw-light" id="vendedor">
													Propietario: Brandon Dylan Regil Llovera
												</p>
											</div>
										</div>
									</div>
								</a>
								<a href="#" class="list-group-item list-group-item-action" aria-current="true">
									<div class="d-flex flex-row miImagen chat">
										<div class="p-2">
											<img src="imagenes/img3.jpg" class="pfp" />
										</div>
										<div class="p-2">
											<div class="d-flex flex-column">
												<p class="fs-5 p-1 fw-bold">Alojamiento Apodaca</p>
												<p class="text-muted fs-6 fw-light" id="vendedor">
													Propietario: Brandon Dylan Regil Llovera
												</p>
											</div>
										</div>
									</div>
								</a>
							</div>
						</div>
						<div id="miMensaje" class="p-2 flex-fill">
							<div class="d-flex flex-row miImagen">
								<div class="p-2">
									<img src="imagenes/img3.jpg" class="pfp" />
								</div>
								<div class="p-2">
									<div class="d-flex flex-column">
										<p class="fs-4 p-1 fw-bold">Alojamiento Apodaca</p>
										<p class="text-muted fs-6" id="correo">
											Propietario: Brandon Dylan Regil Llovera
										</p>
									</div>
								</div>
							</div>
							<hr class="solid" />
							<div class="list-group">
								<a href="#" class="list-group-item list-group-item-action bg-" aria-current="true">
									<div class="miImagen misMensajes d-flex w-100 justify-content-between">
										<div class="d-flex">
											<img src="imagenes/imagen-dario.png" class="pfp rounded-circle" />
											<div class="align-self-center">
												<p class="fs-6 p-3 fw-bold align-middle">Dario</p>
											</div>
										</div>
										<div class="align-self-start">
											<small class="text-muted p-3">9:17pm 23/Feb/2023</small>
										</div>
									</div>
									<hr class="solid" />
									<p class="mb-1">
										Buenas tardes quisiera rentar el inmueble
									</p>
								</a>
								<hr class="solid" />
								<a href="#" class="list-group-item list-group-item-action bg-" aria-current="true">
									<div class="miImagen misMensajes d-flex w-100 justify-content-between">
										<div class="d-flex">
											<img src="imagenes/avatar.jpg" class="pfp rounded-circle" />
											<div class="align-self-center">
												<p class="fs-6 p-3 fw-bold align-middle">
													WailyingDylan
												</p>
											</div>
										</div>
										<div class="align-self-start">
											<small class="text-muted p-3">8:35pm 22/Feb/2023</small>
										</div>
									</div>
									<hr class="solid" />
									<p class="mb-1">Por supuesto, esta disponible</p>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<form class="d-flex" role="search">
						<input class="form-control me-2" type="search" placeholder="Escribe aqui tu mensaje"
							aria-label="Buscar" />

						<button class="btn btn-outline-primary" type="submit">
							<i class="bi bi-send"></i>
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!--  >MODAL WINDOW PERFIL<-->
	<div class="modal fade" id="miModalPerfil" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle"
		data-bs-backdrop="static">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
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
							<textarea class="form-control" id="editarDescripcion" aria-label="descripcion"></textarea>
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