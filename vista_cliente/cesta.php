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
  <title>Cesta de Pedido - Gardem</title>
  <link rel="stylesheet" href="css/index.css">
</head>
<body>

<?php include 'includes/header_cliente.php'; ?>

<div class="container">
    <!-- TERCERA FILA - NAVEGACIÓN CON FILTRO (100% ANCHO) -->
    <div class="nav-filtro-container">
        <div class="nav-categorias">
            <a href="index.php" class="nav-link">
                🏠 Volver al Catálogo
            </a>
            <a href="cesta.php" class="nav-link categoria-activa">
                🛒 Mi Cesta de Pedido
            </a>
        </div>
        
        <div class="filtro">
            <span style="color: #000000; font-weight: 600;">Cesta de Pedido</span>
        </div>
    </div>
    
    <!-- CUARTA FILA - CESTA COMPLETA (100% ANCHO) -->
    <div class="cesta-completa-container">
        <!-- CESTA DE PEDIDO (100% ANCHO) -->
        <div class="cesta-container">
            <?php include 'includes/cesta_pedido.php'; ?>
        </div>
    </div>
</div>

<script src="js/index.js"></script>
<script src="js/carrusel.js"></script>
<script src="js/efectos-fondo.js"></script>

</body>
</html> 