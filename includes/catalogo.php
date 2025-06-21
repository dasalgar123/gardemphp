<?php
// Filtrar productos por categoría
$productosMostrados = $ElementoProductos;
if ($categoriaSeleccionada !== 'Todos') {
    $productosMostrados = array_filter($ElementoProductos, function($producto) use ($categoriaSeleccionada) {
        return $producto['category'] === $categoriaSeleccionada;
    });
}

// Ordenar productos
if ($sortBy === 'price-asc') {
    usort($productosMostrados, function($a, $b) {
        return $a['precio'] - $b['precio'];
    });
} elseif ($sortBy === 'price-desc') {
    usort($productosMostrados, function($a, $b) {
        return $b['precio'] - $a['precio'];
    });
}

// Función para obtener la URL correcta de la imagen
function getImageUrl($producto) {
    if ($producto['imagen']) {
        return $producto['imagen'];
    }
    return 'img/logo/logo.jpg'; // Imagen por defecto
}
?>

<div class="catalogo-container">
    <div class="catalogo-productos">
        <div class="titulo-container">
            <h1 class="titulo-principal">Gardem</h1>
        </div>
        <h2><?php echo htmlspecialchars($categoriaSeleccionada); ?></h2>
        
        <div class="catalogo-grid">
            <?php if (!empty($productosMostrados)): ?>
                <?php foreach ($productosMostrados as $producto): ?>
                    <div class="tarjeta-contenedorPrincipal">
                        <!-- Imagen del producto -->
                        <div class="tarjeta-contenedorVisual">
                            <img src="<?php echo htmlspecialchars(getImageUrl($producto)); ?>" 
                                 alt="<?php echo htmlspecialchars($producto['nombre']); ?>" 
                                 class="tarjeta-imagen" />
                        </div>

                        <!-- Contenedor para la información permanente -->
                        <div class="tarjeta-informacionPermanente">
                            <h3 class="tarjeta-titulo"><?php echo htmlspecialchars($producto['nombre']); ?></h3>
                            <p class="tarjeta-descripcion"><?php echo htmlspecialchars($producto['descripcion']); ?></p>
                            
                            <form method="POST" action="" class="producto-form">
                                <input type="hidden" name="action" value="agregar">
                                <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
                                <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>">
                                <input type="hidden" name="precio" value="<?php echo $producto['precio']; ?>">
                                <input type="hidden" name="imagen" value="<?php echo htmlspecialchars($producto['imagen']); ?>">
                                
                                <!-- Selección de color -->
                                <div class="tarjeta-opciones">
                                    <p>Color:</p>
                                    <div class="tarjeta-contenedorOpciones">
                                        <?php if (!empty($producto['colores'])): ?>
                                            <?php foreach ($producto['colores'] as $color): ?>
                                                <div class="color-option">
                                                    <input type="radio" 
                                                           name="color" 
                                                           value="<?php echo htmlspecialchars($color); ?>" 
                                                           id="color_<?php echo $producto['id']; ?>_<?php echo htmlspecialchars($color); ?>"
                                                           required>
                                                    <label for="color_<?php echo $producto['id']; ?>_<?php echo htmlspecialchars($color); ?>"
                                                           class="tarjeta-puntoColor"
                                                           style="background-color: <?php echo getColorCode($color); ?>;"
                                                           title="<?php echo htmlspecialchars($color); ?>">
                                                    </label>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <span style="color: #999; font-size: 0.9rem;">No hay colores disponibles</span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- Selección de talla -->
                                <?php if (!empty($producto['tallas'])): ?>
                                    <div class="tarjeta-opciones">
                                        <p>Talla:</p>
                                        <div class="tarjeta-contenedorOpciones">
                                            <?php foreach ($producto['tallas'] as $talla): ?>
                                                <div class="talla-option">
                                                    <input type="radio" 
                                                           name="talla" 
                                                           value="<?php echo htmlspecialchars($talla); ?>" 
                                                           id="talla_<?php echo $producto['id']; ?>_<?php echo htmlspecialchars($talla); ?>"
                                                           required>
                                                    <label for="talla_<?php echo $producto['id']; ?>_<?php echo htmlspecialchars($talla); ?>"
                                                           class="tarjeta-opcionTalla">
                                                        <?php echo htmlspecialchars($talla); ?>
                                                    </label>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- Selección de cantidad -->
                                <div class="tarjeta-opciones">
                                    <p>Cantidad:</p>
                                    <div class="tarjeta-contenedorCantidad">
                                        <button type="button" class="cantidad-btn" onclick="cambiarCantidad(this, -1)">-</button>
                                        <input type="number" name="cantidad" value="1" min="1" class="cantidad-input" readonly>
                                        <button type="button" class="cantidad-btn" onclick="cambiarCantidad(this, 1)">+</button>
                                    </div>
                                </div>

                                <p class="tarjeta-precio">$<?php echo number_format($producto['precio'], 0, ',', '.'); ?></p>

                                <button type="submit" class="tarjeta-boton">
                                    Agregar al Pedido
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No hay productos que coincidan con tu búsqueda.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Panel del pedido -->
    <div class="catalogo-pedido">
        <h3>Tu Pedido</h3>
        <?php if (!empty($_SESSION['pedido'])): ?>
            <div class="pedido-items">
                <?php 
                $total = 0;
                foreach ($_SESSION['pedido'] as $item): 
                    $subtotal = $item['precio'] * $item['cantidad'];
                    $total += $subtotal;
                ?>
                    <div class="pedido-item">
                        <img src="<?php echo htmlspecialchars($item['imagen']); ?>" alt="<?php echo htmlspecialchars($item['nombre']); ?>" class="pedido-imagen">
                        <div class="pedido-info">
                            <h4><?php echo htmlspecialchars($item['nombre']); ?></h4>
                            <p>Color: <?php echo htmlspecialchars($item['color']); ?></p>
                            <p>Talla: <?php echo htmlspecialchars($item['talla']); ?></p>
                            <p>Cantidad: <?php echo $item['cantidad']; ?></p>
                            <p class="pedido-precio">$<?php echo number_format($subtotal, 0, ',', '.'); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
                
                <div class="pedido-total">
                    <h4>Total: $<?php echo number_format($total, 0, ',', '.'); ?></h4>
                </div>
                
                <form method="POST" action="" style="margin-top: 1rem;">
                    <input type="hidden" name="action" value="vaciar">
                    <button type="submit" class="vaciar-pedido-btn">Vaciar Pedido</button>
                </form>
            </div>
        <?php else: ?>
            <p>Tu pedido está vacío</p>
        <?php endif; ?>
    </div>
</div>

<?php
// Función para obtener el código de color
function getColorCode($colorName) {
    $colorMap = [
        'Negro' => '#000000',
        'Blanco' => '#FFFFFF',
        'Azul' => '#0000FF',
        'Azul marino' => '#000080',
        'Gris' => '#808080',
        'Rojo' => '#FF0000',
        'Verde' => '#008000',
        'Rosado' => '#FFC0CB',
        'Rosa' => '#FFC0CB',
        'Lila' => '#C8A2C8',
        'Morado' => '#800080',
        'Amarillo' => '#FFFF00',
        'Naranja' => '#FFA500',
        'Marrón' => '#A52A2A',
        'Bordó' => '#800020',
        'Celeste' => '#87CEEB'
    ];
    
    return isset($colorMap[$colorName]) ? $colorMap[$colorName] : '#ccc';
}
?>

<script>
function cambiarCantidad(button, cambio) {
    const input = button.parentNode.querySelector('input[name="cantidad"]');
    const nuevaCantidad = Math.max(1, parseInt(input.value) + cambio);
    input.value = nuevaCantidad;
}
</script> 