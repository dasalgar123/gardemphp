<?php
/**
 * ARCHIVO: logica_obtenerDatosCatalogo
 * DESCRIPCIÓN: Función para obtener los datos procesados del catálogo
 */

/**
 * Función para obtener los datos procesados del catálogo
 */
function logica_obtenerDatosCatalogo() {
    global $ElementoProductos;
    
    // Obtener parámetros de la URL
    $categoriaSeleccionada = isset($_GET['categoria']) ? $_GET['categoria'] : 'Todos';
    $ordenarPor = isset($_GET['sort']) ? $_GET['sort'] : 'default';
    
    // Filtrar y ordenar productos
    $productosFiltrados = logica_filtrarProductosPorCategoria($ElementoProductos, $categoriaSeleccionada);
    $productosOrdenados = logica_ordenarProductos($productosFiltrados, $ordenarPor);
    
    return [
        'productos' => $productosOrdenados,
        'categoria' => $categoriaSeleccionada,
        'orden' => $ordenarPor
    ];
}
?> 