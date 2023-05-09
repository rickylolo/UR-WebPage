$(document).ready(function () {
  // ----------------------------- CARGAR DATOS -----------------

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

  //--------------------- SEARCH BAR ------------------

  $('#buscarAlojamientoSearch').click(funcBuscarAlojamiento)
  function funcBuscarAlojamiento() {
    let nombre = $('#miTextoSearch').val()

    $.ajax({
      type: 'POST',
      data: {
        funcion: 'obtenerAlojamientosSearch',
        Nombre: nombre,
      },
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

  // ----------------------------- ACTUALIZAR DATOS -----------------

  // Rentar Alojamiento
  $('#detalleAlojamiento').on(
    'click',
    '.rentarAlojamiento',
    funcRentarAlojamiento
  )
  function funcRentarAlojamiento() {
    let miIdPropietario = $('#miUsuarioPropietario').val()
    let miIdUserLoggeado = $('#miUserIdActual').val()
    if (miIdPropietario == miIdUserLoggeado) {
      alert('No puedes rentar tu propiedad')
      return
    }
    let miIdAlojamiento = $(this).attr('id')
    if (confirm('¿Estas seguro de rentar este alojamiento?')) {
      $.ajax({
        type: 'POST',
        data: {
          funcion: 'actualizarAlojamientoEstado',
          Alojamiento_id: miIdAlojamiento,
        },
        url: 'php/Alojamiento.php',
      })
        .done(function () {
          alert('Rentado Correctamente')
          cargarDatosAlojamientos()
          $('#detalleAlojamiento').hide()
        })
        .fail(function (data) {
          console.error(data)
        })
    }
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
