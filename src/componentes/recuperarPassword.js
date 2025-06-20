// src/logica/recuperarPassword.js
import { obtenerUsuarios } from './Usuarios/usuarios';

export const recuperarPassword = (usuario) => {
  const usuarios = obtenerUsuarios();
  const encontrado = usuarios.find(u => u.usuario === usuario);
  return encontrado ? encontrado.password : null;
};
