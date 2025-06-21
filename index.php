<?php
session_start();

// Inicializar el carrito si no existe
if (!isset($_SESSION['pedido'])) {
    $_SESSION['pedido'] = [];
}

// Manejar agregar al pedido
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'agregar') {
    $producto = [
        'id' => $_POST['id'],
        'nombre' => $_POST['nombre'],
        'precio' => $_POST['precio'],
        'imagen' => $_POST['imagen'],
        'color' => $_POST['color'],
        'talla' => $_POST['talla'],
        'cantidad' => $_POST['cantidad']
    ];
    
    // Buscar si ya existe el producto con las mismas características
    $existingIndex = -1;
    foreach ($_SESSION['pedido'] as $index => $item) {
        if ($item['id'] === $producto['id'] && 
            $item['color'] === $producto['color'] && 
            $item['talla'] === $producto['talla']) {
            $existingIndex = $index;
            break;
        }
    }
    
    if ($existingIndex !== -1) {
        // Si existe, actualizar la cantidad
        $_SESSION['pedido'][$existingIndex]['cantidad'] += $producto['cantidad'];
        $mensaje = "Se actualizó la cantidad de \"{$producto['nombre']}\" ({$producto['color']}) en el pedido.";
    } else {
        // Si no existe, lo añadimos al pedido
        $_SESSION['pedido'][] = $producto;
        $mensaje = "Se añadieron {$producto['cantidad']} \"{$producto['nombre']}\" ({$producto['color']}) al pedido.";
    }
}

// Manejar vaciar pedido
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'vaciar') {
    $_SESSION['pedido'] = [];
    $mensaje = "Pedido vaciado correctamente.";
}

// Obtener categoría seleccionada
$categoriaSeleccionada = isset($_GET['categoria']) ? $_GET['categoria'] : 'Todos';

// Obtener orden de productos
$sortBy = isset($_GET['sort']) ? $_GET['sort'] : 'default';

// Incluir datos de productos
require_once 'includes/productos.php';
require_once 'includes/config.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Ropa - Gardem</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/catalogo.css">
    <link rel="stylesheet" href="assets/css/tarjeta.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/carrucel.css">
    <link rel="stylesheet" href="assets/css/pedido.css">
    <link rel="stylesheet" href="assets/css/whatsapp.css">
    <link rel="stylesheet" href="assets/css/filtro.css">
</head>
<body>
    <div class="App">
        <header class="App-header">
            <?php include 'includes/carrucel.php'; ?>
            <?php include 'includes/nav-productos.php'; ?>
            <?php include 'includes/filtro-precio.php'; ?>
            
            <div style="position: absolute; top: 1rem; right: 1rem; z-index: 1000;">
                <a href="admin/" target="_blank" class="admin-button">
                    🔧 Administración
                </a>
            </div>
        </header>

        <main>
            <?php include 'includes/catalogo.php'; ?>
        </main>

        <?php include 'includes/footer.php'; ?>
        <?php include 'includes/whatsapp.php'; ?>
    </div>

    <script src="assets/js/app.js"></script>
</body>
</html> 