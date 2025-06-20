import React, { useState } from 'react'; // Importa React y el hook useState para manejar estado
import "../css/contacto.css"

const VistaAContacto = () => {
  // Estado para guardar los datos del formulario: nombre, email y mensaje
  const [formulario, setFormulario] = useState({
    nombre: '',
    email: '',
    mensaje: ''
  });

  // Función para actualizar el estado cuando el usuario escribe en el formulario
  const handleChange = (e) => {
    setFormulario({
      ...formulario,            // mantiene los otros campos
      [e.target.name]: e.target.value  // actualiza el campo que se modificó
    });
  };

  // Función que se ejecuta al enviar el formulario
  const handleSubmit = (e) => {
    e.preventDefault(); // evita que la página se recargue al enviar
    console.log('Formulario enviado:', formulario); // muestra en consola los datos capturados
    // Aquí podrías agregar código para enviar los datos a un servidor o mostrar confirmación
  };

  // JSX que renderiza el componente
  return (
    <div style={{ padding: '20px', maxWidth: '600px', margin: 'auto' }}>
      <h2>Contacto</h2>  {/* Título principal */}

      <h3>Envíanos un mensaje</h3> {/* Subtítulo para el formulario */}
      <form onSubmit={handleSubmit}> {/* Evento onSubmit para manejar el envío */}
        <div style={{ marginBottom: '10px' }}>
          <label>Nombre:</label><br />
          <input 
            type="text"  // campo texto para nombre
            name="nombre" // nombre del campo
            value={formulario.nombre} // valor controlado desde el estado
            onChange={handleChange}   // actualiza estado al cambiar el valor
            required  // campo obligatorio
            style={{ width: '100%', padding: '8px' }} // estilos en línea
          />
        </div>
        <div style={{ marginBottom: '10px' }}>
          <label>Email:</label><br />
          <input 
            type="email" // campo para email
            name="email"
            value={formulario.email}
            onChange={handleChange}
            required
            style={{ width: '100%', padding: '8px' }}
          />
        </div>
        <div style={{ marginBottom: '10px' }}>
          <label>Mensaje:</label><br />
          <textarea 
            name="mensaje" // campo texto área para el mensaje
            value={formulario.mensaje}
            onChange={handleChange}
            required
            style={{ width: '100%', padding: '8px' }}
          ></textarea>
        </div>
        <button type="submit" style={{ padding: '10px 20px' }}>Enviar</button> {/* Botón para enviar */}
      </form>
    </div>
  );
};

export default VistaAContacto; // Exporta el componente para usarlo en otras partes
