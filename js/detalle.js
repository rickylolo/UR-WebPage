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

// Iniciar el deslizador cuando se carga la página
document.addEventListener('DOMContentLoaded', iniciarDeslizador)
