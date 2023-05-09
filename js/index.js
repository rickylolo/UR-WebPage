$(document).ready(function () {
  $('#register').hide()
  $('#irRegistro').click(function () {
    $('#login').hide()
    $('#register').show()
  })

  $('#irLogin').click(function () {
    $('#register').hide()
    $('#login').show()
  })

  // INICIO DE SESION
  $('#BtnLogin').click(funcIniciarSesion)
  function funcIniciarSesion() {
    var usuario = $('#loginUsuario').val()
    var pass = $('#loginPassword').val()
    $.ajax({
      url: 'php/Usuario.php',
      type: 'POST',
      data: {
        funcion: 'iniciarSesion',
        username: usuario,
        password: pass,
      },
    })
      .done(function (data) {
        var items = JSON.parse(data)

        if (items.length == 0) {
          alert('No existen usuarios con esas credenciales, intenta nuevamente')
          return
        }
        window.location.replace('fyp.php')
      })
      // MANEJO DE ERRORES DEL SERVIDOR
      .fail(function (jqXHR, textStatus, errorThrown) {
        console.log('Error: ' + errorThrown)
      })
  }

  // ----------------------------- REGISTRO DATOS -----------------
  //------------------------- USUARIO ----------------------------
  $('#BtnRegistro').click(funcRegistrarUsuario)
  function funcRegistrarUsuario() {
    //Verificacion contraseña
    var password = $('#registroPassword').val()
    var confirmarPassword = $('#registroConfirmarPassword').val()
    if (password != confirmarPassword) {
      alert('La contraseña no coincide reintenta nuevamente')
      return
    }
    var form_data = new FormData()
    var file_data = $('#registroFotoPerfil').prop('files')[0]
    var nombres = $('#registroNombres').val()
    var apellidos = $('#registroApellidos').val()
    var ocupacion = $('#registroOcupacion').val()
    var edad = $('#registroEdad').val()
    var correo = $('#registroCorreo').val()
    var nombreUsuario = $('#registroNombreUsuario').val()
    var descripcion = $('#registroDescripcion').val()
    var direccion = $('#registroDireccion').val()
    var telefono = $('#registroTelefono').val()
    form_data.append('file', file_data)
    form_data.append('funcion', 'registrarUsuario')
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
      .done(function (data) {
        $('#registroFotoPerfil').val('')
        $('#registroNombres').val('')
        $('#registroApellidos').val('')
        $('#registroOcupacion').val('')
        $('#registroEdad').val('')
        $('#registroCorreo').val('')
        $('#registroNombreUsuario').val('')
        $('#registroDescripcion').val('')
        $('#registroDireccion').val('')
        $('#registroPassword').val('')
        $('#registroConfirmarPassword').val('')
        $('#registroTelefono').val('')
        $('#register').hide()
        $('#login').show()
        alert('Registro de usuario correctamente')
      })
      // MANEJO DE ERRORES DEL SERVIDOR
      .fail(function (jqXHR, textStatus, errorThrown) {
        console.log('Error: ' + errorThrown)
      })
  }
})
