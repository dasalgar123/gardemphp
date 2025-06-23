<?php
// 1. Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "gardelcatalogo");

// Verificar si hay error en la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// 2. Consulta para obtener nombre, imagen, descripción y precio
// NOTA: Sin punto y coma dentro de la cadena SQL, y con comillas cerradas
$sql = "SELECT nombre, imagen, descripcion, precio 
        FROM productos 
        WHERE tipo_producto = 'niña'";

// 3. Ejecutar la consulta
$resultado = $conexion->query($sql);

// Verificar si la consulta tuvo éxito
if (!$resultado) {
    die("Error en la consulta: " . $conexion->error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Galería de Productos para Niño</title>
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

    <h1>Galería de Productos para Niño</h1>
    <div class="galeria">
        <?php 
        // 4. Mostrar cada producto obtenido de la consulta
        while ($producto = $resultado->fetch_assoc()): ?>
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
// 5. Cerrar la conexión
$conexion->close();
?>
