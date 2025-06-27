// Función para cargar categorías dinámicamente
function cargarCategoria(categoria) {
    // Mostrar indicador de carga
    const catalogoGrid = document.getElementById('catalogo-grid');
    const catalogoContainer = document.getElementById('catalogo-container');
    
    catalogoGrid.innerHTML = '<div class="loading">Cargando productos...</div>';
    
    // Realizar petición AJAX
    fetch(`../logica/cargarCategoria.php?categoria=${categoria}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                catalogoGrid.innerHTML = `<p class="error">Error: ${data.error}</p>`;
                return;
            }
            
            // Actualizar el título de la categoría
            const titulo = document.querySelector('.catalogo-productos h2');
            const nombresCategoria = {
                'todos': 'Catálogo Completo',
                'caballero': 'Productos para Caballeros',
                'productosdamas': 'Productos para Damas',
                'niños': 'Productos para Niños',
                'niñas': 'Productos para Niñas'
            };
            titulo.textContent = nombresCategoria[categoria] || 'Productos';
            
            // Generar HTML de productos
            if (data.productos.length === 0) {
                catalogoGrid.innerHTML = '<p>No hay productos en esta categoría.</p>';
                return;
            }
            
            let productosHTML = '';
            data.productos.forEach(producto => {
                productosHTML += `
                    <div class="producto">
                        <img src="${producto.imagen}" alt="${producto.nombre}" onerror="this.src='../img/placeholder.jpg'">
                        <div class="nombre">${producto.nombre}</div>
                        <div class="descripcion">${producto.descripcion}</div>
                        <div class="precio">$${producto.precio}</div>
                    </div>
                `;
            });
            
            catalogoGrid.innerHTML = productosHTML;
            
            // Agregar efecto de aparición
            const productos = catalogoGrid.querySelectorAll('.producto');
            productos.forEach((producto, index) => {
                producto.style.opacity = '0';
                producto.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    producto.style.transition = 'all 0.5s ease';
                    producto.style.opacity = '1';
                    producto.style.transform = 'translateY(0)';
                }, index * 100);
            });
        })
        .catch(error => {
            console.error('Error:', error);
            catalogoGrid.innerHTML = '<p class="error">Error al cargar los productos. Inténtalo de nuevo.</p>';
        });
}

// Función para resaltar la categoría activa
function resaltarCategoriaActiva(categoria) {
    // Remover clase activa de todos los enlaces
    document.querySelectorAll('.nav-link').forEach(link => {
        link.classList.remove('categoria-activa');
    });
    
    // Agregar clase activa al enlace seleccionado
    const enlaceActivo = document.querySelector(`[onclick="cargarCategoria('${categoria}')"]`);
    if (enlaceActivo) {
        enlaceActivo.classList.add('categoria-activa');
    }
}

// Modificar la función cargarCategoria para incluir el resaltado
function cargarCategoriaConResaltado(categoria) {
    cargarCategoria(categoria);
    resaltarCategoriaActiva(categoria);
}

// Cargar todos los productos por defecto al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    // Cargar categoría "todos" por defecto
    cargarCategoriaConResaltado('todos');
}); 