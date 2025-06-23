<?php
/**
 * ARCHIVO: Funciones relacionadas con imágenes
 * DESCRIPCIÓN: Contiene funciones para manejar imágenes de productos
 */

/**
 * Función para obtener la URL correcta de la imagen
 */
function logica_obtenerUrlImagen($producto) {
    if ($producto['imagen']) {
        // Convertir ruta relativa a absoluta desde vista/index.php
        return '../' . $producto['imagen'];
    }
    return '../img/logo/logo.jpg'; // Imagen por defecto
}
?> 