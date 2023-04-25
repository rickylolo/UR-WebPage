$(document).ready(function () {
  $('#register').hide()
  $('#BtnLogin').click(function () {
    alert('Bienvenido')
    window.location = 'fyp.html'
  })

  $('#BtnRegistro').click(function () {
    alert('Registro Exitoso')
    window.location = 'index.html'
  })

  $('#irRegistro').click(function () {
    $('#login').hide()
    $('#register').show()
  })

  $('#irLogin').click(function () {
    $('#register').hide()
    $('#login').show()
  })
})
