$(document).ready(function () {
  $('.btn-danger').on('click', function (event) {
    confirm('¿Seguro que deseas eliminar este alojamiento?')
  })

  $('.verDetalle').on('click', function (event) {
    window.location.replace('detalle.html')
  })
})
