import React from 'react';
import { Link } from 'react-router-dom';


import '../css/Navbar.css';

const ElmentoNavbar = () => {
  return (
    <nav className="navbar">
      <ul className="navbar-list">
        <li className="navbar-item"><Link to="/" className="navbar-link">Inicio</Link></li>
        <li className="navbar-item"><Link to="/acerca" className="navbar-link">Caballeros</Link></li>
        <li className="navbar-item"><Link to="/contacto" className="navbar-link">Damas</Link></li>
        <li className="navbar-item"><Link to="/catalogo" className="navbar-link">Niños</Link></li>
        <li className="navbar-item"><Link to="/Confeciones-creacion" className="navbar-link">Niñas</Link></li>
        <li className="navbar-item"><Link to="/login" className="navbar-link">Todos</Link></li>
        
      </ul>
    </nav>
  );
};

export default ElmentoNavbar;