$(document).ready(function () {
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
							<img src="data:image/jpeg;base64,` +
            items[0].imagenAlojamiento +
            `">
						</div>
					</div>
					<div class="card-body">
						<h5 class="fw-bold card-title">Alojamiento San Nicolás</h5>
						<p class="card-text text-end text-primary">
							$` +
            items[0].renta +
            ` MXN Mensuales
						</p>
						<a href="" id="` +
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
											class="btn btn-primary">
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
      })
      .fail(function (data) {
        console.error(data)
      })
  }

  $('#AlojamientosFYP').on('click', '.verDetalle', funcVerAlojamiento)
  function funcVerAlojamiento() {
    let miIdAlojamiento = $(this).attr('id')
    cargaAlojamientoDetalle(miIdAlojamiento)
  }

  cargarDatosAlojamientos()
  function cargarDatosAlojamientos() {
    $.ajax({
      type: 'POST',
      data: { funcion: 'obtenerDataTodosAlojamiento' },
      url: 'php/Alojamiento.php',
    })
      .done(function (data) {
        var items = JSON.parse(data)
        $('#AlojamientosFYP').empty()
        for (let i = 0; i < items.length; i++) {
          $('#AlojamientosFYP').append(
            `   
        				<article class="post">
					<div class="post-header">
						<a href="#" id="` +
              items[i].Alojamiento_id +
              `" class="verDetalle">
							<img src="data:image/jpeg;base64,` +
              items[i].imagenAlojamiento +
              `" class="post-img" />
						</a>
					</div>
					<div class="post-body">
						<h4><b>` +
              items[i].nombre +
              `</b></h4>
						<span>Propietario
							<div class="vendedor">` +
              items[i].nombreCompleto +
              `</div>
						</span><br />
						<a class="btn btn-orange verDetalle" href="#" id="` +
              items[i].Alojamiento_id +
              `">Ver alojamiento</a>
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

  iniciarDeslizador()
  function iniciarDeslizador() {
    const deslizadorInterno = document.querySelector('.deslizador-interno')
    let contador = 0
    const cantidadDeDiapositivas = deslizadorInterno.children.length
    // Función para mover el deslizador
    function deslizar() {
      if (contador >= cantidadDeDiapositivas - 1) {
        contador = 0
      } else {
        contador++
      }
      deslizadorInterno.style.transform = `translateX(-${contador * 28}rem)`
    }

    // Eventos para pausar y reanudar el deslizador al pasar el mouse
    deslizadorInterno.addEventListener('mouseenter', () => {
      clearInterval(intervalo)
    })

    deslizadorInterno.addEventListener('mouseleave', () => {
      intervalo = setInterval(deslizar, 2000)
    })

    // Iniciar el deslizador automáticamente
    let intervalo = setInterval(deslizar, 2000)
  }
})
