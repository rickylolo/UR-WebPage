$(document).ready(function () {
  // -- USUARIO --
  cargarDatosUser()
  function cargarDatosUser() {
    $.ajax({
      type: 'POST',
      data: { funcion: 'obtenerDataUsuario' },
      url: 'php/Usuario.php',
    })
      .done(function (data) {
        if (data == 0) return
        var items = JSON.parse(data)
        // // Datos de mi navbar
        // Imagen 1
        document.getElementById('pfp').src =
          'data:image/jpeg;base64,' + items[0].fotoPerfil
        // Imagen 2
        document.getElementById('pfp2').src =
          'data:image/jpeg;base64,' + items[0].fotoPerfil

        // Mi nombre
        $('#userNav').text(items[0].username)

        // Datos de mi perfil
        $('#misDatosPerfil').empty()
        $('#misDatosPerfil').append(
          `							

          <div class="flex-column">
									<div class="d-flex justify-content-between">
										<p class="fs-4 p-1 fw-bold" id="miUsuarioPerfil">` +
            items[0].username +
            `</p>
										<div>
											<button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#miModalEditarPerfil" >
												Editar
											</button>
										</div>
									</div>
									
										<p class="text-muted fw-bold fs-6 p-1">
											` +
            items[0].nombres +
            ` ` +
            items[0].apellidos +
            `
										</p>
										<p class="text-muted fs-6 p-1"><b>Edad:</b> ` +
            items[0].edad +
            `</p>
										<p class="text-muted fs-6 p-1">
											<b>Ocupación:</b> ` +
            items[0].ocupacion +
            `
										</p>
							

									<p class="text-muted fs-6 p-1">
										<b>Correo:</b> ` +
            items[0].correo +
            `
									</p>
									<p class="text-muted fs-6 p-1">
										<b>Teléfono:</b>	` +
            items[0].noTelefono +
            `
									</p>

									<hr class="solid" />
									<p class="fs-5 p-1">Mi descripción</p>
									<p class="fs-6 p-2">
										` +
            items[0].descripcion +
            `
									</p>

                  </div>`
        )
        document.getElementById('miImagenPerfil').src =
          'data:image/jpeg;base64,' + items[0].fotoPerfil

        // Datos para editar mi perfil
        document.getElementById('E_imgFoto').src =
          'data:image/jpeg;base64,' + items[0].fotoPerfil
        $('#editarNombres').val(items[0].nombres)
        $('#editarApellidos').val(items[0].apellidos)
        $('#editarOcupacion').val(items[0].ocupacion)
        $('#editarEdad').val(items[0].edad)
        $('#editarCorreo').val(items[0].correo)
        $('#editarNombreUsuario').val(items[0].username)
        $('#editarDescripcion').val(items[0].descripcion)
        $('#editarDireccion').val(items[0].direccion)
        $('#editarTelefono').val(items[0].noTelefono)
      })
      .fail(function (data) {
        console.error(data)
      })
  }

  function cargaAlojamientoDetalle(Alojamiento_id) {
    $.ajax({
      type: 'POST',
      data: {
        funcion: 'obtenerDataAlojamiento',
        Alojamiento_id: Alojamiento_id,
      },
      url: 'php/Alojamiento.php',
    })
      .done(function (data) {
        var items = JSON.parse(data)
        $('#detalleAlojamiento').empty()
        $('#detalleAlojamiento').append(
          `   
              		<hr class="solid" />
		<div class="d-flex flex-row">
			<div class="p-2">
				<div class="card" style="width: 28rem">
					<div class="deslizador">
						<div class="deslizador-interno" id="deslizadorDetalle">
				
						</div>
					</div>
					<div class="card-body">
						<h5 class="fw-bold card-title">Alojamiento San Nicolás</h5>
						<p class="card-text text-end text-primary">
							$` +
            items[0].renta +
            ` MXN Mensuales
						</p>
						<a id="` +
            items[0].Alojamiento_id +
            `"
							class="btn btn-primary d-flex justify-content-center rentarAlojamiento">Rentar</a>
					</div>
				</div>
			</div>
			<div class="p-2 flex-fill shadow-sm">
				<div class="d-flex flex-column">
					<div class="d-flex flex-column">
						<div class="d-flex justify-content-between">
							<p class="fs-3 p-1 fw-bolder">` +
            items[0].nombre +
            `</p>
							<div>
								<div class="d-flex flex-row justify-content-end">
									<span class="badge fs-6 rounded-pill bg-success">Disponible</span>
								</div>
							</div>
						</div>
						<p class="text-end fs-6 fw-light text-secondary">
							Propietario: ` +
            items[0].nombreCompleto +
            `
						</p>
					</div>
					<div></div>
					<hr class="solid" />
					<div class="p-2 fs-5 text-center text-muted">
						Características de la vivienda
					</div>
					<div class="p-4">
          ` +
            items[0].caracteristicas +
            `
          </div>
					<hr class="solid" />

					<div class="p-2 fs-5 text-center text-muted">Dirección</div>
					<div class="text-start ms-4">
						    ` +
            items[0].direccion +
            `
					</div>
					<hr class="solid" />

          <div id="propietarioDetalle">
         
          </div>
					</div>
				</div>
			</div>
		</div>
            `
        )
        cargarMultimediaDeslizador(items[0].Alojamiento_id)
        cargarDatosPropietarioDetalle(items[0].UsuarioVendedor_id)
      })
      .fail(function (data) {
        console.error(data)
      })
  }

  function cargarDatosPropietarioDetalle(Propietario_id) {
    $.ajax({
      type: 'POST',
      data: { funcion: 'obtenerDataPropietario', Usuario_id: Propietario_id },
      url: 'php/Usuario.php',
    })
      .done(function (data) {
        if (data == 0) return
        var items = JSON.parse(data)
        // Datos de mi perfil
        $('#propietarioDetalle').empty()
        $('#propietarioDetalle').append(
          `			
          <input type="hidden" id="miUsuarioPropietario" value="` +
            items[0].Usuario_id +
            `">
               	<div class="p-4 fs-5 text-center text-muted">Propietario</div>
					<div class="d-flex flex-fill">
                <div class="d-flex flex-row pfpPerfil">
						<div class="p-1">
							<img src="data:image/jpeg;base64,` +
            items[0].fotoPerfil +
            `" class="rounded-circle" />
						</div>
						<div class="p-3" style="width:35rem;">
							<div class="d-flex flex-column">
								<div class="d-flex justify-content-between">
									<p class="fs-4 p-1 fw-bold">` +
            items[0].username +
            `</p>
									<div>
										<button type="button" data-bs-toggle="modal" id="` +
            items[0].Usuario_id +
            `" data-bs-target="#miModalMensaje"
											class="btn btn-primary iniciarChat">
											<i class="bi bi-chat-left"></i> Enviar Mensaje
										</button>
									</div>
								</div>
								<p class="text-muted fw-bold fs-6 p-1">
									` +
            items[0].nombres +
            `		` +
            items[0].apellidos +
            `
								</p>
								<p class="text-muted fs-6 p-1"><b>Edad:</b> ` +
            items[0].edad +
            `</p>
								<p class="text-muted fs-6 p-1">
									<b>Ocupación:</b> ` +
            items[0].ocupacion +
            `
								</p>
								<p class="text-muted fs-6 p-1">
									<b>Correo:</b> ` +
            items[0].correo +
            `
								</p>

								<hr class="solid" />
								<p class="fs-6 p-2" id="descripcion">
									` +
            items[0].descripcion +
            `
								</p>
							</div>
							<hr class="solid" />
						</div>	
            </div>			
            `
        )

        // Iniciar Chat
        $('#propietarioDetalle').on('click', '.iniciarChat', funcIniciarChat)
        function funcIniciarChat() {
          let miIdPropietario = $('#miUsuarioPropietario').val()
          let miIdUserLoggeado = $('#miUserIdActual').val()
          if (miIdPropietario == miIdUserLoggeado) {
            alert('No puedes iniciar un chat contigo mismo')
            return
          }
          let miIdAlojamiento = $('#miAlojamientoSeleccionado').val()
          funcRegistrarMensaje(miIdPropietario, miIdAlojamiento)
        }
      })
      .fail(function (data) {
        console.error(data)
      })
  }

  cargarMisChats()
  function cargarMisChats() {
    $.ajax({
      type: 'POST',
      data: {
        funcion: 'obtenerChats',
      },
      url: 'php/Chat.php',
    })
      .done(function (data) {
        if (data == 0) return
        var items = JSON.parse(data)
        $('#misChats').empty()
        for (let i = 0; i < items.length; i++) {
          $('#misChats').append(
            `
            <a id="` +
              items[i].Chat_id +
              `" class="list-group-item list-group-item-action verMensajes" aria-current="true">
             
                                    <div class="d-flex flex-row miImagen chat miAlojamientoChat" id="` +
              items[i].Alojamiento_id +
              `">
                                        <div class="p-2"><img src="data:image/jpeg;base64,` +
              items[i].imagenAlojamiento +
              `" class="pfp">
                                        </div>
                                          <p class="fs-5 pt-4 ps-2 fw-bold">` +
              items[i].nombre +
              `</p>

                                    </div>
                                                                            <div class="pt-2 pb-2">
                                            <div class="d-flex flex-column">
                                            
                                              
                                                <p class="text-muted fs-6 fw-light"><b>Propietario: </b>` +
              items[i].username +
              `
                                                </p>
                                                                                                <p class="text-muted fs-6 fw-light"><b>Correo: </b>` +
              items[i].correo +
              `
                                                </p>
                                            </div>
                                        </div>
                            </a>

            `
          )
        }
      })
      .fail(function (data) {
        console.error(data)
      })
  }

  function cargarHeaderMensajes(Alojamiento_id) {
    $.ajax({
      type: 'POST',
      data: {
        funcion: 'obtenerDataAlojamiento',
        Alojamiento_id: Alojamiento_id,
      },
      url: 'php/Alojamiento.php',
    })
      .done(function (data) {
        var items = JSON.parse(data)
        $('#DatosAlojamientoHeader').empty()
        $('#DatosAlojamientoHeader').append(
          `
                              <div class="p-2"><img src="data:image/jpeg;base64,` +
            items[0].imagenAlojamiento +
            `" class="pfp">
                                </div>
                                <div class="p-2">
                                    <div class="d-flex flex-column">
                                        <p class="fs-5 p-1 fw-bold">` +
            items[0].nombre +
            `</p>
                              
                                    </div>
                                </div>

        
        `
        )
      })
      .fail(function (data) {
        console.error(data)
      })
  }

  function cargarMisMensajes(Chat_id) {
    $('#miMensaje').empty()
    $('#miMensaje').append(
      `
                            <div class="d-flex flex-row miImagen" id="DatosAlojamientoHeader">
                            </div>                                            
                            <div class="list-group" id="misMensajesChat">
                            </div> 
            `
    )

    $.ajax({
      type: 'POST',
      data: {
        funcion: 'obtenerMensajes',
        Chat_id: Chat_id,
      },
      url: 'php/Chat.php',
    })
      .done(function (data) {
        var items = JSON.parse(data)

        $('#misMensajesChat').empty()
        if (items.length == 0) {
          $('#misMensajesChat').append(
            `
                          <div class="alert alert-primary" role="alert">
                            <h4 class="alert-heading">No hay mensajes en este chat</h4>
                            <p>Escribe un mensaje abajo para crear una conversación</p>
                            <hr>               
                        </div>
            `
          )
        }
        for (let i = 0; i < items.length; i++) {
          $('#misMensajesChat').append(
            `
                                <a href="" class="list-group-item list-group-item-action bg-" aria-current="true">
                                    <div class="miImagen misMensajes d-flex w-100 justify-content-between">
                                        <div class="d-flex">
                                            <img src="data:image/jpeg;base64,` +
              items[i].fotoPerfil +
              `" class="pfp rounded-circle">
                                            <div class="align-self-center">
                                                <p class="fs-6 ps-2 pt-3 fw-bold align-middle">` +
              items[i].nombreUsuario +
              `</p>
                                            </div>
                                        </div>
                                        <div class="align-self-start">
                                            <small class="text-muted p-3">` +
              items[i].tiempoRegistro +
              `</small>
                                        </div>
                                    </div>
                                    <hr class="solid">
                                    <p class="mb-1">` +
              items[i].texto +
              `</p>

                                </a>
                                <hr class="solid">

            `
          )
        }
      })
      .fail(function (data) {
        console.error(data)
      })
  }

  function cargarMultimediaDeslizador(Alojamiento_id) {
    $.ajax({
      type: 'POST',
      data: {
        funcion: 'obtenerMultimediaAlojamiento',
        Alojamiento_id: Alojamiento_id,
      },
      url: 'php/Multimedia.php',
    })
      .done(function (data) {
        let items = JSON.parse(data)
        $('#deslizadorDetalle').empty()
        for (let i = 0; i < items.length; i++) {
          $('#deslizadorDetalle').append(
            `
                        <img  src="data:image/jpeg;base64,` +
              items[i].multimedia +
              `" >`
          )
        }

        iniciarDeslizador()
      })
      .fail(function (data) {
        console.error(data)
      })
  }
  // ----------------------------- REGISTRO DATOS -----------------

  function funcRegistrarMensaje(Usuario2, idAlojamiento) {
    $.ajax({
      type: 'POST',
      data: {
        funcion: 'insertarChat',
        Usuario_2: Usuario2,
        Alojamiento_id: idAlojamiento,
      },
      url: 'php/Chat.php',
    })
      .done(function (data) {
        if (data == 0) {
          $('#miBodyMensajes').empty()
          $('#miFooterMensajes').empty()
          $('#miBodyMensajes').append(
            `
             <div class="alert alert-warning" role="alert">
                ¡No has Iniciado Sesión!, Debes iniciar sesión para chatear con un Instructor
             </div>
        
        `
          )
          $('#miFooterMensajes').append(
            `
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#miModalLogin">
                                      Iniciar Sesión
              </button>
          `
          )
          return
        }
        if (data == 1) {
          cargarMisChats()
          return
        }
      })
      .fail(function (data) {
        console.error(data)
      })
  }
  // Ver detalle alojamiento
  $('#AlojamientosFYP').on('click', '.verDetalle', funcVerAlojamiento)
  function funcVerAlojamiento() {
    let miIdAlojamiento = $(this).attr('id')
    $('#miAlojamientoSeleccionado').val(miIdAlojamiento)
    cargaAlojamientoDetalle(miIdAlojamiento)
    $('#detalleAlojamiento').show()
  }

  // INICIAR MENSAJES CHAT VER MENSAJES DEL CHAT
  $('#misChats').on('click', '.verMensajes', funcVerMensajesChat)
  function funcVerMensajesChat() {
    let Chat_id = $(this).attr('id')
    let Alojamiento_id = $(this).children('.miAlojamientoChat').attr('id')

    $('#miFooterMensajes').empty()
    $('#miFooterMensajes').append(
      `
                    
            <div class="d-flex justify-content-end" id="` +
        Alojamiento_id +
        `">
                        <input class="form-control me-2" type="search" id="miTextoMensaje" placeholder="Escribe aqui tu mensaje" aria-label="Buscar">

                        <button id="` +
        Chat_id +
        `" class="btn btn-outline-primary registrarMensaje"><i class="bi bi-send"></i></button>
          </div>
                  
            `
    )
    cargarMisMensajes(Chat_id)
    cargarHeaderMensajes(Alojamiento_id)
  }

  //-------------------------MENSAJE ----------------------------

  $('#miFooterMensajes').on(
    'click',
    '.registrarMensaje',
    funcRegistrarIniciarMensaje
  )
  function funcRegistrarIniciarMensaje() {
    let idChat = $(this).attr('id')
    let idAlojamiento = $(this).parent().attr('id')
    let texto = $('#miTextoMensaje').val()
    $.ajax({
      type: 'POST',
      data: {
        funcion: 'insertarMensaje',
        Chat_id: idChat,
        Texto: texto,
      },
      url: 'php/Chat.php',
    })
      .done(function () {
        $('#miTextoMensaje').val('')
        cargarMisMensajes(idChat)
        cargarHeaderMensajes(idAlojamiento)
      })
      .fail(function (data) {
        console.error(data)
      })
  }
  //------------------------- USUARIO ----------------------------
  $('#BtnEditarPerfil').click(funcActualizarUsuario)
  function funcActualizarUsuario() {
    var file_data = $('#editarAvatar').prop('files')[0]
    var nombres = $('#editarNombres').val()
    var apellidos = $('#editarApellidos').val()
    var ocupacion = $('#editarOcupacion').val()
    var edad = $('#editarEdad').val()
    var correo = $('#editarCorreo').val()
    var nombreUsuario = $('#editarNombreUsuario').val()
    var descripcion = $('#editarDescripcion').val()
    var direccion = $('#editarDireccion').val()
    var telefono = $('#editarTelefono').val()
    var password = $('#editarPassword').val()
    //Verificacion contraseña
    var confirmarPassword = $('#editarConfirmarPassword').val()
    if (password != confirmarPassword) {
      alert('La contraseña no coincide reintenta nuevamente')
      return
    }

    if (
      nombres == '' ||
      apellidos == '' ||
      ocupacion == '' ||
      edad == '' ||
      correo == '' ||
      nombreUsuario == '' ||
      descripcion == '' ||
      direccion == '' ||
      telefono == ''
    ) {
      alert('Faltan llenar Campos')
      return
    }
    var form_data = new FormData()
    form_data.append('file', file_data)
    form_data.append('funcion', 'actualizarUser')
    form_data.append('Nombres', nombres)
    form_data.append('Apellidos', apellidos)
    form_data.append('Ocupacion', ocupacion)
    form_data.append('Edad', edad)
    form_data.append('Correo', correo)
    form_data.append('Username', nombreUsuario)
    form_data.append('Contraseña', password)
    form_data.append('Descripcion', descripcion)
    form_data.append('Direccion', direccion)
    form_data.append('noTelefono', telefono)
    $.ajax({
      url: 'php/Usuario.php',
      type: 'POST',
      cache: false,
      contentType: false,
      data: form_data,
      dataType: 'text',
      enctype: 'multipart/form-data',
      processData: false,
    })
      .done(function () {
        $('#miModalEditarPerfil').modal('hide')
        $('#miModalPerfil').modal('show')
        cargarDatosUser()
        alert('Usuario Actualizado Correctamente')
      })
      // MANEJO DE ERRORES DEL SERVIDOR
      .fail(function (jqXHR, textStatus, errorThrown) {
        console.log('Error: ' + errorThrown)
      })
  }

  // SLIDER
  function iniciarDeslizador() {
    const deslizadorInterno = $('#deslizadorDetalle')
    let contador = 0
    const cantidadDeDiapositivas = deslizadorInterno.children().length

    // Función para mover el deslizador
    function deslizar() {
      if (contador >= cantidadDeDiapositivas - 1) {
        contador = 0
      } else {
        contador++
      }
      deslizadorInterno.css('transform', `translateX(-${contador * 28}rem)`)
    }

    // Eventos para pausar y reanudar el deslizador al pasar el mouse
    deslizadorInterno.on('mouseenter', () => {
      clearInterval(intervalo)
    })

    deslizadorInterno.on('mouseleave', () => {
      intervalo = setInterval(deslizar, 2000)
    })

    // Iniciar el deslizador automáticamente
    let intervalo = setInterval(deslizar, 2000)
  }
})

// Funciones de imagenes
let vista_preliminarEdit = (event) => {
  let leer_img = new FileReader()
  let id_img = document.getElementById('E_imgFoto')

  leer_img.onload = () => {
    if (leer_img.readyState == 2) {
      id_img.src = leer_img.result
    }
  }

  leer_img.readAsDataURL(event.target.files[0])
}
