<!-- Botón flotante del carrito -->
<!-- COMENTADO PARA PRUEBA
<button class="carrito-flotante" onclick="togglePedido()">
    <span class="carrito-icono">🛒</span>
    <?php if (!empty($_SESSION['pedido'])): ?>
        <span class="carrito-contador"><?php echo count($_SESSION['pedido']); ?></span>
    <?php endif; ?>
</button>

<!-- Panel del pedido -->
<div class="pedido-panel <?php echo !empty($_SESSION['pedido']) ? 'visible' : ''; ?>">
    <div class="pedido-header">
        <h2 class="pedido-titulo">Tu Pedido</h2>
        <button class="pedido-cerrar" onclick="cerrarPedido()">×</button>
    </div>
    
    <?php if (!empty($_SESSION['pedido'])): ?>
        <div class="pedido-lista">
            <?php 
            $total = logica_calcularTotalPedido();
            foreach ($_SESSION['pedido'] as $index => $item): 
                $subtotal = $item['precio'] * $item['cantidad'];
            ?>
                <div class="pedido-item">
                    <div class="pedido-item-header">
                        <span class="pedido-item-nombre"><?php echo htmlspecialchars($item['nombre']); ?></span>
                        <span class="pedido-item-precio">$<?php echo number_format($subtotal, 0, ',', '.'); ?></span>
                    </div>
                    <div class="pedido-item-detalles">
                        Color: <?php echo htmlspecialchars($item['color']); ?> | 
                        Talla: <?php echo htmlspecialchars($item['talla']); ?>
                    </div>
                    <div class="pedido-item-cantidad">
                        <button class="pedido-cantidad-btn" data-producto-id="<?php echo $index; ?>" onclick="actualizarCantidadCarrito(<?php echo $index; ?>, -1)">-</button>
                        <input type="number" class="pedido-cantidad-input" value="<?php echo $item['cantidad']; ?>" min="1" max="99" onchange="actualizarCantidadCarrito(<?php echo $index; ?>, this.value - <?php echo $item['cantidad']; ?>)">
                        <button class="pedido-cantidad-btn" data-producto-id="<?php echo $index; ?>" onclick="actualizarCantidadCarrito(<?php echo $index; ?>, 1)">+</button>
                        <button class="pedido-eliminar" onclick="eliminarDelCarrito(<?php echo $index; ?>)">Eliminar</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="pedido-total">
            <div class="pedido-total-texto">Total del Pedido</div>
            <div class="pedido-total-precio">$<?php echo number_format($total, 0, ',', '.'); ?></div>
        </div>
        
        <div class="pedido-acciones">
            <button class="pedido-btn principal" onclick="procesarPedido()">
                Procesar Pedido
            </button>
            <button class="pedido-btn secundario" onclick="vaciarCarrito()">
                Vaciar Carrito
            </button>
        </div>
    <?php else: ?>
        <div class="pedido-vacio">
            <p>Tu carrito está vacío</p>
            <p>¡Agrega algunos productos para comenzar!</p>
        </div>
    <?php endif; ?>
</div>
