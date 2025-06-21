<?php
// Configuración de la aplicación
define('SITE_NAME', 'Gardem');
define('SITE_URL', 'http://localhost/catalogoRopa');

// Configuración de la base de datos (si se usa en el futuro)
define('DB_HOST', 'localhost');
define('DB_NAME', 'catalogo_ropa');
define('DB_USER', 'root');
define('DB_PASS', '');

// Función para formatear precios
function formatearPrecio($precio) {
    return '$' . number_format($precio, 0, ',', '.');
}

// Función para validar datos de entrada
function validarEntrada($dato) {
    return htmlspecialchars(trim($dato), ENT_QUOTES, 'UTF-8');
}

// Función para mostrar mensajes
function mostrarMensaje($mensaje, $tipo = 'info') {
    if (isset($mensaje)) {
        $clase = $tipo === 'error' ? 'mensaje-error' : 'mensaje-info';
        return "<div class='$clase'>$mensaje</div>";
    }
    return '';
}
?> 