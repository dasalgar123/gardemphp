<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "gardelcatalogo");
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Consulta para obtener nombre, imagen, descripción y precio
$sql = "SELECT nombre, imagen, descripcion, precio 
FROM productos 
WHERE tipo_producto = 'niño';
";

$resultado = $conexion->query($sql);
if (!$resultado) {
    die("Error en la consulta: " . $conexion->error);
}
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
            width: 180px;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 2px 2px 6px rgba(0,0,0,0.1);
        }
        .producto img {
            max-width: 160px;
            height: auto;
            border-radius: 6px;
        }
        .nombre {
            margin-top: 8px;
            font-weight: bold;
        }
        .descripcion {
            font-size: 0.9em;
            color: #555;
            margin-top: 4px;
            min-height: 40px;
        }
        .precio {
            margin-top: 6px;
            font-weight: bold;
            color: #0a7;
        }
    </style>
</head>
<body>

    <h1>Galería de Productos</h1>
    <div class="galeria">
        <?php while ($producto = $resultado->fetch_assoc()): ?>
            <div class="producto">
                <img src="imagenes/<?= htmlspecialchars($producto['imagen']) ?>" alt="<?= htmlspecialchars($producto['nombre']) ?>">
                <div class="nombre"><?= htmlspecialchars($producto['nombre']) ?></div>
                <div class="descripcion"><?= htmlspecialchars($producto['descripcion']) ?></div>
                <div class="precio">$<?= number_format($producto['precio'], 2, ',', '.') ?></div>
            </div>
        <?php endwhile; ?>
    </div>

</body>
</html>

<?php
$conexion->close();
?>

