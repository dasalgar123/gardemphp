<?php
/**
 * ARCHIVO: logica_vaciarPedido
 * DESCRIPCIÓN: Función para vaciar el pedido
 */

/**
 * Función para vaciar el pedido
 */
function logica_vaciarPedido() {
    $_SESSION['pedido'] = [];
    return "Pedido vaciado correctamente.";
}
?> 