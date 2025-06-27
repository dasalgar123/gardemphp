<?php
// Incluir configuración de base de datos
require_once __DIR__ . '/../config/database.php';

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
?>

<nav class="nav-productos">
    <div class="nav-container">
        <ul class="nav-list">
            <li class="nav-item">
                <a href="index.php" class="nav-link <?php echo empty($_GET['categoria']) ? 'categoria-activa' : ''; ?>">
                    🏠 Todos los Productos
                </a>
            </li>
            <?php foreach ($categorias as $categoria): ?>
                <li class="nav-item">
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
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</nav>