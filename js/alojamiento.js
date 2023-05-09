$(document).ready(function () {
  $('.verDetalle').on('click', function () {
    window.location.replace('detalle.html')
  })

  $('#misRentasVer').click(function () {
    $('#misAlojamientosVer').removeClass('active')
    $(this).addClass('active')
  })

  $('#misAlojamientosVer').click(function () {
    $('#misRentasVer').removeClass('active')
    $(this).addClass('active')
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
      data: { funcion: 'obtenerDataTodosAlojamientosUsuarioVendedor' },
      url: 'php/Alojamiento.php',
    })
      .done(function (data) {
        let items = JSON.parse(data)
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
								<button type="button" class="btn btn-success añadirMultimedia" id="` +
              items[i].Alojamiento_id +
              `" data-bs-toggle="modal" data-bs-target="#miModalMultimedia">
									<i class="bi bi-images"></i>
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

  cargarDatosMisRentas()
  function cargarDatosMisRentas() {
    $.ajax({
      type: 'POST',
      data: { funcion: 'obtenerDataTodosAlojamientosUsuarioArrendador' },
      url: 'php/Alojamiento.php',
    })
      .done(function (data) {
        let items = JSON.parse(data)
        $('#misRentasContenido').empty()
        for (let i = 0; i < items.length; i++) {
          $('#misRentasContenido').append(
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
        let items = JSON.parse(data)
        // Datos para editar mi perfil
        $('#editarNombreAlojamiento').val(items[0].nombre)
        $('#editarCaracteristicasAlojamiento').val(items[0].caracteristicas)
        $('#editarDireccionAlojamiento').val(items[0].direccion)
        $('#editarRentaAlojamiento').val(items[0].renta)
      })
      .fail(function (data) {
        console.error(data)
      })
  }

  function cargarMultimediaAlojamiento(Alojamiento_id) {
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
        $('#miMultimediaAlojamiento').empty()
        for (let i = 0; i < items.length; i++) {
          $('#miMultimediaAlojamiento').append(
            `<a class="p-4 list-group-item list-group-item-action" aria-current="true">
                <div class="miMultimedia d-flex w-100 justify-content-between">
                    <div class="d-flex flex-fill">
                        <img  src="data:image/jpeg;base64,` +
              items[i].multimedia +
              `" >
                    </div>
                    <p class="mb-1"><button type="button" id="` +
              items[i].Multimedia_id +
              `" class="btn eliminarMultimedia btn-danger"><i class="bi bi-trash"></i></button>
                    </p>

                </div>


            </a>`
          )
        }
      })
      .fail(function (data) {
        console.error(data)
      })
  }
  // ------------ EDITAR ALOJAMIENTO DATOS ------------
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

  // ------------ VER MULTIMEDIA ------------
  $('#misAlojamientosContenido').on(
    'click',
    '.añadirMultimedia',
    funcAñadirMultimedia
  )
  function funcAñadirMultimedia() {
    let miIdAlojamiento = $(this).attr('id')
    $('#idAlojamientoMultimedia').val(miIdAlojamiento)
    cargarMultimediaAlojamiento(miIdAlojamiento)
  }

  // ----------------------------- REGISTRO DATOS -----------------
  //------------------------- ALOJAMIENTO ----------------------------
  $('#BtnRegistroAlojamiento').click(funcRegistrarAlojamiento)
  function funcRegistrarAlojamiento() {
    let form_data = new FormData()
    let file_data = $('#registroImagenAlojamiento').prop('files')[0]
    let nombreAlojamiento = $('#registroNombreAlojamiento').val()
    let caracteristicasAlojamiento = $(
      '#registroCaracteristicasAlojamiento'
    ).val()
    let direccionAlojamiento = $('#registroDireccionAlojamiento').val()
    let costoAlojamiento = $('#registroRentaAlojamiento').val()

    form_data.append('file', file_data)
    form_data.append('funcion', 'registrarAlojamiento')
    form_data.append('Nombre', nombreAlojamiento)
    form_data.append('Caracteristicas', caracteristicasAlojamiento)
    form_data.append('Direccion', direccionAlojamiento)
    form_data.append('Renta', costoAlojamiento)
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
        $('#registroNombreAlojamiento').val('')
        $('#registroImagenAlojamiento').val('')
        $('#registroCaracteristicasAlojamiento').val('')
        $('#registroDireccionAlojamiento').val('')
        $('#registroRentaAlojamiento').val('')
        cargarDatosMisAlojamientos()
        alert('Registro de alojamiento correctamente')
      })
      // MANEJO DE ERRORES DEL SERVIDOR
      .fail(function (jqXHR, textStatus, errorThrown) {
        console.log('Error: ' + errorThrown)
      })
  }

  //------------------------- MULTIMEDIA ALOJAMIENTO ----------------------------
  $('#BtnRegistroMultimedia').click(funcRegistrarMultimediaAlojamiento)
  function funcRegistrarMultimediaAlojamiento() {
    let form_data = new FormData()
    let file_data = $('#añadirMultimedia').prop('files')[0]
    let AlojamientoId = $('#idAlojamientoMultimedia').val()

    form_data.append('file', file_data)
    form_data.append('funcion', 'registrarMultimedia')
    form_data.append('Alojamiento_id', AlojamientoId)

    $.ajax({
      url: 'php/Multimedia.php',
      type: 'POST',
      cache: false,
      contentType: false,
      data: form_data,
      dataType: 'text',
      enctype: 'multipart/form-data',
      processData: false,
    })
      .done(function () {
        $('#añadirMultimedia').val('')

        cargarMultimediaAlojamiento(AlojamientoId)
        alert('Registro de imagen correctamente')
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
    let Alojamiento_id = $('#miAlojamientoSeleccionado').val()
    let form_data = new FormData()
    let file_data = $('#editarImagenAlojamiento').prop('files')[0]
    let nombreAlojamiento = $('#editarNombreAlojamiento').val()
    let caracteristicasAlojamiento = $(
      '#editarCaracteristicasAlojamiento'
    ).val()
    let direccionAlojamiento = $('#editarDireccionAlojamiento').val()
    let costoAlojamiento = $('#editarRentaAlojamiento').val()

    form_data.append('file', file_data)
    form_data.append('funcion', 'actualizarAlojamiento')
    form_data.append('Alojamiento_id', Alojamiento_id)
    form_data.append('Nombre', nombreAlojamiento)
    form_data.append('Caracteristicas', caracteristicasAlojamiento)
    form_data.append('Direccion', direccionAlojamiento)
    form_data.append('Renta', costoAlojamiento)
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
        $('#miAlojamientoSeleccionado').val('')
        $('#editarImagenAlojamiento').val('')
        $('#editarNombreAlojamiento').val('')
        $('#editarCaracteristicasAlojamiento').val('')
        $('#editarDireccionAlojamiento').val('')
        $('#editarRentaAlojamiento').val('')
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

  //------------------------- MULTIMEDIA ----------------------------
  $('#miMultimediaAlojamiento').on(
    'click',
    '.eliminarMultimedia',
    funcEliminarMultimedia
  )
  function funcEliminarMultimedia() {
    let miIdMultimedia = $(this).attr('id')
    let Alojamiento_id = $('#idAlojamientoMultimedia').val()
    if (confirm('¿Seguro deseas eliminar esta imagen?')) {
      $.ajax({
        type: 'POST',
        data: {
          funcion: 'eliminarMultimedia',
          Multimedia_id: miIdMultimedia,
        },
        url: 'php/Multimedia.php',
      })
        .done(function () {
          cargarMultimediaAlojamiento(Alojamiento_id)
          alert('Imagen eliminada correctamente')
        })
        .fail(function (data) {
          console.error(data)
        })
    }
  }
})
