import React, { useState, useEffect } from 'react';
import '../css/carrucel.css'; // Ajusta el path si es necesario

const mensajes = [
  "Compra ahora y pague después con Sistecrédito y Addi",
  "12 unidades de boxer x $76.000 en estilos seleccionados",
  "Envíos gratis por compras superiores a $76.000",
  "Envíos al día siguiente en Cucuta, solo aplica de lunes a viernes horario laboral .",
];

const ElementoCarrucel = () => {
  const [indice, setIndice] = useState(0);

  useEffect(() => {
    const intervalo = setInterval(() => {
      setIndice((prevIndice) => (prevIndice + 1) % mensajes.length);
    }, 4000); // cambia cada 4 segundos

    return () => clearInterval(intervalo);
  }, []);

  return (
    <div className="carrusel-promociones">
      <h2 className="promo-texto">{mensajes[indice]}</h2>
    </div>
  );
};

export default ElementoCarrucel;
