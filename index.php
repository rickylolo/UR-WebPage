<!DOCTYPE html>
<html lang="es">

<head>

	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>UR | Inicio</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="./css/estilo.css">
	<link rel="icon" href="./imagenes/logo.png">
	<script src="js/jquery-3.6.0.js"></script>
	<script src="js/index.js"></script>
</head>

<body>
	<div class="myForms">
		<div id="login" class="w-75 h-75">
			<section class="text-center text-lg-start">
				<div class="card mb-4">
					<div class="row g-0 d-flex align-items-center">
						<div class="col-lg-4 d-none d-lg-flex">
							<img src="imagenes/house.jpg" alt="House"
								class="w-100 rounded-t-5 rounded-tr-lg-0 rounded-bl-lg-5">
						</div>
						<div class="col-lg-6">
							<div class="d-flex flex-column">
								<div id="logo" class="d-flex justify-content-center">
									<img src="imagenes/icono.jpg" />
								</div>
								<div class="fs-4 p-1 fw-bold text-center">
									Inicio de Sesión
								</div>
							</div>
							<div class="card-body px-md-5">
								<form>
									<div class="container">
										<div class="mx-auto form-outline mb-4 w-75">
											<input type="text" id="loginUsuario" class="form-control" />
											<label class="form-label" for="form2Example1">Nombre de usuario</label>
										</div>


										<div class="mx-auto form-outline mb-4 w-75">
											<input type="password" id="loginPassword" class="form-control" />
											<label class="form-label" for="form2Example2">Contraseña</label>
										</div>
									</div>


									<div class="d-flex justify-content-center">
										<button type="button" id="BtnLogin" class="btn btn-orange btn-block mb-4">
											Ingresar
										</button>
									</div>
									<div class="d-flex justify-content-center">
										<div class="d-flex flex-column">
											<span>¿Aún no tienes cuenta?</span>
											<button type="button" id="irRegistro"
												class="btn btn-block mb-4 text-primary">
												Registrate
											</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>

		<div id="register" class="w-100 h-100">
			<section class="text-center text-lg-start">
				<div class="container py-1">
					<div class="row g-0 align-items-center">
						<div class="col-lg-6 mb-5 mb-lg-0">
							<div class="card cascading-right" style="
										background: hsla(0, 0%, 100%, 0.55);
										backdrop-filter: blur(30px);
									">
								<div class="card-body p-5 shadow-5 text-center">
									<h2 class="fw-bold mb-5">Registro</h2>
									<form>
										<div class="row">
											<div class="col-md-6">
												<div class="form-outline">
													<input type="text" id="registroNombres" class="form-control" />
													<label class="form-label" for="registroNombres">Nombre(s)</label>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-outline">
													<input type="text" id="registroApellidos" class="form-control" />
													<label class="form-label" for="registroApellidos">Apellido(s)</label>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="form-outline">
													<input type="text" id="registroOcupacion" class="form-control" />
													<label class="form-label" for="registroOcupacion">Ocupación</label>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-outline">
													<input type="number" id="registroEdad" class="form-control" />
													<label class="form-label" for="registroEdad">Edad</label>
												</div>
											</div>
										</div>

										<div class="form-outline">
											<input type="file" id="registroFotoPerfil" class="form-control" />
											<label class="form-label" for="registroFotoPerfil">Avatar</label>
										</div>

										<div class="form-outline">
											<input type="email" id="registroCorreo" class="form-control" />
											<label class="form-label" for="registroCorreo">Correo</label>
										</div>

										<div class="form-outline">
											<input type="text" id="registroNombreUsuario" class="form-control" />
											<label class="form-label" for="registroNombreUsuario">Nombre de usuario</label>
										</div>

										<div class="form-outline">
											<input type="password" id="registroPassword" class="form-control" />
											<label class="form-label" for="registroPassword">Contraseña</label>
										</div>

										<div class="form-outline">
											<input type="password" id="registroConfirmarPassword" class="form-control" />
											<label class="form-label" for="registroConfirmarPassword">Confirmar contraseña</label>
										</div>

										<div class="form-outline">
											<textarea class="form-control" id="registroDescripcion" aria-label="descripcion"></textarea>
											<label class="form-label" for="registroDescripcion">Descripción</label>
										</div>

										<div class="form-outline">
											<input type="text" id="registroDireccion" class="form-control" />
											<label class="form-label" for="registroDireccion">Dirección</label>
										</div>

										<div class="form-outline">
											<input type="number" id="registroTelefono" class="form-control" />
											<label class="form-label" for="registroTelefono">Telefono</label>
										</div>

										<button type="button" id="BtnRegistro" class="btn btn-success btn-block mt-4 mb-4">
											Registrar
										</button>
										<button type="button" id="irLogin"
											class="btn btn-secondary btn-block mt-4 mb-4">
											Cancelar
										</button>
									</form>
								</div>
							</div>
						</div>

						<div class="col-lg-6 mb-5 mb-lg-0">
							<img src="imagenes/couple.jpg" class="w-75 rounded-4 shadow-4" alt="" />
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/popper.min.js"></script>
</body>

</html>