<?php
session_start();

// Configurar headers para JSON
header('Content-Type: application/json');

// Calcular el total de items en la cesta
$totalItems = 0;

if (isset($_SESSION['pedido']) && is_array($_SESSION['pedido'])) {
    foreach ($_SESSION['pedido'] as $item) {
        $totalItems += intval($item['cantidad']);
    }
}

// Devolver el resultado en formato JSON
echo json_encode([
    'success' => true,
    'totalItems' => $totalItems
]);
?> 