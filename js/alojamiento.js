$(document).ready(function () {
  $('.verDetalle').on('click', function () {
    window.location.replace('detalle.html')
  })

  $('#misRentas').hide()

  function mostrarRentas() {
    $('#misRentas').show()
    $('#misAlojamientos').hide()
  }

  function mostrarMisAlojamientos() {
    $('#misRentas').hide()
    $('#misAlojamientos').show()
  }

  $('#misRentasVer').click(function () {
    mostrarRentas()
  })

  $('#misAlojamientosVer').click(function () {
    mostrarMisAlojamientos()
  })

  // ----------------------------- CARGAR DATOS -----------------
  //------------------------- ALOJAMIENTO ----------------------------
  cargarDatosMisAlojamientos()
  function cargarDatosMisAlojamientos() {
    $.ajax({
      type: 'POST',
      data: { funcion: 'obtenerDataTodosAlojamientosUsuario' },
      url: 'php/Alojamiento.php',
    })
      .done(function (data) {
        var items = JSON.parse(data)
        $('#misAlojamientosContenido').empty()
        for (let i = 0; i < items.length; i++) {
          $('#misAlojamientosContenido').append(
            `   
         <article class="post">
					<div class="post-header">
						<a class="verDetalle" id="` +
              items[i].Alojamiento_id +
              `">
							<img src="data:image/jpeg;base64,` +
              items[i].imagenAlojamiento +
              `" class="post-img" />
						</a>
					</div>
					<div class="post-body">
						<h4><b>` +
              items[i].nombre +
              `</b></h4>
						<span>Propietario:
							<div class="vendedor">` +
              items[i].nombreCompleto +
              `</div>
						</span><br />
						<div class="d-flex justify-content-center abcAlojamiento">
							<p class="mb-1 verDetalle" id="` +
              items[i].Alojamiento_id +
              `">
								<button type="button" class="btn btn-success">
									<i class="bi bi-search"></i>
								</button>
							</p>
							<p class="mb-1" data-bs-toggle="modal" data-bs-target="#miModalEditarAlojamiento">
								<button type="button" id="` +
              items[i].Alojamiento_id +
              `" class="btn btn-primary editarAlojamiento">
									<i class="bi bi-pen"></i>
								</button>
							</p>
							<p class="mb-1">
								<button type="button" id="` +
              items[i].Alojamiento_id +
              `" class="btn btn-danger eliminarAlojamiento">
									<i class="bi bi-trash"></i>
								</button>
							</p>
						</div>
					</div>
				</article>

            `
          )
        }
      })
      .fail(function (data) {
        console.error(data)
      })
  }

  function cargarDatoAlojamiento(Alojamiento_id) {
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
        // Datos para editar mi perfil
        $('#editarNombreAlojamiento').val(items[0].nombre)
        $('#editarCaracteristicasAlojamiento').val(items[0].caracteristicas)
        $('#editarDireccionAlojamiento').val(items[0].direccion)
      })
      .fail(function (data) {
        console.error(data)
      })
  }

  $('#misAlojamientosContenido').on(
    'click',
    '.editarAlojamiento',
    funcEditarAlojamiento
  )
  function funcEditarAlojamiento() {
    let miIdAlojamiento = $(this).attr('id')
    $('#miAlojamientoSeleccionado').val(miIdAlojamiento)
    cargarDatoAlojamiento(miIdAlojamiento)
  }

  // ----------------------------- REGISTRO DATOS -----------------
  //------------------------- ALOJAMIENTO ----------------------------
  $('#BtnRegistroAlojamiento').click(funcRegistrarAlojamiento)
  function funcRegistrarAlojamiento() {
    var form_data = new FormData()
    var file_data = $('#registroImagenAlojamiento').prop('files')[0]
    var nombreAlojamiento = $('#registroNombreAlojamiento').val()
    var caracteristicasAlojamiento = $(
      '#registroCaracteristicasAlojamiento'
    ).val()
    var direccionAlojamiento = $('#registroDireccionAlojamiento').val()

    form_data.append('file', file_data)
    form_data.append('funcion', 'registrarAlojamiento')
    form_data.append('Nombre', nombreAlojamiento)
    form_data.append('Caracteristicas', caracteristicasAlojamiento)
    form_data.append('Direccion', direccionAlojamiento)
    $.ajax({
      url: 'php/Alojamiento.php',
      type: 'POST',
      cache: false,
      contentType: false,
      data: form_data,
      dataType: 'text',
      enctype: 'multipart/form-data',
      processData: false,
    })
      .done(function () {
        $('#registroNombreAlojamiento').val('')
        $('#registroImagenAlojamiento').val('')
        $('#registroCaracteristicasAlojamiento').val('')
        $('#registroDireccionAlojamiento').val('')
        cargarDatosMisAlojamientos()
        alert('Registro de alojamiento correctamente')
      })
      // MANEJO DE ERRORES DEL SERVIDOR
      .fail(function (jqXHR, textStatus, errorThrown) {
        console.log('Error: ' + errorThrown)
      })
  }

  // ----------------------------- ACTUALIZAR DATOS -----------------
  //------------------------- ALOJAMIENTO ----------------------------
  $('#BtnActualizarAlojamiento').click(funcActualizarAlojamiento)
  function funcActualizarAlojamiento() {
    var Alojamiento_id = $('#miAlojamientoSeleccionado').val()
    var form_data = new FormData()
    var file_data = $('#editarImagenAlojamiento').prop('files')[0]
    var nombreAlojamiento = $('#editarNombreAlojamiento').val()
    var caracteristicasAlojamiento = $(
      '#editarCaracteristicasAlojamiento'
    ).val()
    var direccionAlojamiento = $('#editarDireccionAlojamiento').val()

    form_data.append('file', file_data)
    form_data.append('funcion', 'actualizarAlojamiento')
    form_data.append('Alojamiento_id', Alojamiento_id)
    form_data.append('Nombre', nombreAlojamiento)
    form_data.append('Caracteristicas', caracteristicasAlojamiento)
    form_data.append('Direccion', direccionAlojamiento)
    $.ajax({
      url: 'php/Alojamiento.php',
      type: 'POST',
      cache: false,
      contentType: false,
      data: form_data,
      dataType: 'text',
      enctype: 'multipart/form-data',
      processData: false,
    })
      .done(function (data) {
        console.log(data)
        $('#miAlojamientoSeleccionado').val('')
        $('#editarImagenAlojamiento').val('')
        $('#editarNombreAlojamiento').val('')
        $('#editarCaracteristicasAlojamiento').val('')
        $('#editarDireccionAlojamiento').val('')
        cargarDatosMisAlojamientos()
        alert('Alojamiento actualizado correctamente')
      })
      // MANEJO DE ERRORES DEL SERVIDOR
      .fail(function (jqXHR, textStatus, errorThrown) {
        console.log('Error: ' + errorThrown)
      })
  }

  // ----------------------------- ELIMINAR DATOS -----------------
  //------------------------- ALOJAMIENTO ----------------------------
  $('#misAlojamientosContenido').on(
    'click',
    '.eliminarAlojamiento',
    funcEliminarAlojamiento
  )
  function funcEliminarAlojamiento() {
    let miIdAlojamiento = $(this).attr('id')
    if (confirm('¿Seguro deseas eliminar este alojamiento?')) {
      $.ajax({
        type: 'POST',
        data: {
          funcion: 'eliminarAlojamiento',
          Alojamiento_id: miIdAlojamiento,
        },
        url: 'php/Alojamiento.php',
      })
        .done(function () {
          cargarDatosMisAlojamientos()
          alert('Alojamiento eliminado correctamente')
        })
        .fail(function (data) {
          console.error(data)
        })
    }
  }
})
