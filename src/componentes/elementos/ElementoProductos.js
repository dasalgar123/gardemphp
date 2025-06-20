// ElementosProductos.js

// Importar imágenes de muestra
import boxer1_1 from '../img/boxesincostura/boxer1_1.jpeg';
import boxer1_2 from '../img/boxesincostura/boxer1_2.jpeg';
import boxer2_1 from '../img/boxeralgodónclásico/boxer2_1.jpeg';
import boxer2_2 from '../img/boxeralgodónclásico/boxer2_2.jpeg';
import boxer3_1 from '../img/Boxermicrofibradeportivo/boxer3_1.jpeg';
import boxer3_2 from '../img/Boxermicrofibradeportivo/boxer3_2.jpeg';
import boxer4_1 from '../img/Boxeralgodónpremium/boxer4_1.jpeg';
import boxer4_2 from '../img/Boxeralgodónpremium/boxer4_2.jpeg';
import boxer5_1 from '../img/Boxermezclastretch/boxer5_1.jpeg';
import boxer6_1 from '../img/oxercompresiónligera/boxer6_1.jpg';

export const COLORES_COMERCIALES = ['Negro', 'Blanco', 'Gris', 'Azul marino', 'Rojo', 'Verde'];
export const TALLAS_STD = ['S', 'M', 'L', 'XL'];

export const ElementoProductos = [
  // Categoria: Caballeros
  { id: 1, nombre: 'Boxer sin costuras', descripcion: 'Tecnología seamless que evita rozaduras.', precio: 250, colores: COLORES_COMERCIALES, tallas: TALLAS_STD, imagen: boxer1_1, category: 'Caballeros' },
  { id: 2, nombre: 'Boxer algodón clásico', descripcion: 'Algodón 95% con ajuste cómodo.', precio: 100, colores: COLORES_COMERCIALES, tallas: TALLAS_STD, imagen: boxer2_1, category: 'Caballeros' },
  { id: 3, nombre: 'Boxer microfibra deportivo', descripcion: 'Alta elasticidad para máximo rendimiento.', precio: 300, colores: COLORES_COMERCIALES, tallas: TALLAS_STD, imagen: boxer3_1, category: 'Caballeros' },
  { id: 4, nombre: 'Boxer algodón premium', descripcion: 'Suavidad y confort superior.', precio: 350, colores: COLORES_COMERCIALES, tallas: TALLAS_STD, imagen: boxer4_1, category: 'Caballeros' },

  // Categoria: Damas
  { id: 5, nombre: 'Bikini de Encaje', descripcion: 'Diseño elegante y femenino.', precio: 280, colores: ['Rojo', 'Negro', 'Blanco'], tallas: ['S', 'M', 'L'], imagen: boxer1_2, category: 'Damas' },
  { id: 6, nombre: 'Cachetero de Algodón', descripcion: 'Comodidad para el día a día.', precio: 220, colores: ['Gris', 'Rosado', 'Azul'], tallas: ['S', 'M', 'L'], imagen: boxer2_2, category: 'Damas' },

  // Categoria: Niños
  { id: 7, nombre: 'Boxer de Superhéroes', descripcion: 'Divertido y cómodo para niños.', precio: 180, colores: ['Azul', 'Rojo', 'Verde'], tallas: ['4', '6', '8'], imagen: boxer3_2, category: 'Niños' },
  
  // Categoria: Niñas
  { id: 8, nombre: 'Panties de Princesas', descripcion: 'Suave algodón con diseños de princesas.', precio: 170, colores: ['Rosado', 'Lila', 'Blanco'], tallas: ['4', '6', '8'], imagen: boxer4_2, category: 'Niñas' },

  // Categoria: Unisex
  { id: 9, nombre: 'Boxer mezcla stretch', descripcion: 'Ajuste flexible para todos.', precio: 200, colores: COLORES_COMERCIALES, tallas: TALLAS_STD, imagen: boxer5_1, category: 'Unisex' },
  { id: 10, nombre: 'Boxer compresión ligera', descripcion: 'Soporte ligero para cualquier actividad.', precio: 260, colores: COLORES_COMERCIALES, tallas: TALLAS_STD, imagen: boxer6_1, category: 'Unisex' },
];
