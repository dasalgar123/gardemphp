<?php
/**
 * ARCHIVO: logica_procesarAcciones
 * DESCRIPCIÓN: Función para procesar las acciones del formulario
 */

/**
 * Función para procesar las acciones del formulario
 */
function logica_procesarAcciones() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
        if ($_POST['action'] === 'agregar') {
            $producto = [
                'id' => $_POST['id'],
                'nombre' => $_POST['nombre'],
                'precio' => $_POST['precio'],
                'imagen' => $_POST['imagen'],
                'color' => $_POST['color'],
                'talla' => $_POST['talla'],
                'cantidad' => $_POST['cantidad']
            ];
            return logica_agregarAlPedido($producto);
        } elseif ($_POST['action'] === 'vaciar') {
            return logica_vaciarPedido();
        }
    }
    return null;
}
?> 