<?php
session_start();

// Incluir las funciones de lógica
require_once __DIR__ . '/agregarAlPedido.php';
require_once __DIR__ . '/vaciarPedido.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    switch ($action) {
        case 'cambiarCantidad':
            $index = intval($_POST['index'] ?? -1);
            $cambio = intval($_POST['cambio'] ?? 0);
            
            if ($index >= 0 && isset($_SESSION['pedido'][$index])) {
                $nuevaCantidad = $_SESSION['pedido'][$index]['cantidad'] + $cambio;
                if ($nuevaCantidad > 0) {
                    $_SESSION['pedido'][$index]['cantidad'] = $nuevaCantidad;
                    echo json_encode(['success' => true, 'cantidad' => $nuevaCantidad]);
                } else {
                    // Si la cantidad es 0 o menor, eliminar el producto
                    unset($_SESSION['pedido'][$index]);
                    $_SESSION['pedido'] = array_values($_SESSION['pedido']); // Reindexar array
                    echo json_encode(['success' => true, 'eliminado' => true]);
                }
            } else {
                echo json_encode(['success' => false, 'error' => 'Producto no encontrado']);
            }
            break;
            
        case 'eliminarProducto':
            $index = intval($_POST['index'] ?? -1);
            
            if ($index >= 0 && isset($_SESSION['pedido'][$index])) {
                unset($_SESSION['pedido'][$index]);
                $_SESSION['pedido'] = array_values($_SESSION['pedido']); // Reindexar array
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Producto no encontrado']);
            }
            break;
            
        case 'vaciarPedido':
            $_SESSION['pedido'] = [];
            echo json_encode(['success' => true]);
            break;
            
        default:
            echo json_encode(['success' => false, 'error' => 'Acción no válida']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Método no permitido']);
}
?> 