<?php
session_start();

// INCLUIR ARCHIVO DE LÓGICA
require_once '../logica/init.php';

// PROCESAR ACCIONES
$mensaje = logica_procesarAcciones();

// OBTENER DATOS DEL CATÁLOGO
$datosCatalogo = logica_obtenerDatosCatalogo();
$productosMostrados = $datosCatalogo['productos'];
$categoriaSeleccionada = $datosCatalogo['categoria'];
$ordenarPor = $datosCatalogo['orden'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Ropa - Gardem</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/index.css">
   <link rel="stylesheet" href="../css/tarjeta.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/carrucel.css">
    <link rel="stylesheet" href="../css/pedido.css">
    <link rel="stylesheet" href="../css/filtro.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <!-- Efecto de partículas flotantes -->
    <div class="floating-particles" id="particles"></div>
    
    <div class="App">
        <header class="App-header">
            <!-- Título y Navegación -->
            <?php include '../includes/titulo.php'; ?>
            
            <div style="position: absolute; top: 1rem; right: 1rem; z-index: 1000;">
                <a href="admin/" target="_blank" class="admin-button">
                    🔧 Administración
                </a>
            </div>
        </header>

        <main>
            <!-- CATÁLOGO COMPLETO -->
            <div class="catalogo-container">
                <div class="catalogo-productos">
                    <h2 class="<?php echo logica_obtenerClaseCategoria($categoriaSeleccionada); ?>"><?php echo htmlspecialchars($categoriaSeleccionada); ?></h2>
                    
                    <div class="catalogo-grid">
                        <?php if (!empty($productosMostrados)): ?>
                            <?php foreach ($productosMostrados as $producto): ?>
                                <?php include '../includes/tarjeta-producto.php'; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No hay productos que coincidan con tu búsqueda.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

          </main>

        <!-- Footer -->
        <?php include '../includes/footer.php'; ?>

        <!-- WhatsApp -->
        <?php include '../includes/whatsapp.php'; ?>
    </div>

    <!-- IMPORTAR ARCHIVOS JAVASCRIPT -->
    <script src="../assets/js/app.js"></script>
    <script src="../assets/js/carrusel.js"></script>
    
    <!-- Script para partículas flotantes -->
    <script>
        // Crear partículas flotantes
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 20;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                
                // Posición aleatoria
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 6 + 's';
                particle.style.animationDuration = (Math.random() * 3 + 4) + 's';
                
                particlesContainer.appendChild(particle);
            }
        }
        
        // Inicializar partículas cuando se carga la página
        document.addEventListener('DOMContentLoaded', createParticles);
    </script>
</body>
</html> 