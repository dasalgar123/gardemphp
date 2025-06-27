<?php
/**
 * ARCHIVO: Configuración de Base de Datos
 * DESCRIPCIÓN: Configuración centralizada para la conexión a la base de datos
 */

// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_NAME', 'gardelcatalogo');
define('DB_USER', 'root');
define('DB_PASS', '');

// Configuración de la aplicación
define('APP_NAME', 'Gardem');
define('APP_VERSION', '1.0.0');
define('APP_URL', 'http://localhost/catalogoRopa/vista_cliente/');

// Configuración de WhatsApp Business
define('WHATSAPP_NUMBERS', [
    '573216798086' // Número principal de WhatsApp Business
]);

// Configuración de imágenes
define('DEFAULT_IMAGE', 'img/logo/logo.jpg');
define('IMAGES_PATH', 'img/');

// Configuración de sesión
define('SESSION_LIFETIME', 3600); // 1 hora

/**
 * Función para obtener conexión a la base de datos
 */
function getDatabaseConnection() {
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        
        if ($conn->connect_error) {
            throw new Exception("Conexión fallida: " . $conn->connect_error);
        }
        
        // Configurar charset
        $conn->set_charset("utf8mb4");
        
        return $conn;
    } catch (Exception $e) {
        error_log("Error de conexión a base de datos: " . $e->getMessage());
        return null;
    }
}

/**
 * Función para cerrar conexión a la base de datos
 */
function closeDatabaseConnection($conn) {
    if ($conn && $conn instanceof mysqli) {
        $conn->close();
    }
}
?> 