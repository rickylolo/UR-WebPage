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
        
          <div class="d-flex flex-column">
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

  //------------------------- USUARIO ----------------------------
  $('#BtnEditarPerfil').click(funcActualizarUsuario)
  function funcActualizarUsuario() {
    //Verificacion contraseña
    var password = $('#editarPassword').val()
    var confirmarPassword = $('#editarConfirmarPassword').val()
    if (password != confirmarPassword) {
      alert('La contraseña no coincide reintenta nuevamente')
      return
    }
    var form_data = new FormData()
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
        cargarDatosUser()
        alert('Usuario Actualizado Correctamente')
      })
      // MANEJO DE ERRORES DEL SERVIDOR
      .fail(function (jqXHR, textStatus, errorThrown) {
        console.log('Error: ' + errorThrown)
      })
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
