/**
 * ARCHIVO: carrusel.js
 * DESCRIPCIÓN: Lógica específica del carrusel automático
 */

/**
 * Función para inicializar el carrusel automático
 */
function inicializarCarrusel() {
    const slides = document.querySelectorAll('.carrucel-slide');
    let slideActual = 0;
    
    function mostrarSlide(indice) {
        // Ocultar todos los slides
        slides.forEach(slide => slide.classList.remove('active'));
        
        // Mostrar el slide actual
        slides[indice].classList.add('active');
    }
    
    function siguienteSlide() {
        slideActual = (slideActual + 1) % slides.length;
        mostrarSlide(slideActual);
    }
    
    // Auto-play del carrusel - Cambia cada 3 segundos
    setInterval(siguienteSlide, 3000);
}

// Inicializar carrusel cuando se carga el DOM
document.addEventListener('DOMContentLoaded', function() {
    inicializarCarrusel();
}); 