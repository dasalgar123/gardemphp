<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "gardelcatalogo");
if ($conexion->connect_error) {
    die(json_encode(['error' => 'Conexión fallida: ' . $conexion->connect_error]));
}

$categoria = $_GET['categoria'] ?? 'todos';

// Consulta según la categoría seleccionada
if ($categoria === 'todos') {
    $sql = "SELECT nombre, imagen, descripcion, precio, tipo_producto FROM productos";
} else {
    $sql = "SELECT nombre, imagen, descripcion, precio, tipo_producto FROM productos WHERE tipo_producto = ?";
}

$stmt = $conexion->prepare($sql);
if ($categoria !== 'todos') {
    $stmt->bind_param("s", $categoria);
}

$stmt->execute();
$resultado = $stmt->get_result();

$productos = [];
while ($producto = $resultado->fetch_assoc()) {
    // Determinar la ruta de la imagen según la categoría
    $rutaImagen = '';
    switch ($producto['tipo_producto']) {
        case 'caballero':
            $rutaImagen = '../img/Caballeros/';
            break;
        case 'productosdamas':
            $rutaImagen = '../img/Damas/';
            break;
        case 'niños':
            $rutaImagen = '../img/Niños/';
            break;
        case 'niñas':
            $rutaImagen = '../img/Niñas/';
            break;
        default:
            $rutaImagen = '../img/';
    }
    
    $productos[] = [
        'nombre' => $producto['nombre'],
        'imagen' => $rutaImagen . $producto['imagen'],
        'descripcion' => $producto['descripcion'],
        'precio' => number_format($producto['precio'], 2, ',', '.'),
        'tipo_producto' => $producto['tipo_producto']
    ];
}

$stmt->close();
$conexion->close();

echo json_encode([
    'productos' => $productos,
    'categoria' => $categoria
]);
?> 