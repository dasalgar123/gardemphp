<?php
/**
 * ARCHIVO: Funciones relacionadas con categorías
 * DESCRIPCIÓN: Contiene funciones para manejar categorías de productos
 */

/**
 * Función para obtener la clase CSS de categoría
 */
function logica_obtenerClaseCategoria($categoria) {
    $categoriaLower = strtolower($categoria);
    switch ($categoriaLower) {
        case 'caballeros':
            return 'categoria-caballeros';
        case 'damas':
            return 'categoria-damas';
        case 'niños':
            return 'categoria-ninos';
        case 'niñas':
            return 'categoria-ninas';
        default:
            return 'categoria-todos';
    }
}
?> 