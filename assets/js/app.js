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
function mostrarMensaje(texto, tipo = 'info') {
    // Remover mensajes existentes
    const mensajesExistentes = document.querySelectorAll('.mensaje-flotante');
    mensajesExistentes.forEach(msg => msg.remove());
    
    // Crear nuevo mensaje
    const mensaje = document.createElement('div');
    mensaje.className = `mensaje-flotante mensaje-${tipo}`;
    mensaje.textContent = texto;
    
    // Estilos del mensaje
    mensaje.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        color: white;
        font-weight: 600;
        z-index: 10000;
        animation: slideIn 0.3s ease;
        max-width: 300px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    `;
    
    if (tipo === 'error') {
        mensaje.style.backgroundColor = '#e74c3c';
    } else {
        mensaje.style.backgroundColor = '#00ff41';
        mensaje.style.color = '#000';
    }
    
    document.body.appendChild(mensaje);
    
    // Remover mensaje después de 3 segundos
    setTimeout(() => {
        mensaje.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => mensaje.remove(), 300);
    }, 3000);
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
    // Animación de entrada para las tarjetas de productos
    const tarjetas = document.querySelectorAll('.tarjeta-contenedorPrincipal');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animation = 'fadeInUp 0.6s ease';
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    
    tarjetas.forEach(tarjeta => {
        observer.observe(tarjeta);
    });
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
    
    .tarjeta-contenedorPrincipal {
        opacity: 0;
        transform: translateY(30px);
    }
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