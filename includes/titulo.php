<?php
/**
 * ARCHIVO: Título principal del sitio
 * DESCRIPCIÓN: Contiene el título y navegación principal
 */
?>

<!-- Título Principal -->
<div class="titulo-container">
    <h1 class="titulo-principal">Gardem</h1>
</div>

<!-- Navegación -->
<nav class="nav-productos">
    <div class="nav-container">
        <ul class="nav-list">
            <li class="nav-item">
                <a href="?categoria=Todos" class="nav-link <?php echo $categoriaSeleccionada === 'Todos' ? 'active' : ''; ?>">
                    Todos
                </a>
            </li>
            <li class="nav-item">
                <a href="?categoria=Caballeros" class="nav-link <?php echo $categoriaSeleccionada === 'Caballeros' ? 'active' : ''; ?>">
                    Caballeros
                </a>
            </li>
            <li class="nav-item">
                <a href="?categoria=Damas" class="nav-link <?php echo $categoriaSeleccionada === 'Damas' ? 'active' : ''; ?>">
                    Damas
                </a>
            </li>
            <li class="nav-item">
                <a href="?categoria=Niños" class="nav-link <?php echo $categoriaSeleccionada === 'Niños' ? 'active' : ''; ?>">
                    Niños
                </a>
            </li>
            <li class="nav-item">
                <a href="?categoria=Niñas" class="nav-link <?php echo $categoriaSeleccionada === 'Niñas' ? 'active' : ''; ?>">
                    Niñas
                </a>
            </li>
        </ul>
    </div>
</nav>

<!-- Filtro de precio -->
<div class="filtro-precio">
    <label for="sort">Ordenar por:</label>
    <select id="sort" onchange="cambiarOrden(this.value)">
        <option value="default" <?php echo $ordenarPor === 'default' ? 'selected' : ''; ?>>Por defecto</option>
        <option value="price-asc" <?php echo $ordenarPor === 'price-asc' ? 'selected' : ''; ?>>Precio: Menor a Mayor</option>
        <option value="price-desc" <?php echo $ordenarPor === 'price-desc' ? 'selected' : ''; ?>>Precio: Mayor a Menor</option>
    </select>
</div> 