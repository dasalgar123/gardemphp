<?php
session_start();

// ========== LIMPIAR SESIÓN AL INICIO ==========
// DESCOMENTA ESTA LÍNEA PARA LIMPIAR TODO
// unset($_SESSION['pedido']); $_SESSION['pedido'] = [];

// ========== CONFIGURACIÓN ==========
$TELEFONO_WHATSAPP = "573001234567"; // CAMBIA POR TU NÚMERO

// ========== INICIALIZAR CARRITO VACÍO ==========
if (!isset($_SESSION['pedido'])) {
    $_SESSION['pedido'] = [];
}

// ========== PROCESAR ACCIONES AJAX ==========
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';
    
    switch ($accion) {
        case 'agregar_producto':
            // SOLO AQUÍ se agregan productos
            $producto = [
                'nombre' => $_POST['nombre'] ?? '',
                'precio' => (int)($_POST['precio'] ?? 0),
                'cantidad' => (int)($_POST['cantidad'] ?? 1),
                'color' => $_POST['color'] ?? '',
                'talla' => $_POST['talla'] ?? ''
            ];
            
            // Verificar que todos los campos estén completos
            if (!empty($producto['nombre']) && $producto['precio'] > 0) {
                $_SESSION['pedido'][] = $producto;
                echo json_encode(['success' => true, 'message' => 'Producto agregado']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
            }
            exit;
            
        case 'procesar_pedido':
            if (empty($_SESSION['pedido'])) {
                echo json_encode(['success' => false, 'message' => 'Carrito vacío']);
                exit;
            }
            
            $mensaje = "🛒 *NUEVO PEDIDO*\n\n";
            $total = 0;
            
            foreach ($_SESSION['pedido'] as $item) {
                $subtotal = $item['precio'] * $item['cantidad'];
                $total += $subtotal;
                
                $mensaje .= "📦 *" . $item['nombre'] . "*\n";
                $mensaje .= "   • Color: " . $item['color'] . "\n";
                $mensaje .= "   • Talla: " . $item['talla'] . "\n";
                $mensaje .= "   • Cantidad: " . $item['cantidad'] . "\n";
                $mensaje .= "   • Subtotal: $" . number_format($subtotal, 0, ',', '.') . "\n\n";
            }
            
            $mensaje .= "💰 *TOTAL: $" . number_format($total, 0, ',', '.') . "*\n\n";
            $mensaje .= "📅 " . date('d/m/Y H:i:s');
            
            $url_whatsapp = "https://wa.me/{$TELEFONO_WHATSAPP}?text=" . urlencode($mensaje);
            echo json_encode(['success' => true, 'url' => $url_whatsapp]);
            exit;
            
        case 'vaciar_carrito':
            $_SESSION['pedido'] = [];
            echo json_encode(['success' => true]);
            exit;
            
        case 'eliminar_item':
            $index = (int)($_POST['index'] ?? -1);
            if (isset($_SESSION['pedido'][$index])) {
                unset($_SESSION['pedido'][$index]);
                $_SESSION['pedido'] = array_values($_SESSION['pedido']);
            }
            echo json_encode(['success' => true]);
            exit;
    }
}

// ========== FUNCIÓN PARA CALCULAR TOTAL ==========
function calcularTotal() {
    $total = 0;
    if (!empty($_SESSION['pedido'])) {
        foreach ($_SESSION['pedido'] as $item) {
            $total += ($item['precio'] ?? 0) * ($item['cantidad'] ?? 0);
        }
    }
    return $total;
}

