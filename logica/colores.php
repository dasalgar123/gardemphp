<?php
/**
 * ARCHIVO: Funciones relacionadas con colores
 * DESCRIPCIÓN: Contiene funciones para manejar colores de productos
 */

/**
 * Función para obtener el código de color
 */
function logica_obtenerCodigoColor($nombreColor) {
    $mapaColores = [
        'Negro' => '#000000',
        'Blanco' => '#FFFFFF',
        'Azul' => '#0000FF',
        'Azul marino' => '#000080',
        'Gris' => '#808080',
        'Rojo' => '#FF0000',
        'Verde' => '#008000',
        'Rosado' => '#FFC0CB',
        'Rosa' => '#FFC0CB',
        'Lila' => '#C8A2C8',
        'Morado' => '#800080',
        'Amarillo' => '#FFFF00',
        'Naranja' => '#FFA500',
        'Marrón' => '#A52A2A',
        'Bordó' => '#800020',
        'Celeste' => '#87CEEB'
    ];
    
    return isset($mapaColores[$nombreColor]) ? $mapaColores[$nombreColor] : '#ccc';
}
?> 