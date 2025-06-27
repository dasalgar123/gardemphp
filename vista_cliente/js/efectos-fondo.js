// ===================== EFECTOS DE FONDO - PARTÍCULAS FLOTANTES =====================
// Este archivo crea partículas animadas que flotan en el fondo de la página
// para dar un efecto visual atractivo y moderno al catálogo de ropa

/**
 * Crea partículas flotantes para el fondo de la página
 * - Genera 20 partículas blancas semi-transparentes
 * - Cada partícula tiene posición, tiempo y velocidad aleatorios
 * - Las partículas flotan desde abajo hacia arriba con rotación
 */
function crearParticulasFondo() {
    const contenedorParticulas = document.getElementById('particles');
    const cantidadParticulas = 20;
    
    for (let i = 0; i < cantidadParticulas; i++) {
        const particula = document.createElement('div');
        particula.className = 'particle';
        
        // Posición horizontal aleatoria (0% a 100%)
        particula.style.left = Math.random() * 100 + '%';
        
        // Retraso aleatorio para que no todas empiecen al mismo tiempo (0-6 segundos)
        particula.style.animationDelay = Math.random() * 6 + 's';
        
        // Duración aleatoria de la animación (4-7 segundos)
        particula.style.animationDuration = (Math.random() * 3 + 4) + 's';
        
        contenedorParticulas.appendChild(particula);
    }
}

// Inicializar efectos de fondo cuando se carga la página
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', crearParticulasFondo);
} else {
    crearParticulasFondo();
} 