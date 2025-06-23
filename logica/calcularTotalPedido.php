<?php
/**
 * ARCHIVO: logica_calcularTotalPedido
 * DESCRIPCIÓN: Función para calcular el total del pedido
 */

/**
 * Función para calcular el total del pedido
 */
function logica_calcularTotalPedido() {
    $total = 0;
    foreach ($_SESSION['pedido'] as $item) {
        $total += $item['precio'] * $item['cantidad'];
    }
    return $total;
}
?> 