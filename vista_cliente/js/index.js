// Función para cambiar cantidad en el formulario de producto
function cambiarCantidad(button, cambio) {
    const input = button.parentNode.querySelector('.cantidad-input');
    const nuevaCantidad = Math.max(1, parseInt(input.value) + cambio);
    input.value = nuevaCantidad;
}

// Función para cambiar cantidad en la cesta de pedido
function cambiarCantidadCesta(index, cambio) {
    fetch('logica/accionesCesta.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=cambiarCantidad&index=${index}&cambio=${cambio}`
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error en la respuesta del servidor');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            if (data.eliminado) {
                // Recargar la página si se eliminó el producto
                location.reload();
            } else {
                // Actualizar la cantidad en la interfaz
                const cantidadElement = document.getElementById(`cantidad_${index}`);
                if (cantidadElement) {
                    cantidadElement.textContent = data.cantidad;
                }
                // Actualizar la página para mostrar el nuevo total
                location.reload();
            }
        } else {
            alert('Error: ' + (data.error || 'Error desconocido'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al cambiar la cantidad. Por favor, inténtelo de nuevo.');
    });
}

function eliminarProducto(index) {
    if (confirm('¿Estás seguro de que quieres eliminar este producto?')) {
        fetch('logica/accionesCesta.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `action=eliminarProducto&index=${index}`
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Recargar la página para actualizar la cesta
                location.reload();
            } else {
                alert('Error: ' + (data.error || 'Error desconocido'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al eliminar el producto. Por favor, inténtelo de nuevo.');
        });
    }
}

function vaciarPedido() {
    if (confirm('¿Estás seguro de que quieres vaciar todo el pedido?')) {
        fetch('logica/accionesCesta.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'action=vaciarPedido'
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Recargar la página para actualizar la cesta
                location.reload();
            } else {
                alert('Error: ' + (data.error || 'Error desconocido'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al vaciar el pedido. Por favor, inténtelo de nuevo.');
        });
    }
}

function enviarPedidoA(numero) {
    const nombre = document.getElementById('nombre').value.trim();
    const telefono = document.getElementById('telefono').value.trim();
    const correo = document.getElementById('correo').value.trim();
    const lugar = document.getElementById('lugar').value.trim();
    const fecha_entrega = document.getElementById('fecha_entrega').value;
    
    if (!nombre || !telefono || !correo || !lugar || !fecha_entrega) {
        alert('Por favor completa todos los datos del cliente');
        return;
    }
    
    // Validar formato de teléfono
    if (!/^\d{10}$/.test(telefono.replace(/\D/g, ''))) {
        alert('Por favor ingresa un número de teléfono válido (10 dígitos)');
        return;
    }
    
    // Validar formato de correo
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(correo)) {
        alert('Por favor ingresa un correo electrónico válido');
        return;
    }
    
    const ahora = new Date();
    const hora = ahora.toLocaleTimeString('es-CO');
    const fecha = ahora.toLocaleDateString('es-CO');
    
    let mensaje = `🛍️ *NUEVO PEDIDO - GARDEM* 🛍️\n`;
    mensaje += `📅 Fecha: ${fecha}\n`;
    mensaje += `⏰ Hora: ${hora}\n\n`;
    mensaje += `📋 *PRODUCTOS:*\n`;
    
    let total = 0;
    const filas = document.querySelectorAll('.pedido-resumen tbody tr');
    filas.forEach(fila => {
        const producto = fila.querySelector('strong').innerText;
        const detalles = fila.querySelector('small').innerText;
        const cantidad = fila.querySelector('span[id^="cantidad_"]').innerText;
        const precioUnit = fila.querySelector('td:nth-child(2)').innerText;
        const subtotal = fila.querySelector('td:nth-child(4)').innerText;
        
        mensaje += `• ${producto}\n`;
        mensaje += `  ${detalles}\n`;
        mensaje += `  Cantidad: ${cantidad} | ${precioUnit} | ${subtotal}\n\n`;
        
        // Extraer el valor numérico del subtotal
        const subtotalNum = parseInt(subtotal.replace(/[^\d]/g, ''));
        total += subtotalNum;
    });
    
    mensaje += `💰 *TOTAL: $${total.toLocaleString('es-CO')}*\n\n`;
    mensaje += `👤 *DATOS DEL CLIENTE:*\n`;
    mensaje += `• Nombre: ${nombre}\n`;
    mensaje += `• Teléfono: ${telefono}\n`;
    mensaje += `• Correo: ${correo}\n`;
    mensaje += `• Dirección: ${lugar}\n`;
    mensaje += `• Fecha de entrega: ${fecha_entrega}\n\n`;
    mensaje += `📞 *CONTACTAR AL CLIENTE:* ${telefono}`;
    
    const url = `https://wa.me/${numero}?text=${encodeURIComponent(mensaje)}`;
    window.open(url, '_blank');
    
    // Mostrar mensaje de confirmación
    alert('Pedido enviado exitosamente a WhatsApp. La cesta se vaciará automáticamente.');
    
    // Vaciar la cesta después de enviar
    setTimeout(() => {
        vaciarPedido();
    }, 1000);
}

// Función para validar formularios
function validarFormulario(form) {
    const inputs = form.querySelectorAll('input[required]');
    let valido = true;
    
    inputs.forEach(input => {
        if (!input.value.trim()) {
            input.style.borderColor = '#ff4444';
            valido = false;
        } else {
            input.style.borderColor = '';
        }
    });
    
    return valido;
}

// Agregar validación en tiempo real
document.addEventListener('DOMContentLoaded', function() {
    const formCliente = document.getElementById('formCliente');
    if (formCliente) {
        const inputs = formCliente.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (this.hasAttribute('required') && !this.value.trim()) {
                    this.style.borderColor = '#ff4444';
                } else {
                    this.style.borderColor = '';
                }
            });
        });
        
        // Validación específica para el teléfono
        const telefonoInput = document.getElementById('telefono');
        if (telefonoInput) {
            telefonoInput.addEventListener('input', function() {
                // Remover cualquier carácter que no sea número
                this.value = this.value.replace(/[^0-9]/g, '');
                
                // Limitar a 10 dígitos
                if (this.value.length > 10) {
                    this.value = this.value.slice(0, 10);
                }
                
                // Cambiar color del borde según la validación
                if (this.value.length === 10) {
                    this.style.borderColor = '#28a745'; // Verde si es válido
                } else if (this.value.length > 0) {
                    this.style.borderColor = '#ffc107'; // Amarillo si está incompleto
                } else {
                    this.style.borderColor = ''; // Normal si está vacío
                }
            });
            
            telefonoInput.addEventListener('blur', function() {
                if (this.value.length > 0 && this.value.length !== 10) {
                    this.style.borderColor = '#dc3545'; // Rojo si está incompleto al perder el foco
                    alert('El teléfono debe tener exactamente 10 dígitos');
                }
            });
        }
        
        // Validación específica para el correo electrónico
        const correoInput = document.getElementById('correo');
        if (correoInput) {
            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            
            correoInput.addEventListener('input', function() {
                const email = this.value.trim();
                
                if (email === '') {
                    this.style.borderColor = ''; // Normal si está vacío
                } else if (emailRegex.test(email)) {
                    this.style.borderColor = '#28a745'; // Verde si es válido
                } else {
                    this.style.borderColor = '#ffc107'; // Amarillo si está incompleto o inválido
                }
            });
            
            correoInput.addEventListener('blur', function() {
                const email = this.value.trim();
                
                if (email !== '' && !emailRegex.test(email)) {
                    this.style.borderColor = '#dc3545'; // Rojo si es inválido al perder el foco
                    alert('Por favor ingrese un correo electrónico válido (ejemplo: usuario@dominio.com)');
                }
            });
        }
    }
}); 