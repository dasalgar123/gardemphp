<?php
// Incluir configuración de base de datos
require_once __DIR__ . '/../config/database.php';

// Procesar acciones del formulario
$mensaje = logica_procesarAcciones();

try {
    // Obtener conexión a la base de datos
    $conn = getDatabaseConnection();
    
    if (!$conn) {
        throw new Exception("No se pudo conectar a la base de datos");
    }

    // Filtro por categoría
    $categoriaFiltro = $_GET['categoria'] ?? '';
    
    // Ordenamiento
    $orden = $_GET['orden'] ?? '';
    
    $sql = "SELECT * FROM productos";
    $whereConditions = [];
    
    if ($categoriaFiltro != '') {
        $whereConditions[] = "tipo_producto = '" . $conn->real_escape_string($categoriaFiltro) . "'";
    }
    
    if (!empty($whereConditions)) {
        $sql .= " WHERE " . implode(' AND ', $whereConditions);
    }
    
    // Aplicar ordenamiento
    switch ($orden) {
        case 'precio_desc':
            $sql .= " ORDER BY precio DESC";
            break;
        case 'precio_asc':
            $sql .= " ORDER BY precio ASC";
            break;
        case 'mas_reciente':
            $sql .= " ORDER BY id DESC";
            break;
        case 'mas_vendidos':
            $sql .= " ORDER BY stock ASC"; // Asumiendo que menor stock = más vendido
            break;
        default:
            $sql .= " ORDER BY id ASC";
    }

    $result = $conn->query($sql);
    
    if (!$result) {
        throw new Exception("Error en la consulta: " . $conn->error);
    }

    // Obtener colores
    $colores = [];
    $colores_result = $conn->query("SELECT nombre FROM colores ORDER BY nombre");
    if ($colores_result && $colores_result->num_rows > 0) {
        while ($color_row = $colores_result->fetch_assoc()) {
            $colores[] = $color_row['nombre'];
        }
    }

    // Obtener tallas
    $tallas_por_categoria = [];
    $tallas_result = $conn->query("SELECT nombre, categoria FROM tallas ORDER BY categoria, nombre");
    if ($tallas_result && $tallas_result->num_rows > 0) {
        while ($talla_row = $tallas_result->fetch_assoc()) {
            $cat = strtolower($talla_row['categoria']);
            if (!isset($tallas_por_categoria[$cat])) {
                $tallas_por_categoria[$cat] = [];
            }
            $tallas_por_categoria[$cat][] = $talla_row['nombre'];
        }
    }

    // Cerrar conexión
    closeDatabaseConnection($conn);

} catch (Exception $e) {
    error_log("Error en requerimientoindex.php: " . $e->getMessage());
    $result = null;
    $colores = [];
    $tallas_por_categoria = [];
    $mensaje = "Error al cargar los productos. Por favor, inténtelo más tarde.";
}
?>