// ========== VERIFICAR SI HAY PRODUCTOS ==========
$tieneProductos = !empty($_SESSION['pedido']) && count($_SESSION['pedido']) > 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Tienda - Carrito</title>
    <style>
        /* ========== ESTILOS ========== */
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; }
        
        .carrito-flotante {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #25d366;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 15px 20px;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(37, 211, 102, 0.4);
            z-index: 1000;
            font-size: 18px;
            display: <?php echo $tieneProductos ? 'block' : 'none'; ?>;
        }
        
        .carrito-contador {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #ff4444;
            color: white;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
        }
        
        .pedido-panel {
            position: fixed;
            top: 0;
            right: -400px;
            width: 400px;
            height: 100vh;
            background: white;
            box-shadow: -5px 0 15px rgba(0,0,0,0.3);
            transition: right 0.3s ease;
            z-index: 1001;
            overflow-y: auto;
        }
        
        .pedido-panel.visible { right: 0; }
        
        .pedido-header {
            background: #667eea;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .pedido-cerrar {
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
        }
        
        .pedido-item {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }
        
        .pedido-item-nombre {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        
        .pedido-item-detalles {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
        }
        
        .pedido-btn {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
        }
        
        .pedido-btn.principal {
            background: #25d366;
            color: white;
        }
        
        .pedido-btn.secundario {
            background: #ff4444;
            color: white;
        }
        
        .pedido-total {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }
        
        .pedido-vacio {
            text-align: center;
            padding: 50px 20px;
            color: #666;
        }
        
        /* ========== FORMULARIO DE PRUEBA ========== */
        .form-producto {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            border: 2px solid #ddd;
            border-radius: 10px;
            background: #f9f9f9;
        }
        
        .form-producto h3 {
            text-align: center;
            color: #333;
        }
        
        .form-grupo {
            margin-bottom: 15px;
        }
        
        .form-grupo label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        .form-grupo input, .form-grupo select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        
        .btn-agregar {
            width: 100%;
            padding: 15px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }
        
        .btn-agregar:hover {
            background: #5a67d8;
        }
        
        .debug-info {
            background: #ffe6e6;
            padding: 10px;
            margin: 20px;
            border-radius: 5px;
            font-family: monospace;
        }
    </style>
</head>
<body>

<!-- ========== INFORMACIÓN DE DEBUG ========== -->
<div class="debug-info">
    <strong>DEBUG - Estado del carrito:</strong><br>
    Productos en sesión: <?php echo count($_SESSION['pedido'] ?? []); ?><br>
    <pre><?php print_r($_SESSION['pedido'] ?? []); ?></pre>
</div>

<!-- ========== FORMULARIO DE PRUEBA PARA AGREGAR PRODUCTOS ========== -->
<div class="form-producto">
    <h3>🛍️ Agregar Producto al Carrito</h3>
    <form id="formProducto">
        <div class="form-grupo">
            <label>Nombre del producto:</label>
            <input type="text" id="nombre" required>
        </div>
        <div class="form-grupo">
            <label>Precio:</label>
            <input type="number" id="precio" required>
        </div>
        <div class="form-grupo">
            <label>Color:</label>
            <select id="color" required>
                <option value="">Seleccionar color</option>
                <option value="Rojo">Rojo</option>
                <option value="Azul">Azul</option>
                <option value="Verde">Verde</option>
                <option value="Negro">Negro</option>
                <option value="Blanco">Blanco</option>
            </select>
        </div>
        <div class="form-grupo">
            <label>Talla:</label>
            <select id="talla" required>
                <option value="">Seleccionar talla</option>
                <option value="XS">XS</option>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
            </select>
        </div>
        <div class="form-grupo">
            <label>Cantidad:</label>
            <input type="number" id="cantidad" value="1" min="1" required>
        </div>
        <button type="submit" class="btn-agregar">➕ Agregar al Carrito</button>
    </form>
</div>

<!-- ========== BOTÓN FLOTANTE ========== -->
<?php if ($tieneProductos): ?>
<button class="carrito-flotante" onclick="togglePedido()">
    🛒
    <span class="carrito-contador"><?php echo count($_SESSION['pedido']); ?></span>
</button>
<?php endif; ?>

<!-- ========== PANEL DEL PEDIDO ========== -->
<div class="pedido-panel" id="pedidoPanel">
    <div class="pedido-header">
        <h2>🛒 Tu Pedido</h2>
        <button class="pedido-cerrar" onclick="cerrarPedido()">×</button>
    </div>
    
    <?php if ($tieneProductos): ?>
        <div class="pedido-lista">
            <?php foreach ($_SESSION['pedido'] as $index => $item): ?>
                <div class="pedido-item">
                    <span class="pedido-item-nombre"><?php echo htmlspecialchars($item['nombre']); ?></span>
                    <div class="pedido-item-detalles">
                        Color: <?php echo htmlspecialchars($item['color']); ?> | 
                        Talla: <?php echo htmlspecialchars($item['talla']); ?> |
                        Cantidad: <?php echo $item['cantidad']; ?> |
                        Precio: $<?php echo number_format($item['precio'] * $item['cantidad'], 0, ',', '.'); ?>
                    </div>
                    <button onclick="eliminarItem(<?php echo $index; ?>)" style="background:#ff4444;color:white;border:none;padding:5px 10px;border-radius:3px;cursor:pointer;">
                        Eliminar
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="pedido-total">
            Total: $<?php echo number_format(calcularTotal(), 0, ',', '.'); ?>
        </div>
        
        <div style="padding: 20px;">
            <button class="pedido-btn principal" onclick="procesarPedido()">
                📱 Enviar por WhatsApp
            </button>
            <button class="pedido-btn secundario" onclick="vaciarCarrito()">
                🗑️ Vaciar Carrito
            </button>
        </div>
    <?php else: ?>
        <div class="pedido-vacio">
            <p>Tu carrito está vacío</p>
            <p>Usa el formulario de arriba para agregar productos</p>
        </div>
    <?php endif; ?>
</div>

<script>
// ========== AGREGAR PRODUCTO ========== 
document.getElementById('formProducto').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData();
    formData.append('accion', 'agregar_producto');
    formData.append('nombre', document.getElementById('nombre').value);
    formData.append('precio', document.getElementById('precio').value);
    formData.append('color', document.getElementById('color').value);
    formData.append('talla', document.getElementById('talla').value);
    formData.append('cantidad', document.getElementById('cantidad').value);
    
    fetch('', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('✅ Producto agregado al carrito');
            location.reload();
        } else {
            alert('❌ Error: ' + data.message);
        }
    });
});

// ========== FUNCIONES DEL CARRITO ==========
function togglePedido() {
    document.getElementById('pedidoPanel').classList.toggle('visible');
}

function cerrarPedido() {
    document.getElementById('pedidoPanel').classList.remove('visible');
}

function procesarPedido() {
    fetch('', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'accion=procesar_pedido'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.open(data.url, '_blank');
        } else {
            alert('Error: ' + data.message);
        }
    });
}

function vaciarCarrito() {
    if (confirm('¿Vaciar carrito?')) {
        fetch('', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'accion=vaciar_carrito'
        })
        .then(() => location.reload());
    }
}

function eliminarItem(index) {
    fetch('', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `accion=eliminar_item&index=${index}`
    })
    .then(() => location.reload());
}
</script>

</body>
</html>