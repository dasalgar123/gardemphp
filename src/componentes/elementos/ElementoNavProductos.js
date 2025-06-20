import React from 'react';
import './../css/navproductos.css';

const ElementoNavProductos = ({ onSelectCategory, categorias }) => {
  return (
    <nav className="nav-productos">
      {categorias.map((categoria) => (
        <button key={categoria} onClick={() => onSelectCategory(categoria)}>
          {categoria}
        </button>
      ))}
    </nav>
  );
};

export default ElementoNavProductos;