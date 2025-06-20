import React from 'react';
import './../css/titulo.css';

const ElementoTitulo = ({ texto }) => {
  return (
    <div className="titulo-container">
      <h1>{texto}</h1>
    </div>
  );
};

export default ElementoTitulo;
