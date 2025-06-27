<?php
/**
 * ARCHIVO: logica_ordenarProductos
 * DESCRIPCIÓN: Función para ordenar productos
 */

/**
 * Función para ordenar productos
 */
function logica_ordenarProductos($productos, $orden) {
    if ($orden === 'price-asc') {
        usort($productos, function($a, $b) {
            return $a['precio'] - $b['precio'];
        });
    } elseif ($orden === 'price-desc') {
        usort($productos, function($a, $b) {
            return $b['precio'] - $a['precio'];
        });
    }
    
    return $productos;
}
?> 