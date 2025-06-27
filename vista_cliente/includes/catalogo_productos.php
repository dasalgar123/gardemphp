<div class="catalogo-container" id="catalogo-container">
    <div class="catalogo-productos">
        <h2 class="<?php echo logica_obtenerClaseCategoria($categoriaSeleccionada); ?>"><?php echo htmlspecialchars($categoriaSeleccionada); ?></h2>
        <div class="catalogo-grid" id="catalogo-grid">
            <?php if (!empty($productosMostrados)): ?>
                <?php foreach ($productosMostrados as $producto): ?>
                    <?php include '../includes/tarjeta-producto.php'; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No hay productos que coincidan con tu búsqueda.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="filtro">
    <form method="GET" action="">
        <label>Filtrar por: </label>
        <select name="orden" onchange="this.form.submit()">
            <option value="">Seleccionar</option>
            <option value="precio_desc">Precio: Mayor a Menor</option>
            <option value="precio_asc">Precio: Menor a Mayor</option>
            <option value="mas_reciente">Más Reciente</option>
            <option value="mas_vendidos">Más Vendidos</option>
        </select>
    </form>
</div>

<div class="productos">
    <?php
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Mapear tipo_producto a la categoría de tallas
            $mapa_categoria_tallas = [
                'caballero' => 'hombres',
                'dama' => 'mujeres',
                'niño' => 'niños',
                'niña' => 'niñas',
            ];
            $tipo = strtolower($row['tipo_producto'] ?? '');
            $cat = isset($mapa_categoria_tallas[$tipo]) ? $mapa_categoria_tallas[$tipo] : $tipo;
            $img_path = 'img/' . (empty($row['imagen']) ? 'logo/logo.jpg' : htmlspecialchars($row['imagen']));
            echo '<div class="producto">';
            echo '<img src="' . $img_path . '" alt="' . htmlspecialchars($row['nombre']) . '">';
            echo '<h3>' . htmlspecialchars($row['nombre']) . '</h3>';
            echo '<p>' . htmlspecialchars($row['descripcion']) . '</p>';
            echo '<p><strong>$' . number_format($row['precio'], 2) . '</strong></p>';
            if (!empty($row['color'])) {
                echo '<p>Color: ' . htmlspecialchars($row['color']) . '</p>';
            }
            if (!empty($row['talla'])) {
                echo '<p>Talla: ' . htmlspecialchars($row['talla']) . '</p>';
            }
            // Formulario para agregar al pedido
            echo '<form method="POST" action="">';
            echo '<input type="hidden" name="producto_id" value="' . $row['id'] . '">';
            echo '<input type="hidden" name="nombre" value="' . htmlspecialchars($row['nombre']) . '">';
            // Select de color
            if (!empty($colores)) {
                echo '<label for="color_' . $row['id'] . '">Color:</label>';
                echo '<select name="color" id="color_' . $row['id'] . '">';
                foreach ($colores as $color) {
                    echo '<option value="' . htmlspecialchars($color) . '">' . htmlspecialchars($color) . '</option>';
                }
                echo '</select>';
            }
            // Select de talla según categoría
            if (!empty($cat) && !empty($tallas_por_categoria[$cat])) {
                echo '<label for="talla_' . $row['id'] . '">Talla:</label>';
                echo '<select name="talla" id="talla_' . $row['id'] . '">';
                foreach ($tallas_por_categoria[$cat] as $talla) {
                    echo '<option value="' . htmlspecialchars($talla) . '">' . htmlspecialchars($talla) . '</option>';
                }
                echo '</select>';
            }
            echo '<input type="number" name="cantidad" value="1" min="1" class="input-cantidad-catalogo">';
            echo '<button type="submit">Agregar al pedido</button>';
            echo '</form>';
            echo '</div>';
        }
    } else {echo "<p>No hay productos para mostrar.</p>";}
    ?>
</div> 