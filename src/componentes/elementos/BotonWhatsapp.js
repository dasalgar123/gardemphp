import React from 'react';
import './../css/BotonWhatsapp.css'; // Crearemos este archivo para los estilos

const BotonWhatsapp = () => {
  const numeroTelefono = '573216798086'; // Tu número de WhatsApp con el código de país
  const mensajePredeterminado = encodeURIComponent(
    '¡Hola! Soy Daniel, tu asesor de estilo. Estoy listo para ayudarte a encontrar lo que buscas. ¿En qué puedo asesorarte?'
  );

  const urlWhatsapp = `https://wa.me/${numeroTelefono}?text=${mensajePredeterminado}`;

  return (
    <a
      href={urlWhatsapp}
      className="whatsapp-fab"
      target="_blank"
      rel="noopener noreferrer"
      title="Chatea con Daniel en WhatsApp"
    >
      {/* Icono de WhatsApp (SVG) */}
      <svg
        className="whatsapp-icon"
        viewBox="0 0 32 32"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          d="M19.11 17.205c-.372 0-1.088 1.39-1.518 1.39a.63.63 0 0 1-.315-.1c-.802-.402-1.504-.817-2.163-1.447-.545-.516-1.146-1.29-1.46-1.963a.426.426 0 0 1-.073-.215c0-.33.99-.945.99-1.49 0-.46-1.207-2.47-1.38-2.928-.17-.46-.372-.51-.538-.51-.17 0-.37.04-.537.04-.17.02-.43.12-.66.33-.23.2-.39.4-.56.6-.17.2-.28.4-.36.6-.17.3-.28.6-.28.9.02.3.02.6.1.9.07.3.17.6.25.9.52 1.8 1.4 3.5 2.6 4.9.7 1 1.7 1.7 2.8 2.3.4.2.9.4 1.4.5.5.2 1 .2 1.5.1.7-.2 1.3-.5 1.8-.9.4-.4.7-.9.9-1.4.1-.4.1-.8.1-1.3v-.3a.62.62 0 0 0-.25-.4c-.2-.2-.4-.2-.6-.2z"
          fill="currentColor"
        ></path>
        <path
          d="M27.3 4.7A13.4 13.4 0 0 0 16 0 13.4 13.4 0 0 0 4.7 27.3 13.4 13.4 0 0 0 16 32a13.4 13.4 0 0 0 11.3-4.7c.2-.2.4-.5.5-.7.2-.2.4-.5.5-.7.2-.3.4-.6.5-.9.2-.3.4-.6.5-.9.1-.3.3-.6.4-.9.1-.3.3-.6.4-1 .1-.3.2-.6.3-1 .1-.3.2-.6.3-1 .1-.3.2-.6.2-1 .1-.3.1-.6.2-1 .1-.3.1-.6.1-1 .1-.3.1-.7.1-1.1V16c0-4.4-1.8-8.4-4.7-11.3zM16 29.9c-3.7 0-7.1-1.5-9.8-4.1l-6.8 2.2 2.3-6.6c-2.7-2.7-4.2-6.2-4.2-10C-1.8 6.2 6.2-1.8 16-1.8c4.4 0 8.4 1.8 11.3 4.7C32.2 7.8 34 11.6 34 16c0 7.6-6.2 13.8-13.8 13.8z"
          fill="currentColor"
        ></path>
      </svg>
    </a>
  );
};

export default BotonWhatsapp; 