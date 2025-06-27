<?php
session_start();
// Incluir la inicialización de lógica
require_once 'logica/init.php';
// Incluir requerimientos
include 'requerimientos/requerimientoindex.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Catálogo de Productos - Gardem</title>
  <link rel="stylesheet" href="css/index.css">
</head>
<body>

<?php include 'includes/header_cliente.php'; ?>

<div class="container">
    <!-- TERCERA FILA - NAVEGACIÓN CON FILTRO (100% ANCHO) -->
    <div class="nav-filtro-container">
        <div class="nav-categorias">
            <a href="index.php" class="nav-link <?php echo empty($_GET['categoria']) ? 'categoria-activa' : ''; ?>">
                🏠 Todos los Productos
            </a>
            <?php 
            // Obtener categorías de la base de datos
            $categorias = [];
            try {
                $conn = getDatabaseConnection();
                if ($conn) {
                    $categorias_result = $conn->query("SELECT DISTINCT tipo_producto FROM productos ORDER BY tipo_producto");
                    if ($categorias_result && $categorias_result->num_rows > 0) {
                        while ($categoria_row = $categorias_result->fetch_assoc()) {
                            $categorias[] = $categoria_row['tipo_producto'];
                        }
                    }
                    closeDatabaseConnection($conn);
                }
            } catch (Exception $e) {
                error_log("Error al obtener categorías: " . $e->getMessage());
            }
            
            foreach ($categorias as $categoria): ?>
                <a href="index.php?categoria=<?php echo urlencode($categoria); ?>" 
                   class="nav-link <?php echo (isset($_GET['categoria']) && $_GET['categoria'] === $categoria) ? 'categoria-activa' : ''; ?>">
                    <?php 
                    $icono = '';
                    switch (strtolower($categoria)) {
                        case 'caballeros':
                            $icono = '👔';
                            break;
                        case 'damas':
                            $icono = '👗';
                            break;
                        case 'niños':
                            $icono = '👦';
                            break;
                        case 'niñas':
                            $icono = '👧';
                            break;
                        default:
                            $icono = '👕';
                    }
                    echo $icono . ' ' . htmlspecialchars($categoria); 
                    ?>
                </a>
            <?php endforeach; ?>
        </div>
        
        <div class="filtro">
            <form method="GET" action="">
                <label>Filtrar por: </label>
                <select name="orden" onchange="this.form.submit()">
                    <option value="">Seleccionar</option>
                    <option value="precio_desc">Precio: Mayor a Menor</option>
                    <option value="precio_asc">Precio: Menor a Mayor</option>
                    <option value="mas_reciente">Más Reciente</option>
                    <option value="mas_vendidos">Más Vendidos</option>
                </select>
            </form>
        </div>
    </div>
    
    <!-- CUARTA FILA - CATÁLOGO (100% ANCHO) -->
    <div class="catalogo-container">
        <div class="productos">
            <?php
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $mapa_categoria_tallas = [
                        'caballero' => 'hombres',
                        'dama' => 'mujeres',
                        'niño' => 'niños',
                        'niña' => 'niñas',
                    ];
                    $tipo = strtolower($row['tipo_producto'] ?? '');
                    $cat = isset($mapa_categoria_tallas[$tipo]) ? $mapa_categoria_tallas[$tipo] : $tipo;
                    $producto = [
                        'id' => $row['id'],
                        'nombre' => $row['nombre'],
                        'descripcion' => $row['descripcion'],
                        'precio' => $row['precio'],
                        'colores' => isset($colores) ? $colores : [],
                        'tallas' => isset($cat) && isset($tallas_por_categoria[$cat]) ? $tallas_por_categoria[$cat] : [],
                        'imagen' => $row['imagen'],
                        'category' => $row['tipo_producto'],
                        'stock' => $row['stock'] ?? 0
                    ];
                    include 'includes/tarjeta-producto.php';
                }
            } else {
                echo "<p>No hay productos para mostrar.</p>";
            }
            ?>
        </div>
    </div>
    
    <!-- Botón flotante para ir a la cesta -->
    <button onclick="window.location.href='cesta.php'" class="btn-cesta-flotante" title="Ver mi cesta de pedido">
        🛒
        <?php 
        $totalItems = 0;
        if (isset($_SESSION['pedido']) && is_array($_SESSION['pedido'])) {
            foreach ($_SESSION['pedido'] as $item) {
                $totalItems += intval($item['cantidad']);
            }
        }
        if ($totalItems > 0): ?>
            <span class="contador"><?php echo $totalItems; ?></span>
        <?php endif; ?>
    </button>
</div>

<script src="js/index.js"></script>
<script src="js/carrusel.js"></script>
<script src="js/efectos-fondo.js"></script>
<script src="js/cesta-flotante.js"></script>

</body>
</html>