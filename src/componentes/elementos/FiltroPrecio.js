import React from 'react';
import './../css/FiltroPrecio.css';

const FiltroPrecio = ({ setSortBy }) => {
  return (
    <div className="filtro-precio-container">
      <label htmlFor="sort-by">Ordenar por:</label>
      <select id="sort-by" onChange={(e) => setSortBy(e.target.value)} className="filtro-select">
        <option value="default">Relevancia</option>
        <option value="price-asc">Precio: Menor a Mayor</option>
        <option value="price-desc">Precio: Mayor a Menor</option>
      </select>
    </div>
  );
};

export default FiltroPrecio; 