<div class="filtro-precio">
    <label for="sort-select">Ordenar por:</label>
    <select id="sort-select" onchange="cambiarOrden(this.value)">
        <option value="default" <?php echo $sortBy === 'default' ? 'selected' : ''; ?>>Orden por defecto</option>
        <option value="price-asc" <?php echo $sortBy === 'price-asc' ? 'selected' : ''; ?>>Precio: Menor a Mayor</option>
        <option value="price-desc" <?php echo $sortBy === 'price-desc' ? 'selected' : ''; ?>>Precio: Mayor a Menor</option>
    </select>
</div>

<script>
function cambiarOrden(valor) {
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set('sort', valor);
    window.location.search = urlParams.toString();
}
</script> 