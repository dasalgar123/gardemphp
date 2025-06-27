// Funcionalidades adicionales para la aplicación PHP

document.addEventListener('DOMContentLoaded', function() {
    // Inicializar funcionalidades
    inicializarFormularios();
    inicializarMensajes();
    inicializarAnimaciones();
});

// Función para inicializar formularios
function inicializarFormularios() {
    // Validar formularios antes de enviar
    const formularios = document.querySelectorAll('.producto-form');
    formularios.forEach(formulario => {
        formulario.addEventListener('submit', function(e) {
            const color = formulario.querySelector('input[name="color"]:checked');
            const talla = formulario.querySelector('input[name="talla"]:checked');
            const cantidad = formulario.querySelector('input[name="cantidad"]');
            
            if (!color) {
                e.preventDefault();
                mostrarMensaje('Por favor, selecciona un color antes de agregar el producto.', 'error');
                return;
            }
            
            if (!talla) {
                e.preventDefault();
                mostrarMensaje('Por favor, selecciona una talla antes de agregar el producto.', 'error');
                return;
            }
            
            if (cantidad.value < 1) {
                e.preventDefault();
                mostrarMensaje('La cantidad debe ser al menos 1.', 'error');
                return;
            }
        });
    });
}

// Función para mostrar mensajes
function mostrarMensaje(mensaje, tipo = 'exito') {
    // Remover mensajes anteriores
    const mensajesAnteriores = document.querySelectorAll('.mensaje');
    mensajesAnteriores.forEach(msg => msg.remove());

    // Crear nuevo mensaje
    const mensajeElement = document.createElement('div');
    mensajeElement.className = `mensaje ${tipo}`;
    mensajeElement.textContent = mensaje;

    // Insertar al inicio del main
    const main = document.querySelector('main');
    if (main) {
        main.insertBefore(mensajeElement, main.firstChild);
    }

    // Auto-remover después de 5 segundos
    setTimeout(() => {
        if (mensajeElement.parentNode) {
            mensajeElement.remove();
        }
    }, 5000);
}

// Función para inicializar mensajes del servidor
function inicializarMensajes() {
    // Mostrar mensajes de PHP si existen
    const mensajesPHP = document.querySelectorAll('.mensaje-info, .mensaje-error');
    mensajesPHP.forEach(mensaje => {
        setTimeout(() => {
            mensaje.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => mensaje.remove(), 300);
        }, 5000);
    });
}

// Función para inicializar animaciones
function inicializarAnimaciones() {
    // Comentado temporalmente para evitar problemas de visibilidad
    // const tarjetas = document.querySelectorAll('.tarjeta-contenedorPrincipal');
    // const observer = new IntersectionObserver((entries) => {
    //     entries.forEach(entry => {
    //         if (entry.isIntersecting) {
    //             entry.target.style.animation = 'fadeInUp 0.6s ease';
    //             observer.unobserve(entry.target);
    //         }
    //     });
    // }, { threshold: 0.1 });
    
    // tarjetas.forEach(tarjeta => {
    //     observer.observe(tarjeta);
    // });
}

// Función para cambiar cantidad (ya definida en catalogo.php)
function cambiarCantidad(button, cambio) {
    const input = button.parentNode.querySelector('input[name="cantidad"]');
    const nuevaCantidad = Math.max(1, parseInt(input.value) + cambio);
    input.value = nuevaCantidad;
    
    // Actualizar precio si es necesario
    const tarjeta = button.closest('.tarjeta-contenedorPrincipal');
    const precioBase = parseFloat(tarjeta.dataset.precio || 0);
    const precioElement = tarjeta.querySelector('.tarjeta-precio');
    
    if (precioBase > 0 && precioElement) {
        const precioTotal = precioBase * nuevaCantidad;
        precioElement.textContent = `$${precioTotal.toLocaleString('es-CO')}`;
    }
}

// Función para cambiar orden de productos
function cambiarOrden(valor) {
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set('sort', valor);
    window.location.search = urlParams.toString();
}

// Animaciones CSS
const estilos = document.createElement('style');
estilos.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Comentado para evitar problemas de visibilidad */
    /* .tarjeta-contenedorPrincipal {
        opacity: 0;
        transform: translateY(30px);
    } */
