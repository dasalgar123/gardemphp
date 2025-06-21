<?php
// Obtener categorías únicas y agregar "Todos"
$categoriasUnicas = ['Todos'];
foreach ($categorias as $categoria) {
    $categoriasUnicas[] = $categoria['nombre'];
}
?>

<nav class="nav-productos">
    <div class="nav-container">
        <ul class="nav-list">
            <?php foreach ($categoriasUnicas as $categoria): ?>
                <li class="nav-item">
                    <a href="?categoria=<?php echo urlencode($categoria); ?>" 
                       class="nav-link <?php echo $categoriaSeleccionada === $categoria ? 'active' : ''; ?>">
                        <?php echo htmlspecialchars($categoria); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</nav> 