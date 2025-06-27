<?php
/**
 * ARCHIVO: Inicialización de lógica
 * DESCRIPCIÓN: Incluye todos los archivos de lógica necesarios
 */

// Inicializar el carrito si no existe
if (!isset($_SESSION['pedido'])) {
    $_SESSION['pedido'] = [];
}

// INCLUIR TODOS LOS ARCHIVOS DE LÓGICA
require_once 'productos.php';                                    // Datos de productos
require_once 'imagenes.php';                                     // Función obtenerUrlImagen
require_once 'categorias.php';                                   // Función obtenerClaseCategoria
require_once 'colores.php';                                      // Función obtenerCodigoColor
require_once 'filtrarProductosPorCategoria.php';                 // Función filtrarProductosPorCategoria
require_once 'ordenarProductos.php';                             // Función ordenarProductos
require_once 'agregarAlPedido.php';                              // Función agregarAlPedido
require_once 'vaciarPedido.php';                                 // Función vaciarPedido
require_once 'calcularTotalPedido.php';                          // Función calcularTotalPedido
require_once 'procesarAcciones.php';                             // Función procesarAcciones
require_once 'obtenerDatosCatalogo.php';                         // Función obtenerDatosCatalogo
?> 