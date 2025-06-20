// src/componentes/elementos/Carrito.js
import React, { useState } from 'react';
import './../css/carrito.css'; // Importamos el nuevo CSS

const ElementoCarrito = ({ items, vaciarCarrito }) => {
  const [formData, setFormData] = useState({
    nombre: '',
    telefono: '',
    direccion: '',
    correo: ''
  });

  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setFormData({ ...formData, [name]: value });
  };

  const handleComprar = (e) => {
    e.preventDefault();

    if (!formData.nombre || !formData.telefono || !formData.direccion) {
      alert('Por favor, completa los campos de nombre, teléfono y dirección.');
      return;
    }
    
    if (items.length === 0) {
      alert('Tu carrito está vacío. Añade productos antes de realizar la compra.');
      return;
    }


    let mensaje = `¡Hola! Quisiera hacer un pedido con los siguientes datos:\n\n`;
    mensaje += `*Cliente:* ${formData.nombre}\n`;
    mensaje += `*Teléfono:* ${formData.telefono}\n`;
    mensaje += `*Dirección de Entrega:* ${formData.direccion}\n`;
    if (formData.correo) {
      mensaje += `*Correo:* ${formData.correo}\n`;
    }
    mensaje += `\n*--- Productos ---*\n`;

    let total = 0;
    items.forEach(item => {
      mensaje += `- ${item.nombre} (x${item.cantidad}) - $${(item.precio * item.cantidad).toLocaleString('es-CO')}\n`;
      total += item.precio * item.cantidad;
    });

    mensaje += `\n*Total del Pedido: $${total.toLocaleString('es-CO')}*`;
    
    const numeroAdmin = '573216798086';
    const urlWhatsapp = `https://wa.me/${numeroAdmin}?text=${encodeURIComponent(mensaje)}`;
    
    window.open(urlWhatsapp, '_blank');

    // Opcional: limpiar carrito y formulario después de enviar
    vaciarCarrito();
    setFormData({ nombre: '', telefono: '', direccion: '', correo: '' });
  };


  return (
    <div className="catalogo-carrito">
      <h3>Carrito</h3>
      {items.length === 0 ? (
        <p>El carrito está vacío.</p>
      ) : (
        <ul>
          {items.map((item, index) => (
            <li key={index}>
              {item.nombre} (x{item.cantidad}) - ${ (item.precio * item.cantidad).toLocaleString('es-CO')}
            </li>
          ))}
        </ul>
      )}

      <form onSubmit={handleComprar} className="carrito-form">
        <h4>Completa tus datos para el envío</h4>
        <div className="form-group">
          <label htmlFor="nombre">Nombre Completo*</label>
          <input type="text" id="nombre" name="nombre" value={formData.nombre} onChange={handleInputChange} required />
        </div>
        <div className="form-group">
          <label htmlFor="telefono">Teléfono*</label>
          <input type="tel" id="telefono" name="telefono" value={formData.telefono} onChange={handleInputChange} required />
        </div>
        <div className="form-group">
          <label htmlFor="direccion">Dirección de Envío*</label>
          <input type="text" id="direccion" name="direccion" value={formData.direccion} onChange={handleInputChange} required />
        </div>
        <div className="form-group">
          <label htmlFor="correo">Correo Electrónico (Opcional)</label>
          <input type="email" id="correo" name="correo" value={formData.correo} onChange={handleInputChange} />
        </div>
        <button type="submit" className="btn-whatsapp">
          Realizar Pedido por WhatsApp
        </button>
      </form>
    </div>
  );
};

export default ElementoCarrito;
