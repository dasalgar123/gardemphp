<?php
// Incluir configuración
require_once __DIR__ . '/../config/database.php';

// Mostrar la cesta de pedido (pedido-resumen)
?>
<div class="pedido">
    <?php if (!empty($_SESSION['pedido'])): ?>
        <div class="pedido-resumen">
            <h2>🛒 Cesta de Pedido</h2>
            
            <!-- Botón para vaciar pedido -->
            <div class="contenedor-btn-vaciar">
                <button onclick="vaciarPedido()" class="btn-vaciar-pedido">
                    🗑️ Vaciar Pedido
                </button>
            </div>
            
            <table class="tabla-pedido">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio Unit.</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $total = 0;
                    foreach ($_SESSION['pedido'] as $index => $item): 
                        $subtotal = $item['precio'] * $item['cantidad'];
                        $total += $subtotal;
                    ?>
                        <tr>
                            <td>
                                <strong><?php echo htmlspecialchars($item['nombre']); ?></strong><br>
                                <small>Color: <?php echo htmlspecialchars($item['color']); ?> | Talla: <?php echo htmlspecialchars($item['talla']); ?></small>
                            </td>
                            <td>$<?php echo number_format($item['precio'], 0, ',', '.'); ?></td>
                            <td>
                                <button onclick="cambiarCantidadCesta(<?php echo $index; ?>, -1)" class="btn-cantidad">-</button>
                                <span id="cantidad_<?php echo $index; ?>"><?php echo intval($item['cantidad']); ?></span>
                                <button onclick="cambiarCantidadCesta(<?php echo $index; ?>, 1)" class="btn-cantidad">+</button>
                            </td>
                            <td>$<?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                            <td>
                                <button onclick="eliminarProducto(<?php echo $index; ?>)" class="btn-eliminar-producto">❌ Eliminar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" style="text-align: right;"><strong>Total:</strong></td>
                        <td><strong>$<?php echo number_format($total, 0, ',', '.'); ?></strong></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            
            <!-- Formulario de datos del cliente -->
            <div class="form-cliente-container">
                <h3>👤 Datos del Cliente</h3>
                <form id="formCliente" class="form-cliente">
                    <div class="form-grupo-cliente">
                        <label for="nombre">Nombre completo:</label><br>
                        <input type="text" id="nombre" name="nombre" required placeholder="Ingrese su nombre completo">
                    </div>
                    <div class="form-grupo-cliente">
                        <label for="telefono">Teléfono:</label><br>
                        <input type="tel" id="telefono" name="telefono" required 
                               placeholder="Ej: 3001234567" 
                               pattern="[0-9]{10}" 
                               maxlength="10" 
                               oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10)"
                               title="Ingrese exactamente 10 dígitos numéricos">
                    </div>
                    <div class="form-grupo-cliente">
                        <label for="correo">Correo electrónico:</label><br>
                        <input type="email" id="correo" name="correo" required 
                               placeholder="ejemplo@correo.com" 
                               pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}"
                               title="Ingrese un correo electrónico válido (ejemplo: usuario@dominio.com)">
                    </div>
                    <div class="form-grupo-cliente">
                        <label for="lugar">Dirección de envío:</label><br>
                        <input type="text" id="lugar" name="lugar" required placeholder="Dirección completa">
                    </div>
                    <div class="form-grupo-cliente">
                        <label for="fecha_entrega">Fecha de entrega deseada:</label><br>
                        <input type="date" id="fecha_entrega" name="fecha_entrega" required>
                    </div>
                </form>
            </div>
            
            <!-- Botones de WhatsApp -->
            <div class="contenedor-botones-pedido">
                <?php 
                foreach (WHATSAPP_NUMBERS as $numero) {
                    echo '<button onclick="enviarPedidoA(\'' . $numero . '\')" class="btn-whatsapp">📱 Enviar pedido a WhatsApp</button>';
                }
                ?>
            </div>
        </div>
    <?php else: ?>
        <div class="pedido-resumen">
            <h2>🛒 Cesta vacía</h2>
            <p>No hay productos en tu cesta de pedido. ¡Agrega algunos productos para comenzar!</p>
        </div>
    <?php endif; ?>
</div>