import React from 'react';
import { Link } from 'react-router-dom';


import '../css/Navbar.css';

const ElmentoNavbar = () => {
  return (
    <nav className="navbar">
      <ul className="navbar-list">
        <li className="navbar-item"><Link to="/catalogo" className="navbar-link">Catalogo</Link></li>
      </ul>
    </nav>
  );
};

export default ElmentoNavbar;