`;
document.head.appendChild(estilos);

// Función para confirmar vaciar pedido
function confirmarVaciarPedido() {
    if (confirm('¿Estás seguro de que quieres vaciar el pedido?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.innerHTML = '<input type="hidden" name="action" value="vaciar">';
        document.body.appendChild(form);
        form.submit();
    }
}

// Función para actualizar total del pedido en tiempo real
function actualizarTotalPedido() {
    const items = document.querySelectorAll('.pedido-item');
    let total = 0;
    
    items.forEach(item => {
        const precio = parseFloat(item.dataset.precio || 0);
        const cantidad = parseInt(item.dataset.cantidad || 0);
        total += precio * cantidad;
    });
    
    const totalElement = document.querySelector('.pedido-total h4');
    if (totalElement) {
        totalElement.textContent = `Total: $${total.toLocaleString('es-CO')}`;
    }
}

// Función para hacer scroll suave a las secciones
function scrollSuave(elemento) {
    elemento.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    });
}

// Función para validar formularios en tiempo real
function validarFormularioEnTiempoReal(formulario) {
    const inputs = formulario.querySelectorAll('input[required], select[required]');
    let valido = true;
    
    inputs.forEach(input => {
        if (!input.value.trim()) {
            input.style.borderColor = '#e74c3c';
            valido = false;
        } else {
            input.style.borderColor = '#00ff41';
        }
    });
    
    return valido;
}

// Función para validar formularios
function validarFormulario(formulario) {
    const inputs = formulario.querySelectorAll('input[required], select[required], textarea[required]');
    let valido = true;

    inputs.forEach(input => {
        if (!input.value.trim()) {
            input.style.borderColor = '#4682b4';
            input.style.boxShadow = '0 0 5px rgba(70, 130, 180, 0.3)';
            valido = false;
        } else {
            input.style.borderColor = '';
            input.style.boxShadow = '';
        }
    });

    return valido;
}

// Función para manejar la adición al carrito
function agregarAlCarrito(productoId, cantidad, color, talla) {
    // Validar que se haya seleccionado color y talla
    if (!color || !talla) {
        mostrarMensaje('Por favor selecciona un color y una talla', 'error');
        return false;
    }

    // Validar cantidad
    if (cantidad <= 0) {
        mostrarMensaje('La cantidad debe ser mayor a 0', 'error');
        return false;
    }

    // Crear formulario y enviar
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '';

    const campos = {
        'accion': 'agregar',
        'producto_id': productoId,
        'cantidad': cantidad,
        'color': color,
        'talla': talla
    };

    Object.keys(campos).forEach(key => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = key;
        input.value = campos[key];
        form.appendChild(input);
    });

    document.body.appendChild(form);
    form.submit();
}

// Función para actualizar cantidad en el carrito
function actualizarCantidad(productoId, nuevaCantidad) {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '';

    const campos = {
        'accion': 'actualizar_cantidad',
        'producto_id': productoId,
        'cantidad': nuevaCantidad
    };

    Object.keys(campos).forEach(key => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = key;
        input.value = campos[key];
        form.appendChild(input);
    });

    document.body.appendChild(form);
    form.submit();
}

// Función para eliminar producto del carrito
function eliminarDelCarrito(productoId) {
    if (confirm('¿Estás seguro de que quieres eliminar este producto del carrito?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '';

        const campos = {
            'accion': 'eliminar',
            'producto_id': productoId
        };

        Object.keys(campos).forEach(key => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = key;
            input.value = campos[key];
            form.appendChild(input);
        });

        document.body.appendChild(form);
        form.submit();
    }
}

// Función para vaciar el carrito
function vaciarCarrito() {
    if (confirm('¿Estás seguro de que quieres vaciar el carrito?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '';

        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'accion';
        input.value = 'vaciar';
        form.appendChild(input);

        document.body.appendChild(form);
        form.submit();
    }
}

// Función para procesar el pedido
function procesarPedido() {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '';

    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'accion';
    input.value = 'procesar_pedido';
    form.appendChild(input);

    document.body.appendChild(form);
    form.submit();
}

// Función para manejar cambios en cantidad
function cambiarCantidad(input, cambio) {
    let valor = parseInt(input.value) + cambio;
    if (valor < 1) valor = 1;
    if (valor > 99) valor = 99;
    input.value = valor;
}

// Función para manejar selección de color
function seleccionarColor(radio) {
    // Remover selección anterior en el mismo grupo
    const grupo = radio.name;
    document.querySelectorAll(`input[name="${grupo}"]`).forEach(r => {
        r.checked = false;
    });
    
    // Seleccionar el nuevo color
    radio.checked = true;
}

// Función para manejar selección de talla
function seleccionarTalla(radio) {
    // Remover selección anterior en el mismo grupo
    const grupo = radio.name;
    document.querySelectorAll(`input[name="${grupo}"]`).forEach(r => {
        r.checked = false;
    });
    
    // Seleccionar la nueva talla
    radio.checked = true;
}

// Función para manejar filtros
function aplicarFiltro(categoria) {
    const form = document.createElement('form');
    form.method = 'GET';
    form.action = '';

    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'categoria';
    input.value = categoria;
    form.appendChild(input);

    document.body.appendChild(form);
    form.submit();
}

// Función para manejar ordenamiento
function ordenarProductos(orden) {
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set('ordenar', orden);
    window.location.search = urlParams.toString();
}

// Función para mostrar/ocultar el panel del pedido
function togglePedido() {
    const panel = document.querySelector('.pedido-panel');
    if (panel) {
        panel.classList.toggle('oculto');
    }
}

// Función para cerrar el panel del pedido
function cerrarPedido() {
    const panel = document.querySelector('.pedido-panel');
    if (panel) {
        panel.classList.add('oculto');
    }
}

// Event listeners cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    // Manejar botones de cantidad
    document.querySelectorAll('.cantidad-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.parentNode.querySelector('.cantidad-input');
            const cambio = this.textContent === '+' ? 1 : -1;
            cambiarCantidad(input, cambio);
        });
    });

    // Manejar inputs de cantidad
    document.querySelectorAll('.cantidad-input').forEach(input => {
        input.addEventListener('change', function() {
            let valor = parseInt(this.value);
            if (isNaN(valor) || valor < 1) valor = 1;
            if (valor > 99) valor = 99;
            this.value = valor;
        });
    });

    // Manejar botones de agregar al carrito
    document.querySelectorAll('.tarjeta-boton').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            
            const tarjeta = this.closest('.tarjeta-contenedorPrincipal');
            const productoId = tarjeta.dataset.productoId;
            const cantidadInput = tarjeta.querySelector('.cantidad-input');
            const colorSeleccionado = tarjeta.querySelector('input[name^="color"]:checked');
            const tallaSeleccionada = tarjeta.querySelector('input[name^="talla"]:checked');
            
            const cantidad = parseInt(cantidadInput.value);
            const color = colorSeleccionado ? colorSeleccionado.value : '';
            const talla = tallaSeleccionada ? tallaSeleccionada.value : '';
            
            agregarAlCarrito(productoId, cantidad, color, talla);
        });
    });

    // Manejar botones del carrito
    document.querySelectorAll('.pedido-cantidad-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const productoId = this.dataset.productoId;
            const input = this.parentNode.querySelector('.pedido-cantidad-input');
            const cambio = this.textContent === '+' ? 1 : -1;
            const nuevaCantidad = parseInt(input.value) + cambio;
            
            if (nuevaCantidad >= 1) {
                actualizarCantidad(productoId, nuevaCantidad);
            }
        });
    });

    document.querySelectorAll('.pedido-eliminar').forEach(btn => {
        btn.addEventListener('click', function() {
            const productoId = this.dataset.productoId;
            eliminarDelCarrito(productoId);
        });
    });

    // Manejar botones de acción del carrito
    const btnVaciar = document.querySelector('.pedido-btn[data-accion="vaciar"]');
    if (btnVaciar) {
        btnVaciar.addEventListener('click', function(e) {
            e.preventDefault();
            vaciarCarrito();
        });
    }

    const btnProcesar = document.querySelector('.pedido-btn[data-accion="procesar"]');
    if (btnProcesar) {
        btnProcesar.addEventListener('click', function(e) {
            e.preventDefault();
            procesarPedido();
        });
    }

    // Manejar botón de cerrar pedido
    const btnCerrar = document.querySelector('.pedido-cerrar');
    if (btnCerrar) {
        btnCerrar.addEventListener('click', function(e) {
            e.preventDefault();
            cerrarPedido();
        });
    }

    // Manejar filtros
    document.querySelectorAll('.filtro-boton').forEach(btn => {
        btn.addEventListener('click', function() {
            const categoria = this.dataset.categoria;
            aplicarFiltro(categoria);
        });
    });

    // Auto-ocultar mensajes después de 5 segundos
    setTimeout(() => {
        document.querySelectorAll('.mensaje').forEach(mensaje => {
            mensaje.style.opacity = '0';
            setTimeout(() => mensaje.remove(), 300);
        });
    }, 5000);
}); 