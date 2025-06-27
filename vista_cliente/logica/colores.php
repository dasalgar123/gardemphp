<?php
/**
 * ARCHIVO: Funciones relacionadas con colores
 * DESCRIPCIÓN: Contiene funciones para manejar colores de productos
 */

/**
 * Función para obtener el código de color (versión blanco y negro)
 */
function logica_obtenerCodigoColor($nombreColor) {
    $mapaColores = [
        'Negro' => '#000000',
        'Blanco' => '#FFFFFF',
        'Gris' => '#808080',
        'Gris claro' => '#D3D3D3',
        'Gris oscuro' => '#404040',
        'Azul' => '#333333',
        'Azul marino' => '#000000',
        'Rojo' => '#666666',
        'Verde' => '#555555',
        'Rosado' => '#CCCCCC',
        'Rosa' => '#CCCCCC',
        'Lila' => '#999999',
        'Morado' => '#444444',
        'Amarillo' => '#DDDDDD',
        'Naranja' => '#777777',
        'Marrón' => '#222222',
        'Bordó' => '#111111',
        'Celeste' => '#AAAAAA'
    ];
    
    return isset($mapaColores[$nombreColor]) ? $mapaColores[$nombreColor] : '#666666';
}
?> 