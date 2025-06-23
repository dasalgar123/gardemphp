<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "gardelcatalogo");
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Consulta para obtener nombre y ruta de los productos
$sql = "SELECT nombre, ruta FROM productos";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Imágenes de Productos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .galeria {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .producto {
            text-align: center;
        }
        .producto img {
            max-width: 160px;
            height: auto;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 2px 2px 6px rgba(0,0,0,0.1);
        }
        .nombre {
            margin-top: 8px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h1>Galería de Productos</h1>
    <div class="galeria">
        <?php while ($producto = $resultado->fetch_assoc()): ?>
            <div class="producto">
                <img src="<?= htmlspecialchars($producto['ruta']) ?>" alt="<?= htmlspecialchars($producto['nombre']) ?>">
                <div class="nombre"><?= htmlspecialchars($producto['nombre']) ?></div>
            </div>
        <?php endwhile; ?>
    </div>

</body>
</html>

<?php
$conexion->close();
?>
