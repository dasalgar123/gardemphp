
<?php
/**
 * ARCHIVO: logica_agregarAlPedido
 * DESCRIPCIÓN: Función para agregar producto al pedido
 */

/**
 * Función para agregar producto al pedido
 */
function logica_agregarAlPedido($producto) {
    // Inicializar el pedido si no existe
    if (!isset($_SESSION['pedido']) || !is_array($_SESSION['pedido'])) {
        $_SESSION['pedido'] = [];
    }

    // Validar cantidad
    if (!isset($producto['cantidad']) || $producto['cantidad'] < 1) {
        $producto['cantidad'] = 1;
    }

    // Buscar si ya existe el producto con las mismas características
    $indiceExistente = -1;
    foreach ($_SESSION['pedido'] as $indice => $item) {
        if ($item['id'] === $producto['id'] && 
            $item['color'] === $producto['color'] && 
            $item['talla'] === $producto['talla']) {
            $indiceExistente = $indice;
            break;
        }
    }
    
    if ($indiceExistente !== -1) {
        // Si existe, actualizar la cantidad
        $_SESSION['pedido'][$indiceExistente]['cantidad'] += $producto['cantidad'];
        return "Se actualizó la cantidad de \"{$producto['nombre']}\" ({$producto['color']}) en el pedido.";
    } else {
        // Si no existe, lo añadimos al pedido
        $_SESSION['pedido'][] = $producto;
        return "Se añadieron {$producto['cantidad']} \"{$producto['nombre']}\" ({$producto['color']}) al pedido.";
    }
}
?>