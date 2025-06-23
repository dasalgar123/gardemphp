<?php
/**
 * ARCHIVO: logica_filtrarProductosPorCategoria
 * DESCRIPCIÓN: Función para filtrar productos por categoría
 */

/**
 * Función para filtrar productos por categoría
 */
function logica_filtrarProductosPorCategoria($productos, $categoria) {
    if ($categoria === 'Todos') {
        return $productos;
    }
    
    return array_filter($productos, function($producto) use ($categoria) {
        return $producto['category'] === $categoria;
    });
}
?> 