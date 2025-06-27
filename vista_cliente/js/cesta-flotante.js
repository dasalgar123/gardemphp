// Función para actualizar el contador de la cesta flotante
function actualizarContadorCesta() {
    const contadorElement = document.querySelector('.btn-cesta-flotante .contador');
    const btnCesta = document.querySelector('.btn-cesta-flotante');
    
    // Obtener el total de items de la sesión PHP
    let totalItems = 0;
    
    // Hacer una petición AJAX para obtener el conteo actual
    fetch('logica/obtenerConteoCesta.php')
        .then(response => response.json())
        .then(data => {
            totalItems = data.totalItems || 0;
            
            if (totalItems > 0) {
                if (contadorElement) {
                    contadorElement.textContent = totalItems;
                } else {
                    // Crear el contador si no existe
                    const contador = document.createElement('span');
                    contador.className = 'contador';
                    contador.textContent = totalItems;
                    btnCesta.appendChild(contador);
                }
            } else {
                // Remover el contador si no hay items
                if (contadorElement) {
                    contadorElement.remove();
                }
            }
        })
        .catch(error => {
            console.error('Error al actualizar contador de cesta:', error);
        });
}

// Actualizar contador cuando se carga la página
document.addEventListener('DOMContentLoaded', function() {
    actualizarContadorCesta();
});

// Función para actualizar contador después de agregar productos
function actualizarContadorDespuesAgregar() {
    setTimeout(actualizarContadorCesta, 500); // Pequeño delay para asegurar que la sesión se actualice
} 