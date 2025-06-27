<div class="tarjeta-contenedorPrincipal" data-producto-id="<?php echo $producto['id']; ?>">
    <!-- Imagen del producto -->
    <div class="producto-imagen-container">
        <img src="<?php echo htmlspecialchars(logica_obtenerUrlImagen($producto)); ?>" 
             alt="<?php echo htmlspecialchars($producto['nombre']); ?>" 
             class="producto-imagen" />
        <!-- Overlay de marca de agua -->
        <div class="tarjeta-overlay"></div>
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
            
            <!-- Selección de color como select -->
            <div class="tarjeta-opciones" data-label="Colores">
                <?php if (!empty($producto['colores'])): ?>
                    <select name="color" required>
                        <option value="" disabled selected>Seleccione color</option>
                        <?php foreach ($producto['colores'] as $color): ?>
                            <option value="<?php echo htmlspecialchars($color); ?>">
                                <?php echo htmlspecialchars(ucfirst($color)); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                <?php else: ?>
                    <span class="no-disponible">🎨 No hay colores disponibles</span>
                <?php endif; ?>
            </div>

            <!-- Selección de talla como select -->
            <?php if (!empty($producto['tallas'])): ?>
                <div class="tarjeta-opciones" data-label="Tallas">
                    <select name="talla" required>
                        <option value="" disabled selected>Seleccione talla</option>
                        <?php foreach ($producto['tallas'] as $talla): ?>
                            <option value="<?php echo htmlspecialchars($talla); ?>">
                                <?php echo htmlspecialchars($talla); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endif; ?>

            <!-- Selección de cantidad -->
            <div class="tarjeta-contenedorCantidad">
                <button type="button" class="cantidad-btn" onclick="cambiarCantidad(this, -1)">-</button>
                <input type="number" name="cantidad" value="1" min="1" class="cantidad-input" readonly>
                <button type="button" class="cantidad-btn" onclick="cambiarCantidad(this, 1)">+</button>
            </div>

            <p class="tarjeta-precio">$<?php echo number_format($producto['precio'], 0, ',', '.'); ?></p>

            <button type="submit" class="tarjeta-boton">
                Agregar al Pedido
            </button>
        </form>
    </div>
</div> 