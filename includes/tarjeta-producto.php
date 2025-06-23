<div class="tarjeta-contenedorPrincipal" data-producto-id="<?php echo $producto['id']; ?>">
    <!-- Imagen del producto -->
    <div class="tarjeta-contenedorVisual">
        <img src="<?php echo htmlspecialchars(logica_obtenerUrlImagen($producto)); ?>" 
             alt="<?php echo htmlspecialchars($producto['nombre']); ?>" 
             class="tarjeta-imagen" />
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
            
            <!-- Selección de color -->
            <div class="tarjeta-opciones">
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
                                       style="background-color: <?php echo logica_obtenerCodigoColor($color); ?>;"
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